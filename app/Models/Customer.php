<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'name', 'email', 'ip_address', 'country_id'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($customer) {
            if (empty($customer->client_id)) {
                $customer->client_id = self::generateClientId();
            }
        });
    }
    public static function generateClientId()
    {
        return (string) Str::uuid();
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function transactions(): hasMany
    {
        return $this->hasMany(Transaction::class);
    }

}
