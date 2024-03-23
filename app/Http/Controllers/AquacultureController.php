<?php

namespace App\Http\Controllers;

use App\Exports\AquacultureExport;
use App\Http\Requests\StoreAquacultureRequest;
use App\Http\Requests\UpdateAquacultureRequest;
use App\Models\Aquaculture as ModelsAquaculture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AquacultureController extends Controller
{
    public function index()
    {
            
       // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Inisialisasi query untuk mengambil data perikanan budidaya
        $aquaculturesQuery = ModelsAquaculture::query();

        // Jika pengguna memiliki peran sebagai Admin atau Pimpinan, ambil semua data
        if ($user->role == 'Admin' || $user->role == 'Kepala Dinas') {
            $aquacultures = $aquaculturesQuery->get();
        } else {
            // Jika bukan Admin atau Pimpinan, ambil hanya data milik pengguna yang sedang login
            $aquacultures = $aquaculturesQuery->where('user_id', $user->id)->get();
        }

        // Mengirimkan data perikanan budidaya ke tampilan
        return view('pages.aquaculture.index', compact('aquacultures'));
    }

    public function create()
    {
        return view('pages.aquaculture.create');
    }
    public function store(StoreAquacultureRequest $request):RedirectResponse
    {
        try {
            $image = $request->file('imagePonds');
            $geoJSON = $request->file('geojsonPonds');

            // Simpan gambar dengan nama aslinya
            $imagePath = $image->storeAs('public/images', $image->getClientOriginalName());
            $geojsonPath = $geoJSON->storeAs('public/geojson', $geoJSON->getClientOriginalName());

            ModelsAquaculture::create([
                'geojsonPonds' => $geojsonPath,
                'ponds' => $request->ponds,
                'gender' => $request->gender,
                'district' => $request->district,
                'village' => $request->village,
                'pondArea' => $request->pondArea,
                'imagePonds' => $imagePath,
                'status' => $request->status,
                'cultivationType' => $request->cultivationType,
                'cultivationStage' => $request->cultivationStage,
                'user_id' => Auth::id(),
                               

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
            $image = $request->file('imagePonds');
            $geoJSON = $request->file('geojsonPonds');

            $aquaculture->ponds = $request->ponds;
            $aquaculture->gender = $request->gender;
            $aquaculture->district = $request->district;
            $aquaculture->village = $request->village;
            $aquaculture->pondArea = $request->pondArea;

            if ($image) {
                // Simpan gambar dengan nama aslinya
                $imagePath = $image->storeAs('public/images', $image->getClientOriginalName());
                $aquaculture->imagePonds = $imagePath;
            }

            if ($geoJSON) {
                // Simpan file GeoJSON dengan nama aslinya
                $geojsonPath = $geoJSON->storeAs('public/geojson', $geoJSON->getClientOriginalName());
                $aquaculture->geojsonPonds = $geojsonPath;
            }

            $aquaculture->status = $request->status;
            $aquaculture->cultivationType = $request->cultivationType;
            $aquaculture->cultivationStage = $request->cultivationStage; 


            $aquaculture->save();

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
        $geojsonData = [];

        foreach ($aquacultures as $aquaculture) {
            // Mendapatkan path file GeoJSON dari atribut model
            $geojsonPath = $aquaculture->geojsonPonds;

            // Mendapatkan isi file GeoJSON
            $geojsonContent = json_decode(Storage::get($geojsonPath), true);

            $imageUrl = Storage::url($aquaculture->imagePonds);

            // Menambahkan properti nama dan deskripsi ke setiap fitur GeoJSON
            foreach ($geojsonContent['features'] as &$feature) {
                $feature['properties']['id'] = $aquaculture->id;
                $feature['properties']['ponds'] = $aquaculture->ponds;
                $feature['properties']['district'] = $aquaculture->district;
                $feature['properties']['village'] = $aquaculture->village;
                $feature['properties']['pondArea'] = $aquaculture->pondArea;
                $feature['properties']['status'] = $aquaculture->status;
                $feature['properties']['cultivationType'] = $aquaculture->cultivationType;
                $feature['properties']['cultivationStage'] = $aquaculture->cultivationStage;
                $feature['properties']['imageUrl'] = $imageUrl;
            }

            $geojsonData[] = $geojsonContent;
            }

        // Kembalikan data GeoJSON sebagai respons JSON
        return response()->json([
            'geojsonData' => $geojsonData
        ]);
    }

    public function export()
    {
        $aquacultures = ModelsAquaculture::orderBy('district')->get();
        return Excel::download(new AquacultureExport($aquacultures), 'Daftar_Perikanan_Budidaya.xlsx');
        
    }
}