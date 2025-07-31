<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DrawAssignment extends Pivot
{
    protected $table = 'draw_assignments';

    protected $fillable = [
        'draw_id',
        'project_id',
        'status',
        'amount',
    ];
    public function draw(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Draw::class);
    }
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
