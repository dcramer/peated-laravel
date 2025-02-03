<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePrice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'external_site_id',
        'name',
        'image_url',
        'bottle_id',
        'hidden',
        'price',
        'currency',
        'volume',
        'url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hidden' => 'boolean',
        'price' => 'integer',
        'volume' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }

    public function externalSite()
    {
        return $this->belongsTo(ExternalSite::class);
    }

    public function priceHistory()
    {
        return $this->hasMany(StorePriceHistory::class, 'price_id');
    }
}
