<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $customers = $this->customerService->searchCustomers($search, 10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerRequest $request)
    {
        try {
            $this->customerService->createCustomer($request->validated());
            return redirect()
                ->route('customers.index')
                ->with('type', 'success')
                ->with('message', 'Customer added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'error')
                ->with('message', 'Failed to add customer. Please try again.');
        }
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $this->customerService->updateCustomer($customer, $request->validated());
            return redirect()
                ->route('customers.index')
                ->with('type', 'success')
                ->with('message', 'Customer updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'error')
                ->with('message', 'Failed to update customer. Please try again.');
        }
    }

    public function destroy(Customer $customer)
    {
        $this->customerService->deleteCustomer($customer);
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
