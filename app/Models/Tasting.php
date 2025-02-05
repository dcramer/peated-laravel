<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bottle_id',
        'tags',
        'color',
        'rating',
        'image_url',
        'notes',
        'serving_style',
        'friends',
        'flight_id',
        'comments',
        'toasts',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'color' => 'integer',
        'rating' => 'float',
        'friends' => 'array',
        'comments' => 'integer',
        'toasts' => 'integer',
        'created_at' => 'datetime',
    ];

    protected $with = ['bottle', 'createdBy', 'flight', 'comments', 'toasts', 'badgeAwards'];

    public function bottle()
    {
        return $this->belongsTo(Bottle::class, 'bottle_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tasting_id');
    }

    public function toasts()
    {
        return $this->hasMany(Toast::class, 'tasting_id');
    }

    public function badgeAwards()
    {
        return $this->hasMany(TastingBadgeAward::class, 'tasting_id');
    }

    public function friendUsers()
    {
        return $this->belongsToMany(User::class, null, 'friends');
    }
}
