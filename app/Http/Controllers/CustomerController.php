<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\CountryService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    protected CustomerService $customerService;
    protected CountryService $countryService;

    public function __construct(CustomerService $customerService, CountryService $countryService)
    {
        $this->customerService = $customerService;
        $this->countryService = $countryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'country']);
        $customers = $this->customerService->searchCustomers($filters, 10);
        $countries = $this->countryService->getAllCountries();
        return view('customers.index', compact('customers', 'countries'));
    }

    public function create()
    {
        $countries=$this->countryService->getAllCountries();
        return view('customers.create', compact('countries'));
    }

    public function store(CustomerRequest $request)
    {
        $this->customerService->createCustomer($request->validated());
        return redirect()
            ->route('customers.index')
            ->with('type', 'success')
            ->with('message', 'Customer added successfully!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $countries=$this->countryService->getAllCountries();
        return view('customers.edit', compact('customer', 'countries'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->customerService->updateCustomer($customer, $request->validated());
        return redirect()
            ->route('customers.index')
            ->with('type', 'success')
            ->with('message', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $this->customerService->deleteCustomer($customer);
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
