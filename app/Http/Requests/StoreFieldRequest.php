<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFieldRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'integer', 'min:0'],
            'photo' => ['required', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lapangan harus diisi.',
            'location.required' => 'Lokasi lapangan harus diisi.',
            'price_per_hour.required' => 'Harga per jam harus diisi.',
            'photo.required' => 'Foto lapangan harus diunggah.',
        ];
    }
}
