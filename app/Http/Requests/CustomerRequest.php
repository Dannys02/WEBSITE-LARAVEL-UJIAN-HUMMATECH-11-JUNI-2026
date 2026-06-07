<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^62[0-9]{9,12}$/|unique:customers,phone,' . $this->customers?->id,
            'address' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255|unique:customers,identity_number,' . $this->customers?->id
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama customer wajib diisi.',
            'name.string' => 'Nama customer harus berupa teks.',
            'name.max' => 'Nama customer maksimal 255 karakter.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.regex' => 'Nomor telepon harus diawali 62 dan terdiri dari 11-14 digit.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',

            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal 255 karakter.',

            'identity_number.required' => 'Nomor identitas wajib diisi.',
            'identity_number.string' => 'Nomor identitas harus berupa teks.',
            'identity_number.max' => 'Nomor identitas maksimal 255 karakter.',
            'identity_number.unique' => 'Nomor identitas sudah terdaftar.',
        ];
    }
}
