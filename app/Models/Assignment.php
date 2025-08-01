<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;
    public function todos(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by')->withTrashed();
    }
}
