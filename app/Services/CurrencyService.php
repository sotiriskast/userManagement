<?php
namespace App\Services;

use App\Repositories\CurrencyRepository;

class CurrencyService
{
    protected CurrencyRepository $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getAllCurrencies()
    {
        return $this->currencyRepository->getAll();
    }
}
