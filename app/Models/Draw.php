<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Draw extends Model
{
    /** @use HasFactory<\Database\Factories\DrawFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'date',
    ];
    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];
    public function donators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Donator::class, Attendance::class);
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Project::class, DrawAssignment::class);
    }
}
