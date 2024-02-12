@extends('layouts.main')
@section('title', 'Edit Data')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
        <span>&times;</span>
        </button>
        <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    </div>  
@endif
<div class="card">
  <div class="card-header">
      <h4>Edit Data</h4>
  </div>
  <div class="card-body">
      <form action="{{route('pondsProgress.update', $pondsProgress->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="ponds">Pembudidaya</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('ponds') border-danger @enderror" id="ponds" name="ponds" value="{{$pondsProgress->ponds}}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="gender">Jenis Kelamin</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('gender') border-danger @enderror" id="gender" 
            name="gender" value="{{$pondsProgress->gender}}">
              <option>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="district">Kecamatan</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('district') border-danger @enderror" id="district" 
            name="district" value="{{$pondsProgress->district}}">
              <option>Kecamatan 1</option>
              <option>Kecamatan 2</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="village">Desa/Keluarahan</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('village') border-danger @enderror" id="village" 
            name="village" value="{{$pondsProgress->village}}">
              <option>Desa</option>
              <option>Kelurahan</option>
            </select>
          </div>
        </div>    
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="imagePonds">Foto Tambak</label>
          </div>
          <div class="col-sm-10">
            <input type="file" class="form-control @error('imagePonds') border-danger @enderror" id="imagePonds" 
            name="imagePonds" value="{{$pondsProgress->imagePonds}}">
          </div>
        </div>        
        <div class="row mb-3">
          <div class="col-sm-2">
            <label style="font-weight:bold" for="cultivationType">Jenis Budi Daya</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('cultivationType') border-danger @enderror" id="cultivationType" 
            name="cultivationType" value="{{$pondsProgress->cultivationType}}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="cultivationStage">Tahap Budi Daya</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('cultivationStage') border-danger @enderror" id="cultivationStage" 
            name="cultivationStage" value="{{$pondsProgress->cultivationStage}}">
              <option>Tahap Awal</option>
              <option>Tahap Pembesaran</option>
              <option>Tahap Panen</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="status">Status</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('status') border-danger @enderror" id="status" 
            name="status" value="{{$pondsProgress->status}}">        
              <option>Aktif</option>
              <option>Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="number">Number</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('number') border-danger @enderror" id="number" name="number" value="{{$pondsProgress->number}}">
          </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-primary mr-1" type="submit">Update</button>
          <button class="btn btn-danger" type="reset">Batal</button>
        </div>
      </form>
  </div>
</div>
    
@endsection