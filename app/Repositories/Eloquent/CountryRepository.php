<?php
namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository implements CountryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Country::all();
    }
}
