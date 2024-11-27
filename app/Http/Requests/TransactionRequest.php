<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:customers,client_id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'transaction_date' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'client_id.required' => 'A customer is required for this transaction.',
            'client_id.exists' => 'The selected customer does not exist.',
            'amount.required' => 'The transaction amount is required.',
            'amount.numeric' => 'The amount must be a valid number.',
            'amount.min' => 'The amount cannot be less than zero.',
            'currency.required' => 'The currency is required.',
            'currency.string' => 'The currency must be a valid string.',
            'currency.max' => 'The currency code must be 3 characters.',
            'transaction_date.required' => 'The transaction date is required.',
            'transaction_date.date' => 'The transaction date must be a valid date.',
        ];
    }
}
