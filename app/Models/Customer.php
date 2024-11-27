<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'name', 'email', 'ip_address', 'country'];

    public function transactions(): hasMany
    {
        return $this->hasMany(Transaction::class, 'client_id', 'client_id');
    }
}
