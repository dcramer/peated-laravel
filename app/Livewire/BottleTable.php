<?php

namespace App\Livewire;

use App\Models\Bottle;
use Livewire\Component;
use Livewire\WithPagination;

class BottleTable extends Component
{
    use WithPagination;

    public $sort = '-tastings';
    public $age;
    public $entity;
    public $distiller;
    public $bottler;
    public $limit = 100;

    protected $queryString = [
        'sort' => ['except' => '-tastings'],
        'age' => ['except' => ''],
        'entity' => ['except' => ''],
        'distiller' => ['except' => ''],
        'bottler' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function getBottles()
    {
        $query = Bottle::query()
            ->with(['distillers', 'bottlers'])
            ->when($this->age, function ($query, $age) {
                return $query->where('stated_age', $age);
            })
            ->when($this->entity, function ($query, $entity) {
                return $query->whereHas('entities', function ($q) use ($entity) {
                    $q->where('id', $entity);
                });
            })
            ->when($this->distiller, function ($query, $distiller) {
                return $query->whereHas('distillers', function ($q) use ($distiller) {
                    $q->where('id', $distiller);
                });
            })
            ->when($this->bottler, function ($query, $bottler) {
                return $query->whereHas('bottlers', function ($q) use ($bottler) {
                    $q->where('id', $bottler);
                });
            });

        // Handle sorting
        if ($this->sort) {
            $direction = str_starts_with($this->sort, '-') ? 'desc' : 'asc';
            $column = ltrim($this->sort, '-');

            if ($column === 'tastings') {
                $query->withCount('tastings')->orderBy('tastings_count', $direction);
            } else {
                $query->orderBy($column, $direction);
            }
        }

        return $query->paginate($this->limit);
    }

    public function render()
    {
        return view('livewire.bottle-table', [
            'bottles' => $this->getBottles(),
        ]);
    }
}
