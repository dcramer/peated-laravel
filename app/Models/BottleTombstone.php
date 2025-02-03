<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottleTombstone extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bottle_tombstone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bottle_id',
        'new_bottle_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bottle_id' => 'integer',
        'new_bottle_id' => 'integer',
    ];

    public function bottle()
    {
        return $this->belongsTo(Bottle::class, 'bottle_id');
    }

    public function newBottle()
    {
        return $this->belongsTo(Bottle::class, 'new_bottle_id');
    }
}
