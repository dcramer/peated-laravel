<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BottleResource;
use App\Models\Bottle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BottleController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'query' => 'string|nullable',
            'brand' => 'integer|nullable',
            'distiller' => 'integer|nullable',
            'bottler' => 'integer|nullable',
            'entity' => 'integer|nullable',
            'tag' => 'string|nullable',
            'flavorProfile' => 'string|nullable|in:'.implode(',', config('constants.flavor_profiles')),
            'flight' => 'string|nullable',
            'category' => 'string|nullable|in:'.implode(',', config('constants.categories')),
            'age' => 'integer|nullable',
            'caskType' => 'string|nullable|in:'.implode(',', config('constants.cask_types')),
            'cursor' => 'integer|min:1|default:1',
            'limit' => 'integer|min:1|max:100|default:25',
            'sort' => 'string|in:rank,brand,-brand,created,-created,name,-name,age,-age,rating,-rating,tastings,-tastings|default:-tastings',
        ]);

        $query = Bottle::query()
            ->join('entity as brand', 'brand.id', '=', 'bottle.brand_id');

        // Apply search
        if ($request->query) {
            $query->whereFullText('search_vector', $request->query);
        }

        // Apply filters
        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->distiller) {
            $query->whereExists(function ($query) use ($request) {
                $query->select(DB::raw(1))
                    ->from('bottle_to_distiller')
                    ->whereColumn('bottle_to_distiller.bottle_id', 'bottle.id')
                    ->where('bottle_to_distiller.distiller_id', $request->distiller);
            });
        }

        if ($request->bottler) {
            $query->where('bottler_id', $request->bottler);
        }

        if ($request->entity) {
            $query->where(function ($query) use ($request) {
                $query->where('brand_id', $request->entity)
                    ->orWhere('bottler_id', $request->entity)
                    ->orWhereExists(function ($query) use ($request) {
                        $query->select(DB::raw(1))
                            ->from('bottle_to_distiller')
                            ->whereColumn('bottle_to_distiller.bottle_id', 'bottle.id')
                            ->where('bottle_to_distiller.distiller_id', $request->entity);
                    });
            });
        }

        // Apply sorting
        switch ($request->input('sort', '-tastings')) {
            case 'rank':
                if ($request->query) {
                    $query->orderByRaw('ts_rank(search_vector, websearch_to_tsquery(\'english\', ?)) DESC', [$request->query]);
                } else {
                    $query->orderBy('total_tastings', 'desc');
                }
                break;
            case 'brand':
                if (! $request->entity) {
                    abort(400, 'Cannot sort by brand without entity filter.');
                }
                $query->orderBy('brand.name')->orderBy('bottle.name');
                break;
            case 'created':
                $query->orderBy('created_at');
                break;
            case '-created':
                $query->orderBy('created_at', 'desc');
                break;
            case 'name':
                $query->orderBy('full_name');
                break;
            case '-name':
                $query->orderBy('full_name', 'desc');
                break;
            case 'age':
                $query->orderByRaw('stated_age ASC NULLS FIRST');
                break;
            case '-age':
                $query->orderByRaw('stated_age DESC NULLS LAST');
                break;
            case 'rating':
                $query->orderByRaw('avg_rating ASC NULLS LAST');
                break;
            case '-rating':
                $query->orderByRaw('avg_rating DESC NULLS LAST');
                break;
            case 'tastings':
                $query->orderBy('total_tastings');
                break;
            case '-tastings':
            default:
                $query->orderBy('total_tastings', 'desc');
        }

        $limit = $request->input('limit', 25);
        $page = $request->input('cursor', 1);
        $bottles = $query->paginate($limit, ['*'], 'cursor', $page);

        return BottleResource::collection($bottles)->additional([
            'rel' => [
                'nextCursor' => $bottles->hasMorePages() ? $page + 1 : null,
                'prevCursor' => $page > 1 ? $page - 1 : null,
            ],
        ]);
    }
}
