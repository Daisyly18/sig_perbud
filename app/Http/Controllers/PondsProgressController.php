<?php

namespace App\Http\Controllers;
use App\Models\Aquaculture as ModelsAquaculture;
use App\Http\Requests\UpdatePondsProgressRequest;
use Illuminate\Http\Request;

class PondsProgressController extends Controller
{
    public function index()
    {
        $aquacultures = ModelsAquaculture::orderBy('created_at', 'DESC')->get();
        return view('pages.pondsProgress.index', compact('aquacultures')); 
    }

    public function edit(ModelsAquaculture $aquaculture, $id)
    {
        $aquaculture = ModelsAquaculture::findOrFail($id); 
        return view('pages.pondsProgress.edit', compact('aquaculture'));
    }

    public function update(UpdatePondsProgressRequest $request, ModelsAquaculture $aquaculture, $id)
    {
        try {
            $aquaculture = ModelsAquaculture::findOrFail($id); 
            
            $image = $request->file('imagePonds');
     

            $aquaculture->ponds = $request->ponds;
            $aquaculture->gender = $request->gender;
            if ($image) {
                // Simpan gambar dengan nama aslinya
                $imagePath = $image->storeAs('public/images', $image->getClientOriginalName());
                $aquaculture->imagePonds = $imagePath;
            }       

            $aquaculture->status = $request->status;
            $aquaculture->cultivationType = $request->cultivationType;
            $aquaculture->cultivationStage = $request->cultivationStage;


            $aquaculture->save();

            return redirect()->route('pondsProgress.index')->with(['success' => 'Data Berhasil Diupdate!']);

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }
}
