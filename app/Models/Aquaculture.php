<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aquaculture extends Model
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
        'pondArea',
        'imagePonds',
        'status',
        'cultivationType',
        'cultivationStage',
        'geojsonPonds',
    ];
}
