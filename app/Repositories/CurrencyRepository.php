<?php
namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    public function getAll(): Collection
    {
        return Currency::all();
    }
}
