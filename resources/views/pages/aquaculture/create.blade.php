@extends('layouts.main')
@section('title', 'Tambah Data')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@0.4.14/dist/leaflet.draw.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-toolbar/dist/leaflet.toolbar.css" />

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
              <label style="font-weight:bold" for="ponds">Nama Pembudidaya</label>
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
                <option>Pria</option>
                <option>Wanita</option>
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
              <option value="">Pilih Kecamatan</option>
              <option value="kecamatan1">Buntulia</option>
              <option value="kecamatan2">Dengilo</option>
              <option value="kecamatan3">Paguat</option>
              <option value="kecamatan4">Marisa</option>
              <option value="kecamatan5">Duhiadaa</option>
              <option value="kecamatan6">Lemito</option>
              <option value="kecamatan7">Taluditi</option>
              <option value="kecamatan8">Randangan</option>
              <option value="kecamatan9">Wanggarasi</option>
              <option value="kecamatan10">Popayato</option>
              <option value="kecamatan11">Popayato Timur</option>
              <option value="kecamatan12">Popayato Barat</option>
              <option value="kecamatan13">Patilanggio</option>
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
                <option value="">Pilih Desa/Kelurahan</option>
              </select>
            </div>
          </div> 
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="pondArea">Luas Tambak (m^2)</label>
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
            <div class="label col-sm-2 col-form-label">
                <label style="font-weight:bold" for="status">Status</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control @error('status') border-danger @enderror" id="status" name="status" value="{{ old('status') }}">
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <option>Tidak Aktif</option>
                    <option>Aktif</option>
                </select>
            </div>
        </div>        
        <div class="row mb-3" >
            <div class="col-sm-2 col-form-label">
                <label style="font-weight:bold" for="cultivationType" id="cultivationType">Jenis Budi Daya</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('cultivationType') border-danger @enderror" id="cultivationTypeInput" name="cultivationType" value="{{ old('cultivationType') }}">
                @error('cultivationType')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>      
        <div class="row mb-3" >
            <div class="label col-sm-2 col-form-label">
                <label style="font-weight:bold" for="cultivationStage" id="cultivationStage" >Tahap Budi Daya</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control @error('cultivationStage') border-danger @enderror" id="cultivationStageSelect" name="cultivationStage" value="{{ old('cultivationStage') }}">
                    @error('cultivationStage')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <option>Tahap Awal</option>
                    <option>Tahap Pembesaran</option>
                    <option>Tahap Panen</option>
                </select>
            </div>
        </div>          
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">Tambah</button>
            <button class="btn btn-danger" type="reset">Batal</button>
          </div>
        </form>
    </div>
</div>  


<script>
// Objek untuk menyimpan desa/kelurahan untuk setiap kecamatan
var villagesByDistrict = {
        kecamatan1: ['Desa Buntulia Tengah', 'Desa 2', 'Desa 3'],
        kecamatan2: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan3: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan4: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan5: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan6: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan7: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan8: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan9: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan10: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan11: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan12: ['Desa A', 'Desa B', 'Desa C'],        
        kecamatan13: ['Desa A', 'Desa B', 'Desa C'],        
    };

    document.getElementById('district').addEventListener('change', function () {
        var district = this.value;
        var villageSelect = document.getElementById('village');
        villageSelect.innerHTML = ''; // Clear existing options
        
        if (district && villagesByDistrict[district]) {
            villagesByDistrict[district].forEach(function (village) {
                var option = document.createElement('option');
                option.text = village;
                option.value = village;
                villageSelect.appendChild(option);
            });
        } else {
            var option = document.createElement('option');
            option.text = 'Pilih Desa/Kelurahan';
            villageSelect.appendChild(option);
        }
    });

  //event Listener form status 
   document.addEventListener('DOMContentLoaded', function() {
        const status = document.getElementById('status').value;
        toggleForms(status);
    });

    document.getElementById('status').addEventListener('change', function() {
        const status = this.value;
        toggleForms(status);
    });

    function toggleForms(status) {
        const cultivationType = document.getElementById('cultivationType');
        const cultivationTypeInput = document.getElementById('cultivationTypeInput');
        const cultivationStage = document.getElementById('cultivationStage');
        const cultivationStageSelect = document.getElementById('cultivationStageSelect');

        if (status === 'Aktif') {
          cultivationType.style.display = 'block';
          cultivationTypeInput.style.display = 'block';
          cultivationStage.style.display = 'block';
          cultivationStageSelect.style.display = 'block';
        } else {
          cultivationType.style.display = 'none';
          cultivationTypeInput.style.display = 'none';
          cultivationStage.style.display = 'none';
          cultivationStageSelect.style.display = 'none';
        }
    }
</script>    

@endsection

