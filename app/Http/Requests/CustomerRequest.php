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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|unique:customers,client_id,' . $this->customer?->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $this->customer?->id,
            'ip_address' => 'required|ip',
            'country' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'A unique client ID is required.',
            'client_id.unique' => 'This client ID is already taken.',
            'name.required' => 'The customer name is required.',
            'name.string' => 'The customer name must be a valid string.',
            'name.max' => 'The customer name may not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be valid.',
            'email.unique' => 'This email address is already in use.',
            'ip_address.required' => 'The IP address is required.',
            'ip_address.ip' => 'The IP address must be valid.',
            'country.required' => 'The country is required.',
            'country.string' => 'The country must be a valid string.',
            'country.max' => 'The country may not exceed 255 characters.',
        ];
    }
}
