<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function bottle(): BelongsTo
    {
        return $this->belongsTo(Bottle::class, 'bottle_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'tasting_id');
    }

    public function toasts(): HasMany
    {
        return $this->hasMany(Toast::class, 'tasting_id');
    }

    public function badgeAwards(): HasMany
    {
        return $this->hasMany(TastingBadgeAward::class, 'tasting_id');
    }

    public function friendUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, null, 'friends');
    }
}
