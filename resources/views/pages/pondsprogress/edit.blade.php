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
      <form action="{{route('pondsProgress.update', $aquaculture->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')         
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
            <label style="font-weight:bold" for="imagePonds">Foto Tambak</label>
          </div>
          <div class="col-sm-10">
            <input type="file" class="form-control @error('imagePonds') border-danger @enderror" id="imagePonds" 
            name="imagePonds" value="{{$aquaculture->imagePonds}}">
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