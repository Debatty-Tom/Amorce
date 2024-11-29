<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    public function user() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
