@extends('layouts.main')
@section('title', 'Tambah Data')
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
        <h4>Tambah data</h4>
    </div>
    <div class="card-body">
        <form action="{{route('aquaculture.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="ponds">Pembudidaya</label>
            </div>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('ponds') border-danger @enderror" id="ponds" name="ponds" value="{{old('ponds')}}">
              @error('ponds')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="gender">Jenis Kelamin</label>
            </div>
            <div class="col-sm-10">
              <select class="form-control @error('gender') border-danger @enderror" id="gender" 
              name="gender" value="{{old('gender')}}">
              @error('gender')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
              name="district" value="{{old('district')}}">
              @error('district')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
              name="village" value="{{old('village')}}">
              @error('village')
              <span class="text-danger">{{ $message }}</span>
              @enderror
                <option>Desa</option>
                <option>Kelurahan</option>
              </select>
            </div>
          </div> 
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" class="text-nowrap" for="geojsonPonds">Data Geojson Tambak</label>
            </div>
            <div class="col-sm-10">
              <input type="file" class="form-control @error('geojsonPonds') border-danger @enderror" id="geojsonPonds" accept=".geojson, .json. js"
              name="geojsonPonds" value="{{old('geojsonPonds')}}">
              @error('geojsonPonds')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>        
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="imagePonds">Foto Tambak</label>
            </div>
            <div class="col-sm-10">
              <input type="file" class="form-control @error('imagePonds') border-danger @enderror" id="imagePonds" 
              name="imagePonds" value="{{old('imagePonds')}}">
              @error('imagePonds')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>        
          <div class="row mb-3">
            <div class="col-sm-2">
              <label style="font-weight:bold" for="cultivationType">Jenis Budi Daya</label>
            </div>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('cultivationType') border-danger @enderror" id="cultivationType" 
              name="cultivationType" value="{{old('cultivationType')}}">
              @error('cultivationType')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="pondArea">Luas Tambak</label>
            </div>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('pondArea') border-danger @enderror" id="pondArea" 
              name="pondArea" value="{{old('pondArea')}}">
              @error('pondArea')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="cultivationStage">Tahap Budi Daya</label>
            </div>
            <div class="col-sm-10">
              <select class="form-control @error('cultivationStage') border-danger @enderror" id="cultivationStage" 
              name="cultivationStage" value="{{old('cultivationStage')}}">
              @error('cultivationStage')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
              name="status" value="{{old('status')}}">
              @error('status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
              <input type="text" class="form-control @error('number') border-danger @enderror" id="number" 
              name="number" value="{{old('number')}}">
              @error('number')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Tambah</button>
            <button class="btn btn-danger" type="reset">Batal</button>
          </div>
        </form>
    </div>
</div>  
<div class="card">
  <div id="map" style="height: 500px">
     @include('maps.maps')
  </div>
</div>

@endsection