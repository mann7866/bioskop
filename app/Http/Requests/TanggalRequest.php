<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TanggalRequest extends FormRequest
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
            "tanggalTayang"=> "required|after:today|date_format:Y-m-d",
        ];
    }

    public function messages(): array
    {
        return[
            "tanggalTayang.required"=> "Tanggal Tayang Harus Diisi",
            "tanggalTayang.after"=> "Tanggal Tayang Harus Lebih Dari Hari Imi",
            "tanggalTayang.date_format"=> "Tanggal Tayang Harus Y-m-d",
        ];
    }
}
