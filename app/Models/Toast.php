<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toast extends Model
{
    use HasFactory;

    protected $table = 'toasts';

    protected $fillable = [
        'tasting_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function tasting()
    {
        return $this->belongsTo(Tasting::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
