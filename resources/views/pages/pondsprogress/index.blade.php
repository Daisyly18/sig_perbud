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
          {{-- <a href="{{route('aquaculture.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>  --}}
          <a href="#" class="btn btn-sm btn-success"><i class="fas fa-file-export"></i> Eksport</a>
        </div>
      </div>
        <div class="card-body p-2">
          <div class="table-responsive">
            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th class="text-nowrap">Nama Pembudidaya</th>
                  <th class="text-nowrap">Jenis Kelamin</th>
                  <th class="text-nowrap">Kecamatan</th>
                  <th class="text-nowrap">Desa/Keluarahan</th>              
                  <th class="text-nowrap">Luas Tambak</th>
                  <th class="text-nowrap text-center">Status</th>
                  <th class="text-nowrap">Jenis Budidaya</th>
                  <th class="text-nowrap">Tahap Budi Daya</th>                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($aquacultures as $aquaculture)
                <tr>  
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-nowrap">{{$aquaculture->ponds}}</td>
                  <td>{{$aquaculture->gender}}</td>
                  <td >{{$aquaculture->district}}</td>
                  <td>{{$aquaculture->village}}</td>
                  <td class="text-center text-nowrap">{{$aquaculture->pondArea}}</td>
                  <td class="text-center text-nowrap">
                    @if($aquaculture->status == 'Aktif')
                        <div class="badge badge-success">{{ $aquaculture->status }}</div>
                    @else
                        <div class="badge badge-danger">{{ $aquaculture->status }}</div>
                    @endif
                  </td>
                  <td class="text-nowrap">{{$aquaculture->cultivationType}}</td>
                  <td class="text-nowrap">{{$aquaculture->cultivationStage}}</td>                  
                  <td class="text-nowrap  d-flex align-items-center">
                    <a href="{{route('pondsProgress.edit', $aquaculture->id) }}" class="btn btn-warning">Update</a>                                    
                  </td>                
                </tr>
                @endforeach
              </tbody>              
            </table>
          </div>
        </div>
    </div>
  </div>         
@endsection