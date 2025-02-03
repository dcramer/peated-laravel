<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityTombstone extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entity_tombstone';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entity_id',
        'new_entity_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'entity_id' => 'integer',
        'new_entity_id' => 'integer',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function newEntity()
    {
        return $this->belongsTo(Entity::class, 'new_entity_id');
    }
}
