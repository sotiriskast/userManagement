<?php
namespace App\Services;

use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryService
{
    protected CountryRepositoryInterface $countryRepositoryInterface;

    public function __construct(CountryRepositoryInterface $countryRepositoryInterface)
    {
        $this->countryRepositoryInterface = $countryRepositoryInterface;
    }

    public function getAllCountries()
    {
        return $this->countryRepositoryInterface->getAll();
    }
}
