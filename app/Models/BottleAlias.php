<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottleAlias extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bottle_alias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bottle_id',
        'name',
        'embedding',
        'ignored',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ignored' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function bottle()
    {
        return $this->belongsTo(Bottle::class, 'bottle_id');
    }
}
