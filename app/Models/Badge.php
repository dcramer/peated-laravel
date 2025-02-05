<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'badges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image_url',
        'max_level',
        'tracker',
        'formula',
        'checks',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'max_level' => 'integer',
        'checks' => 'array',
    ];


    public function awards()
    {
        return $this->hasMany(BadgeAward::class, 'badge_id');
    }
}
