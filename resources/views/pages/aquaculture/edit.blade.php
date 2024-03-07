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
      <form action="{{route('aquaculture.update', $aquaculture->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" class="text-nowrap" for="geojsonPonds">Data Geojson Tambak</label>
            </div>
            <div class="col-sm-10">
              <input type="file" class="form-control @error('geojsonPonds') border-danger @enderror" id="geojsonPonds" accept=".geojson, .json. js"
              name="geojsonPonds" value="{{$aquaculture->geojsonPonds}}">
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
            <input type="text" class="form-control @error('ponds') border-danger @enderror" id="ponds" name="ponds" value="{{$aquaculture->ponds}}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="gender">Jenis Kelamin</label>
          </div>
          <div class="col-sm-10">
            <select class="form-control @error('gender') border-danger @enderror" id="gender" 
            name="gender" value="{{$aquaculture->gender}}">
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
            name="district" value="{{$aquaculture->district}}">
            @error('district')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
            <option value="">Pilih Kecamatan</option>
            <option value="Kecamatan 1">Buntulia</option>
            <option value="Dengilo">Dengilo</option>
            <option value="Paguat">Paguat</option>
            <option value="Marisa">Marisa</option>
            <option value="Duhiadaa">Duhiadaa</option>
            <option value="Lemito">Lemito</option>
            <option value="Taluditi">Taluditi</option>
            <option value="Randangan">Randangan</option>
            <option value="Wanggarasi">Wanggarasi</option>
            <option value="Popayato">Popayato</option>
            <option value="Popayato Timur">Popayato Timur</option>
            <option value="Popayato Barat">Popayato Barat</option>
            <option value="Patilanggio">Patilanggio</option>
            </select>
          </div>
        </div>      
        <div class="row mb-3">
            <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="village">Desa/Keluarahan</label>
            </div>
            <div class="col-sm-10">
              <select class="form-control @error('village') border-danger @enderror" id="village" 
              name="village" value="{{$aquaculture->village}}">
              @error('village')
              <span class="text-danger">{{ $message }}</span>
              @enderror
                <option value="">Pilih Desa/Kelurahan</option>
              </select>
            </div>
          </div>           
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="pondArea">Luas Tambak</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control @error('pondArea') border-danger @enderror" id="pondArea" 
            name="pondArea" value="{{$aquaculture->pondArea}}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
            <label style="font-weight:bold" for="imagePonds">Foto Tambak</label>
          </div>
          <div class="col-sm-10">            
            <input type="file" class="form-control @error('imagePonds') border-danger @enderror" id="imagePonds" 
            name="imagePonds" value="{{$aquaculture->imagePonds}}" >
          </div>
        </div>   
        <div class="row mb-3">
          <div class="label col-sm-2 col-form-label">
              <label style="font-weight:bold" for="status">Status</label>
          </div>
          <div class="col-sm-10">
              <select class="form-control @error('status') border-danger @enderror" id="status" name="status" value="{{$aquaculture->status}}">
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
              <input type="text" class="form-control @error('cultivationType') border-danger @enderror" id="cultivationTypeInput" name="cultivationType" value="{{$aquaculture->cultivationType}}">
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
                <select class="form-control @error('cultivationStage') border-danger @enderror" id="cultivationStageSelect" name="cultivationStage" value="{{$aquaculture->cultivationStage}}">
                    @error('cultivationStage')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <option value="">Pilih Tahap Budidaya</option>
                    <option>Tahap Awal</option>
                    <option>Tahap Pembesaran</option>
                    <option>Tahap Panen</option>
                </select>
            </div>
        </div>      
    </div>
    <div class="card-footer text-right">
      <button class="btn btn-primary mr-1" type="submit">Update</button>
      <button class="btn btn-danger" type="reset">Batal</button>
    </div>
  </form>
  </div>
</div>
<script>
 // Objek untuk menyimpan desa/kelurahan untuk setiap kecamatan
const villagesByDistrict = {
    "Buntulia": ['Buntulia Tengah', 'Buntulia Utara', 'Hulawa', 'Karya Indah', 'Sipatana', 'Taluduyunu', 'Taluduyunu Utara'],
    "Dengilo": ['Hutamoputi', 'Karangetang', 'Karya Baru', 'Padengo', 'Popaya'],        
    "Paguat": ['Molamahu', 'Bunuyo', 'Kemiri', 'Bumbulan', 'Sipayo', 'Soginti', 'Buhu Jaya', 'Maleo', 'Kelurahan Pentadu', 'Kelurahan Siduan', 'Kelurahan Libuo'],        
    "Marisa": ['Botubilitahu', 'Bulangito', 'Marisa Selatan', 'Marisa Utara', 'Palopo', 'Pohuwato', 'Pohuwato Timur', 'Teratai'],        
    "Duhiadaa": ['Bulili', 'Buntulia Barat', 'Buntulia Jaya', 'Buntulia Selatan', 'Duhiadaa', 'Mekar Jaya', 'Mootilango', 'Padengo'],        
    "Lemito": ['Bobalonge', 'Kenari', 'Lemito', 'Lemito Utara', 'Lomuli', 'Suka Damai', 'Wanggarasi Barat', 'Wanggarasi Tengah'],        
    "Taluditi": ['Kalimas', 'Makarti Jaya', 'Malango', 'Marisa IV', 'Pancakarsa I', 'Pancakarsa II', 'Tirto Asri'],        
    "Randangan": ['Ayula', 'Banuraja', 'Huyula', 'Imbodu', 'Manunggal Karya', 'Motolohu', 'Motolohu Selatan', 'Omayuwa', 'Patuhu', 'Pelambane', 'Sari Murni', 'Sido Rukun', 'Sidowonge'],        
    "Wanggarasi": ['Bohusami', 'Bukit Harapan', 'Lembah Permai', 'Limbula', 'Tuweya', 'Wanggarasi Timur', 'Yipilo'],        
    "Popayato": ['Bumi Baharani', 'Bukit Tingki', 'Dambalo', 'Popayato', 'Telaga', 'Telaga Biru', 'Torosiaje', 'Torosiaje Jaya', 'Trikora', 'Tunas Harapan'],        
    "Popayato Timur": ['Bunto', 'Kelapa Lima', 'Londoun', 'Maleo', 'Marisa', 'Milangodaa','Tahele'],        
    "Popayato Barat": ['Butungale', 'Dudewulo', 'Molosifat', 'Molosifat Utara', 'Padengo', 'Persatuan', 'Tunas Jaya'],        
    "Patilanggio": ['Balayo', 'Dulomo', 'Dudepa', 'Iloheluma', 'Manawa', 'Suka Makmur']
};

document.getElementById('district').addEventListener('change', function () {
    var district = this.value;
    var villageSelect = document.getElementById('village');
    villageSelect.innerHTML = ''; // Clear existing options
    
    if (district && villagesByDistrict[district]) {
        villagesByDistrict[district].forEach(function (village) {
            var option = document.createElement('option');
            option.text = village;
            option.value = village; // Atur nilainya sesuai teks yang ditampilkan
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