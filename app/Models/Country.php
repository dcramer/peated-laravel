<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'alpha2',
        'location',
        'description',
        'description_src',
        'summary',
        'total_bottles',
        'total_distillers',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_bottles' => 'integer',
        'total_distillers' => 'integer',
    ];

    protected array $postgisColumns = [
        'location' => [
            'type' => 'geometry',
            'srid' => 4326,
        ],
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}
