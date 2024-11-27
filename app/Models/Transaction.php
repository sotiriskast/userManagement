<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'amount', 'currency', 'transaction_date'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'client_id', 'client_id');
    }
}
