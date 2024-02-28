<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePondsProgressRequest extends FormRequest
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
            'imagePonds' => 'required|image|mimes:jpeg,jpg,png',
            'status'  => 'required',
            'cultivationType'  => 'required',            
            'cultivationStage'  => 'required',                        
        ];
    }
    public function messages(): array
    {
        return [
            'ponds.required' => 'Pembudidaya harus diisi',
            'gender.required' => 'Jenis Kelamin harus diisi',            
            'imagePonds.required' => 'Gambar harus diisi',
            'status.required' => 'Status harus diisi',
            'cultivationType.required' => 'Jenis Budidaya harus diisi',
            'cultivationStage.required' => 'Tahap Budidaya harus diisi',   
        ];
    }
}
