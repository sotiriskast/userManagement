<?php
namespace App\Services;

use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyService
{
    protected CurrencyRepositoryInterface $currencyRepositoryInterface;

    public function __construct(CurrencyRepositoryInterface $currencyRepositoryInterface)
    {
        $this->currencyRepositoryInterface = $currencyRepositoryInterface;
    }

    public function getAllCurrencies()
    {
        return $this->currencyRepositoryInterface->getAll();
    }
}
