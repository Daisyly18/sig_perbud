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
        'geojsonPonds',
        'ponds',
        'gender',
        'district',
        'village',
        'pondArea',
        'imagePonds',
        'status',
        'cultivationType',
        'cultivationStage',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
