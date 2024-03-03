<?php

namespace App\Http\Controllers;

use App\Models\Aquaculture;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index (Request $request)
    {
        $pembudidaya = Aquaculture::count();
        $penyuluh = User::where('role', 'Penyuluh')->count();
        $status = Aquaculture::where('status', 'Aktif')->count();

        $stage1 = Aquaculture::where('cultivationType', 'Tahap Awal')->count();
        $stage2 = Aquaculture::where('cultivationType', 'Tahap Pembesaran')->count();
        $stage3 = Aquaculture::where('cultivationType', 'Tahap Panen')->count();

        $paguat = Aquaculture::where('district', 'paguat')->count();
        $duhiadaa = Aquaculture::where('district', 'duhiadaa')->count();
        $lemito = Aquaculture::where('district', 'lemito')->count();
        $patilanggio = Aquaculture::where('district', 'patilanggio')->count();
        $popayatoBar = Aquaculture::where('district', 'popayato barat')->count();
        $popayatoTim = Aquaculture::where('district', 'popayato timur')->count();
        $popayato = Aquaculture::where('district', 'popayato')->count();
        $randangan = Aquaculture::where('district', 'randangan')->count();
        $wanggarasi = Aquaculture::where('district', 'wanggarasi')->count();
        $marisa = Aquaculture::where('district', 'marisa')->count();
        $dengilo = Aquaculture::where('district', 'dengilo')->count();
        $buntulia = Aquaculture::where('district', 'buntulia')->count();
        $taluditi = Aquaculture::where('district', 'taluditi')->count();
    
        return view('pages.dashboard.index', compact(
            'pembudidaya', 
            'penyuluh', 
            'status', 
            'paguat',
            'duhiadaa',
            'lemito',
            'patilanggio',
            'popayatoBar',
            'popayatoTim',
            'popayato',
            'randangan',
            'wanggarasi',
            'marisa',
            'dengilo',
            'buntulia',
            'taluditi',
            'stage1',
            'stage2',
            'stage3',
        )); 
    }


}
