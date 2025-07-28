<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Assignment::class)
            ->withPivot('assigned_by')
            ->withTimestamps();
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
