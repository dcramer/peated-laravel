<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'tasting_id',
        'comment',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function tasting()
    {
        return $this->belongsTo(Tasting::class, 'tasting_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
