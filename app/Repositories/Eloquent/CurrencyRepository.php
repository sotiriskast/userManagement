<?php
namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAll()
    {
        return Currency::all();
    }
}
