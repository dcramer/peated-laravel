<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bottle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'name',
        'edition',
        'category',
        'brand_id',
        'bottler_id',
        'stated_age',
        'flavor_profile',
        'single_cask',
        'cask_strength',
        'vintage_year',
        'release_year',
        'cask_size',
        'cask_type',
        'cask_fill',
        'description',
        'description_src',
        'image_url',
        'tasting_notes',
        'suggested_tags',
        'avg_rating',
        'total_tastings',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'single_cask' => 'boolean',
        'cask_strength' => 'boolean',
        'vintage_year' => 'integer',
        'release_year' => 'integer',
        'stated_age' => 'integer',
        'tasting_notes' => 'json',
        'suggested_tags' => 'array',
        'avg_rating' => 'float',
        'total_tastings' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $withCount = ['tastings', 'favorites'];

    protected $with = ['distillers', 'bottlers'];

    protected $appends = ['fullName'];

    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function brand()
    {
        return $this->belongsTo(Entity::class, 'brand_id');
    }

    public function bottler()
    {
        return $this->belongsTo(Entity::class, 'bottler_id');
    }

    public function distillers()
    {
        return $this->belongsToMany(Entity::class, 'bottle_distiller', 'bottle_id', 'distiller_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class, 'bottle_id');
    }

    public function aliases()
    {
        return $this->hasMany(BottleAlias::class, 'bottle_id');
    }

    public function tags()
    {
        return $this->hasMany(BottleTag::class, 'bottle_id');
    }

    public function flavorProfiles()
    {
        return $this->hasMany(BottleFlavorProfile::class, 'bottle_id');
    }
}
