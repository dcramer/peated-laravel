<?php

namespace App\Models;

use App\Enums\FlavorProfile;
use App\Enums\TagCategory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tag';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'synonyms',
        'tag_category',
        'flavor_profiles',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'synonyms' => 'array',
        'tag_category' => TagCategory::class,
        'flavor_profiles' => 'array', // Array of FlavorProfile enums
    ];

    /**
     * Get the flavor profiles as an array of FlavorProfile enums
     *
     * @return array<FlavorProfile>
     */
    public function getFlavorProfilesAttribute($value)
    {
        $profiles = json_decode($value, true) ?? [];

        return array_map(fn ($profile) => FlavorProfile::from($profile), $profiles);
    }

    /**
     * Set the flavor profiles from an array of FlavorProfile enums
     *
     * @param  array<FlavorProfile|string>  $value
     */
    public function setFlavorProfilesAttribute($value)
    {
        $profiles = array_map(function ($profile) {
            return $profile instanceof FlavorProfile ? $profile->value : $profile;
        }, $value);
        $this->attributes['flavor_profiles'] = json_encode($profiles);
    }
}
