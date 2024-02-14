<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aquaculture extends Model
{
    use HasFactory;

    protected $table = 'aquacultures';
    protected $fillable = [ 
        'id',
        'uuid',
        'ponds',
        'gender',
        'district',
        'village',
        'geojsonPonds',
        'imagePonds',
        'cultivationType',
        'pondArea',
        'cultivationStage',
        'status',
        'number',
    ];
}
