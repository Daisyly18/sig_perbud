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
        $results = ModelsAquaculture::all();
        return response()->json($results);
    }

}