<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FlightBottle extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flight_bottle';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'flight_id',
        'bottle_id',
        'position',
        'created_by_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'flight_id' => 'integer',
        'bottle_id' => 'integer',
        'position' => 'integer',
        'created_by_id' => 'integer',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
