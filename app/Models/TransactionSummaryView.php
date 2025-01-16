<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionSummaryView extends Model
{
    protected $table = 'transaction_summary_view';

    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "fund_id";
    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class, 'summary_id');
    }
}
