<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalSite extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'external_site';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'last_run_at',
        'next_run_at',
        'run_every',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
        'run_every' => 'integer',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function prices()
    {
        return $this->hasMany(StorePrice::class);
    }

    public function config()
    {
        return $this->hasMany(ExternalSiteConfig::class);
    }
}
