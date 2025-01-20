<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Donator extends Model
{
    /** @use HasFactory<\Database\Factories\DonatorFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'donation_count',
    ];
    public function draws(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Draw::class, Attendance::class);
    }
}
