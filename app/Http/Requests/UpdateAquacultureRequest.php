<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAquacultureRequest extends FormRequest
{
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
            'geojsonPonds' => 'required|file|mimes:json,geojson', 
            'imagePonds' => 'required|image|mimes:jpeg,jpg,png',
            'cultivationType'  => 'required',
            'pondArea'  => 'required',
            'cultivationStage'  => 'required',
            'status'  => 'required'
        ];
    }
}
