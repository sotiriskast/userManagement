<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('Admin') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customerId = $this->customer?->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:customers,email,{$customerId}",
            'ip_address' => 'required|ip',
            'country_id' => 'required|exists:countries,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The customer name is required.',
            'name.string' => 'The customer name must be a valid string.',
            'name.max' => 'The customer name may not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be valid.',
            'email.unique' => 'This email address is already in use.',
            'ip_address.required' => 'The IP address is required.',
            'ip_address.ip' => 'The IP address must be valid.',
            'country_id.required' => 'The country is required.',
            'country_id.exists' => 'The selected country is invalid.',
        ];
    }

}
