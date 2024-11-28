<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if the authenticated user is an admin
        return auth()->user()?->hasRole('Admin') ?? false;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'transaction_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:2100-01-01',
                'after:1900-01-01',
            ],

        ];
    }
    public function messages(): array
    {
        return [
            'amount.required' => 'The transaction amount is required.',
            'amount.numeric' => 'The amount must be a valid number.',
            'amount.min' => 'The amount cannot be less than zero.',
            'currency.required' => 'The currency is required.',
            'currency.string' => 'The currency must be a valid string.',
            'currency.max' => 'The currency code must be 3 characters.',
            'transaction_date.required' => 'The transaction date is required.',
            'transaction_date.date' => 'The transaction date must be a valid date.',
            'transaction_date.date_format' => 'The transaction date must be in the format YYYY-MM-DD.',
            'transaction_date.before' => 'The transaction date must be before the year 2100.',
            'transaction_date.after' => 'The transaction date must be after the year 1900.',
        ];
    }
}
