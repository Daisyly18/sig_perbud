@extends('layouts.main')
@section('title','Daftar Perikanan Budidaya')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            {{ session('success') }}
        </div>
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button> 
            {{ session('error') }}
        </div>
    </div>
    @endif
<div class="section-body">
    <div class="card">
      <div class="card-header">
        <div class="buttons">
          <a href="{{route('aquaculture.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a> 
          <a href="#" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Eksport</a>
        </div>
      </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Pembudidaya</th>
                  <th class="text-nowrap">Jenis Kelamin</th>
                  <th>Kecamatan</th>
                  <th>Desa/Keluarahan</th>
                  <th class="text-nowrap">Data Geojson Tambak</th>
                  <th class="text-nowrap">Foto Tambak</th>
                  <th class="text-nowrap">Jenis Budidaya</th>
                  <th class="text-nowrap">Luas Tambak</th>
                  <th class="text-nowrap">Tahap Budi Daya</th>
                  <th>Status</th>
                  <th>Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($aquacultures as $aquaculture)
                <tr>  
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-nowrap">{{$aquaculture->ponds}}</td>
                  <td>{{$aquaculture->gender}}</td>
                  <td>{{$aquaculture->district}}</td>
                  <td>{{$aquaculture->village}}</td>
                  <td>{{$aquaculture->geojsonPonds}}</td>
                  <td>{{$aquaculture->imagePonds}}</td>
                  <td>{{$aquaculture->cultivationType}}</td>
                  <td>{{$aquaculture->pondArea}}</td>
                  <td>{{$aquaculture->cultivationStage}}</td>
                  <td><div class="badge badge-success">{{$aquaculture->status}}</div></td>
                  <td>{{$aquaculture->number}}</td>
                  <td class="text-nowrap  d-flex align-items-center">
                    <a href="{{route('aquaculture.edit', $aquaculture->id) }}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-edit"></i></a>                
                    <form method="POST" action="{{ route('aquaculture.destroy', $aquaculture->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i></button>
                  </form>          
                  </td>                
                </tr>
                @endforeach
              </tbody>
              
            </table>
          </div>
        </div>
      {{-- <div class="card-footer text-right">
        <nav class="d-inline-block">
          <ul class="pagination mb-0">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div> --}}
    </div>
  </div>
  <div class="card">
    <div id="map" style="height: 500px">
       @include('maps.maps')
    </div>
  </div>
    
@endsection