<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePondsProgressRequest;
use App\Http\Requests\UpdatePondsProgressRequest;
use App\Models\PondsProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PondsProgressController extends Controller
{
    public function index () 
    {
        $pondsProgress = PondsProgress::all();
        return view('pages.pondsProgress.index', compact('pondsProgress'));
    }

    public function create() 
    {
        return view('pages.pondsProgress.create');
    }

    public function store(StorePondsProgressRequest $request): RedirectResponse 
    {
        try {
            $imageFilename = $request->file('imagePonds')->getClientOriginalName();
            $imagePath = $request->file('imagePonds')->storeAs('storage', $imageFilename);                

            PondsProgress::create([
                'ponds' => $request->ponds,
                'gender' => $request->gender,
                'district' => $request->district,
                'village' => $request->village,
                'imagePonds' => $imagePath,
                'cultivationType' => $request->cultivationType,
                'cultivationStage' => $request->cultivationStage,
                'status' => $request->status,
                'number' => $request->number,
            ]);
            return redirect()->route('pondsProgress.index')->with(['success' => 'Data Berhasil Disimpan!']);

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }

    public function edit (PondsProgress $pondsProgress)
    {
        return view('pages.pondsProgress.edit', compact('pondsProgress'));
    }

    public function update (UpdatePondsProgressRequest $request, PondsProgress $pondsProgress)
    {
        try {
            $hasImage = $request->hasFile('imagePonds');     
            
            $pondsProgress->ponds = $request->ponds;
            $pondsProgress->gender = $request->gender;
            $pondsProgress->district = $request->district;
            $pondsProgress->village = $request->village;

            if ($hasImage) {
                // Dapatkan nama file asli dari inputan pengguna
                $originalImageFilename = $request->file('imagePonds')->getClientOriginalName();

                // Simpan file dengan nama asli
                $imagePath = $request->file('imagePonds')->storeAs('storage', $originalImageFilename);
                $pondsProgress->imagePonds = $imagePath;
            } else {
                // Berikan nilai default atau null jika file tidak ada
                $pondsProgress->imagePonds = ''; // Atau ganti dengan nilai default yang sesuai
            }

            $pondsProgress->cultivationType = $request->cultivationType;
            $pondsProgress->cultivationStage = $request->cultivationStage;
            $pondsProgress->status = $request->status;
            $pondsProgress->status = $request->number;
            $pondsProgress->update();
            
            return redirect()->route('pondsProgress.index')->with(['success' => 'Data Berhasil Diupdate!']);

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }
    public function destroy(PondsProgress $pondsProgress)
    {
        $pondsProgress->delete();

        return redirect()->route('pondsProgress.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
