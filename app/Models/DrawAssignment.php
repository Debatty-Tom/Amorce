<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrawAssignment extends Model
{
    public function draw(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Draw::class);
    }
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donator::class);
    }

}
