<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'field_id' => 'required|exists:fields,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,canceled',
        ];
    }

    public function messages(): array
    {

        return [
            'field_id.required' => 'Field harus dipilih.',
            'booking_date.required' => 'Tanggal pemesanan harus diisi.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'end_time.required' => 'Waktu selesai harus diisi.',
            'total_price.required' => 'Harga total harus diisi.',
            'status.required' => 'Status harus dipilih.',
        ];
    }
}
