<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'status', 'poster',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
