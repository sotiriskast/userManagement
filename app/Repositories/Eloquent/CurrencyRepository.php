<?php
namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAll(): Collection
    {
        return Currency::all();
    }
}
