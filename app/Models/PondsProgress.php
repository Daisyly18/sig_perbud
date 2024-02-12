<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondsProgress extends Model
{
    use HasFactory;
    protected $table = 'ponds_progress';

    protected $fillable = [
        'id',
        'uuid',
        'ponds',
        'gender',
        'district',
        'village',
        'imagePonds',
        'cultivationType',
        'cultivationStage',
        'status',
        'geojsonPonds',
        'number',
    ];
    protected $attributes = [
        'geojsonPonds' => null,     
    ];
    
}
