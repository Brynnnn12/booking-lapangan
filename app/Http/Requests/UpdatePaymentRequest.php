<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'booking_id' => 'required|exists:bookings,id',
            'snap_token' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'required|string|in:pending,paid,failed',
        ];
    }

    public function messages(): array
    {
        return [
            'booking_id.required' => 'Booking harus dipilih.',
            'booking_id.exists' => 'Booking yang dipilih tidak valid.',
            'snap_token.required' => 'Snap token harus diisi.',
            'amount.required' => 'Jumlah harus diisi.',
            'amount.numeric' => 'Jumlah harus berupa angka.',
            'status.required' => 'Status pembayaran harus dipilih.',
            'status.in' => 'Status pembayaran harus salah satu dari: pending, paid, failed.',
        ];
    }
}
