<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'picture_url',
        'verified',
        'private',
        'active',
        'admin',
        'mod',
        'notify_comments',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'picture_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'verified' => 'boolean',
        'private' => 'boolean',
        'active' => 'boolean',
        'admin' => 'boolean',
        'mod' => 'boolean',
        'notify_comments' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class, 'created_by_id');
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'from_user_id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'to_user_id');
    }

    public function identities()
    {
        return $this->hasMany(Identity::class, 'user_id');
    }
}
