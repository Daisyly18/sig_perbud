<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreAquacultureRequest;
use App\Http\Requests\UpdateAquacultureRequest;
use App\Models\Aquaculture as ModelsAquaculture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AquacultureController extends Controller
{
    public function index()
    {
        $aquacultures = ModelsAquaculture::orderBy('created_at', 'DESC')->get();
        return view('pages.aquaculture.index', compact('aquacultures'));
    }

    public function create()
    {
        return view('pages.aquaculture.create');
    }
    public function store(StoreAquacultureRequest $request):RedirectResponse
    {
        try {
            $imagePath = $request->file('imagePonds')->store('image', 'public');  

            ModelsAquaculture::create([
                'ponds' => $request->ponds,
                'gender' => $request->gender,
                'district' => $request->district,
                'village' => $request->village,
                'pondArea' => $request->pondArea,
                'imagePonds' => $imagePath,
                'status' => $request->status,
                'cultivationType' => $request->cultivationType,
                'cultivationStage' => $request->cultivationStage,
                'coordinate' => $request->coordinate,                

            ]);
            return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Disimpan!']);
                                            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
        

    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsAquaculture $aquaculture)
    {
        return view('pages.aquaculture.edit', compact('aquaculture'));
    }

    public function update(UpdateAquacultureRequest $request, ModelsAquaculture $aquaculture)
    {
        try {
            $hasImage = $request->hasFile('imagePonds');

            $aquaculture->ponds = $request->ponds;
            $aquaculture->gender = $request->gender;
            $aquaculture->district = $request->district;
            $aquaculture->village = $request->village;
            $aquaculture->pondArea = $request->pondArea;

            if ($hasImage) {
                // Menyimpan file gambar
                $imagePath = $request->file('imagePonds')->store('image', 'public');
                $aquaculture->imagePonds = $imagePath;
            }

            $aquaculture->status = $request->status;
            $aquaculture->cultivationType = $request->cultivationType;
            $aquaculture->cultivationStage = $request->cultivationStage;
            $aquaculture->coordinate = $request->coordinate;

            return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Diupdate!']);

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());

        }
    }

    public function destroy(ModelsAquaculture $aquaculture)
    {
        $aquaculture->delete();

        return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function map()
{
    $aquacultures = ModelsAquaculture::all();
    $geojsonFeatures = [];

    foreach ($aquacultures as $aquaculture) {
        // Mengonversi string JSON koordinat menjadi array PHP
        $coordinate = json_decode($aquaculture->coordinate, true);

        // Pastikan koordinat dalam format yang sesuai dengan GeoJSON
        $coordinates = $coordinate['coordinates'];

        $geojsonFeatures[] = [
            'type' => 'Feature',
            'properties' => [
                // Sesuaikan dengan properti yang sesuai dengan data aquaculture Anda
                'ponds' => $aquaculture->ponds,
                'gender' => $aquaculture->gender,
                // Tambahkan properti lain yang diperlukan
            ],
            'geometry' => [
                'type' => 'MultiPolygon',
                'coordinates' => $coordinates
            ]
        ];
    }
    // Jika permintaan datang dari rute '/map', render tampilan peta dan kirimkan data polygon ke tampilan
    if (request()->is('map')) {
        return view('map', [
            'geojsonFeatures' => json_encode([
                'type' => 'FeatureCollection',
                'features' => $geojsonFeatures
            ])
        ]);
    }


    // Kembalikan data GeoJSON sebagai respons JSON
    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $geojsonFeatures
    ]);

    // Jika permintaan datang dari rute '/map', render tampilan peta dan kirimkan data polygon ke tampilan
    
}


}