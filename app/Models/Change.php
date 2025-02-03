<?php

namespace App\Models;

use App\Enums\ChangeAction;
use App\Enums\ChangeObjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'change';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_type',
        'object_id',
        'action',
        'created_by_id',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'object_id' => 'integer',
        'created_by_id' => 'integer',
        'object_type' => ChangeObjectType::class,
        'action' => ChangeAction::class,
        'data' => 'json',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function object()
    {
        return match ($this->object_type) {
            ChangeObjectType::Bottle => $this->belongsTo(Bottle::class, 'object_id'),
            ChangeObjectType::Entity => $this->belongsTo(Entity::class, 'object_id'),
            ChangeObjectType::Collection => $this->belongsTo(Collection::class, 'object_id'),
            ChangeObjectType::Flight => $this->belongsTo(Flight::class, 'object_id'),
            ChangeObjectType::Tasting => $this->belongsTo(Tasting::class, 'object_id'),
            ChangeObjectType::Comment => $this->belongsTo(Comment::class, 'object_id'),
            ChangeObjectType::Toast => $this->belongsTo(Toast::class, 'object_id'),
            ChangeObjectType::Follow => $this->belongsTo(Follow::class, 'object_id'),
            ChangeObjectType::User => $this->belongsTo(User::class, 'object_id'),
        };
    }
}
