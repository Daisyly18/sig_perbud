<?php

namespace App\Http\Controllers;

use App\Models\Aquaculture;
use App\Http\Requests\StoreAquacultureRequest;
use App\Http\Requests\UpdateAquacultureRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class AquacultureController extends Controller
{
    public function index()
    {
        $aquacultures = Aquaculture::orderBy('created_at', 'DESC')->get();
        
        return view('pages.aquaculture.index', compact('aquacultures'));
    }

    public function create()
    {
        return view('pages.aquaculture.create');
    }

    public function store(StoreAquacultureRequest $request): RedirectResponse
    {
        try {    
            $geojsonFilename = $request->file('geojsonPonds')->getClientOriginalName();
            $imageFilename = $request->file('imagePonds')->getClientOriginalName();

            // Menyimpan file dengan nama yang sama dengan file asli
            $geojsonPath = $request->file('geojsonPonds')->storeAs('storage', $geojsonFilename);
            $imagePath = $request->file('imagePonds')->storeAs('storage', $imageFilename);

            Aquaculture::create([
                'ponds' => $request->ponds,
                'gender' => $request->gender,
                'district' => $request->district,
                'village' => $request->village,
                'geojsonPonds' => $geojsonPath,
                'imagePonds' => $imagePath,
                'cultivationType' => $request->cultivationType,
                'pondArea' => $request->pondArea,
                'cultivationStage' => $request->cultivationStage,
                'status' => $request->status,
            ]);
            

            return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }

    public function show(Aquaculture $aquaculture)
    {

    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aquaculture $aquaculture)
    {        
        return view('pages.aquaculture.edit', compact('aquaculture'));
    }

    public function update(UpdateAquacultureRequest $request, Aquaculture $aquaculture)
    {
        try{
            $hasGeojson = $request->hasFile('geojsonPonds');
            $hasImage = $request->hasFile('imagePonds');

            $aquaculture->ponds = $request->ponds;
            $aquaculture->gender = $request->gender;
            $aquaculture->district = $request->district;
            $aquaculture->village = $request->village;

            if ($hasGeojson) {
                // Dapatkan nama file asli dari inputan pengguna
                $originalGeojsonFilename = $request->file('geojsonPonds')->getClientOriginalName();

                // Simpan file dengan nama asli
                $geojsonPath = $request->file('geojsonPonds')->storeAs('storage', $originalGeojsonFilename);
                $aquaculture->geojsonPonds = $geojsonPath;
            } else {
                // Berikan nilai default atau null jika file tidak ada
                $aquaculture->geojsonPonds = ''; // Atau ganti dengan nilai default yang sesuai
            }

            if ($hasImage) {
                // Dapatkan nama file asli dari inputan pengguna
                $originalImageFilename = $request->file('imagePonds')->getClientOriginalName();

                // Simpan file dengan nama asli
                $imagePath = $request->file('imagePonds')->storeAs('storage', $originalImageFilename);
                $aquaculture->imagePonds = $imagePath;
            } else {
                // Berikan nilai default atau null jika file tidak ada
                $aquaculture->imagePonds = ''; // Atau ganti dengan nilai default yang sesuai
            }

            $aquaculture->cultivationType = $request->cultivationType;
            $aquaculture->pondArea = $request->pondArea;
            $aquaculture->cultivationStage = $request->cultivationStage;
            $aquaculture->status = $request->status;
            $aquaculture->update();

            return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aquaculture $aquaculture)
    {
        $aquaculture->delete();

        return redirect()->route('aquaculture.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
