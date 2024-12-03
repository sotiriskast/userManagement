<?php
namespace App\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository
{
    public function getAll(): Collection
    {
        return Country::all();
    }
}
