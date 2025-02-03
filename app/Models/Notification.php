<?php

namespace App\Models;

use App\Enums\NotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'object_id',
        'read',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'integer',
        'from_user_id' => 'integer',
        'object_id' => 'integer',
        'type' => NotificationType::class,
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function object()
    {
        return match ($this->type) {
            NotificationType::Comment => $this->belongsTo(Comment::class, 'object_id'),
            NotificationType::Toast => $this->belongsTo(Toast::class, 'object_id'),
            // NotificationType::FriendRequest => $this->belongsTo(Follow::class, 'object_id'),
        };
    }
}
