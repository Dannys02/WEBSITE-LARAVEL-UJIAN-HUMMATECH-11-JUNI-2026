<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
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
            'customer_id'    => 'required|exists:customers,id',
            'product_id'     => 'required|exists:products,id',
            'qty'            => 'required|integer|min:1',
            'rental_date'    => 'required|date|after_or_equal:today',
            'return_date'    => 'required|date|after:rental_date',
            'status'         => 'required|in:active,returned,cancelled',
            'payment_status' => 'required|in:unpaid,dp,paid',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Pelanggan wajib dipilih.',
            'customer_id.exists'   => 'Pelanggan tidak ditemukan.',

            'product_id.required'  => 'Produk wajib dipilih.',
            'product_id.exists'    => 'Produk tidak ditemukan.',

            'qty.required'         => 'Jumlah sewa wajib diisi.',
            'qty.integer'          => 'Jumlah sewa harus berupa angka.',
            'qty.min'              => 'Jumlah sewa minimal 1.',

            'rental_date.required'         => 'Tanggal sewa wajib diisi.',
            'rental_date.date'             => 'Format tanggal sewa tidak valid.',
            'rental_date.after_or_equal'   => 'Tanggal sewa tidak boleh sebelum hari ini.',

            'return_date.required' => 'Tanggal kembali wajib diisi.',
            'return_date.date'     => 'Format tanggal kembali tidak valid.',
            'return_date.after'    => 'Tanggal kembali harus setelah tanggal sewa.',

            'status.required' => 'Status rental wajib dipilih.',
            'status.in'       => 'Status rental tidak valid.',

            'payment_status.required' => 'Status pembayaran wajib dipilih.',
            'payment_status.in'       => 'Status pembayaran tidak valid.',

            // 'customer_id'    => 'pelanggan',
            // 'product_id'     => 'produk',
            // 'qty'            => 'jumlah sewa',
            // 'rental_date'    => 'tanggal sewa',
            // 'return_date'    => 'tanggal kembali',
            // 'status'         => 'status rental',
            // 'payment_status' => 'status pembayaran',
        ];
    }
}
