<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
            'name' => 'required|string|min:3|max:100',
            'category' => 'required|string|min:3|max:50',
            'stock' => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
            'image.mimes' => 'Format gambar harus jpeg, jpg, png, atau webp.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.min' => 'Nama produk minimal 3 karakter.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'category.required' => 'Kategori produk wajib diisi.',
            'category.min' => 'Kategori produk minimal 3 karakter.',
            'category.max' => 'Kategori produk maksimal 50 karakter.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa angka bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
            'price_per_day.required' => 'Harga sewa per hari wajib diisi.',
            'price_per_day.numeric' => 'Harga sewa per hari harus berupa angka.',
            'price_per_day.min' => 'Harga sewa per hari tidak boleh kurang dari 0.',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
        ];
    }
}
