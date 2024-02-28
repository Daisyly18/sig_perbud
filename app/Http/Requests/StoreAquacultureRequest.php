<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAquacultureRequest extends FormRequest
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
            'geojsonPonds' => 'required|file|mimetypes:application/json',
            'ponds' => 'required',
            'gender' => 'required',
            'district' => 'required',
            'village' => 'required',
            'pondArea'  => 'required',
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
            'district.required' => 'Kecamatan harus diisi',
            'village.required' => 'Desa/Kelurahan harus diisi',
            'pondArea.required' => 'Luas Tambak harus diisi',
            'imagePonds.required' => 'Gambar harus diisi',
            'status.required' => 'Status harus diisi',
            'cultivationType.required' => 'Jenis Budidaya harus diisi',
            'cultivationStage.required' => 'Tahap Budidaya harus diisi',
            'geojsonPonds.required' => 'File Geojson harus diisi',            
        ];
    }
}
