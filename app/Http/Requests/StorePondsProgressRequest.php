<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePondsProgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'exclude',
            'ponds' => 'required',
            'gender' => 'required',
            'district' => 'required',
            'village' => 'required',
            'imagePonds' => 'required|image|mimes:jpeg,jpg,png',
            'cultivationType'  => 'required',
            'cultivationStage'  => 'required',
            'status'  => 'required',
            'number'  => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'ponds.required' => 'Pembudidaya harus diisi'
        ];
    }
}
