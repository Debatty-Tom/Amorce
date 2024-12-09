<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory, Notifiable;


    protected $fillable = [
        'title',
        'description',
        'amount',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    public function fund() : BelongsTo
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }
    public function transaction_summary_view() : BelongsTo
    {
        return $this->belongsTo(Fund::class, 'summary_id');
    }
}
