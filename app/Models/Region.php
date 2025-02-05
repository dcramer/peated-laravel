<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'region';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'location',
        'description',
        'description_src',
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


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function entities()
    {
        return $this->hasMany(Entity::class, 'region_id');
    }
}
