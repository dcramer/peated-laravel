<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'entity';

    protected $fillable = [
        'name',
        'short_name',
        'country_id',
        'region_id',
        'address',
        'location',
        'type',
        'description',
        'description_src',
        'year_established',
        'website',
        'total_bottles',
        'total_tastings',
    ];

    protected $casts = [
        'type' => 'array',
        'year_established' => 'integer',
        'total_bottles' => 'integer',
        'total_tastings' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected array $postgisColumns = [
        'location' => [
            'type' => 'geometry',
            'srid' => 4326,
        ],
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function bottles()
    {
        return $this->hasMany(Bottle::class, 'brand_id');
    }

    public function bottledBottles()
    {
        return $this->hasMany(Bottle::class, 'bottler_id');
    }

    public function distilledBottles()
    {
        return $this->belongsToMany(Bottle::class, 'bottle_distiller', 'distiller_id', 'bottle_id');
    }

    public function aliases()
    {
        return $this->hasMany(EntityAlias::class);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'shortName' => $this->shortName,
            'aliases' => $this->aliases->pluck('name')->implode(' '),
        ];
    }

    public function searchableOptions()
    {
        return [
            'column' => 'search_vector',
            'external' => false,
            'maintain_index' => true,
            // Ranking groups that will be assigned to fields
            // when document is being parsed.
            // Available groups: A, B, C and D.
            'rank' => [
                'fields' => [
                    'name' => 'A',
                    'shortName' => 'B',
                    'aliases' => 'B',
                ],
                // Ranking weights for searches.
                // [D-weight, C-weight, B-weight, A-weight].
                // Default [0.1, 0.2, 0.4, 1.0].
                'weights' => [0.1, 0.2, 0.4, 1.0],
                // Ranking function [ts_rank | ts_rank_cd]. Default ts_rank.
                'function' => 'ts_rank',
                // Normalization index. Default 0.
                'normalization' => 0,
            ],
            // You can explicitly specify a PostgreSQL text search configuration for the model.
            // Use \dF in psql to see all available configurationsin your database.
            'config' => 'simple',
        ];
    }
}
