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
          <a href="{{route('aquaculture.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a> 
          <a href="#" class="btn  btn-success"><i class="fas fa-file-export"></i> Eksport</a>
        </div>
      </div>
        <div class="card-body p-2">
          <div class="table-responsive">
            <table id="datatable" class="table table-striped display nowrap"> 
              <thead >
                <tr>
                  <th>#</th>
                  <th class="text-nowrap">Nama Pembudidaya</th>
                  <th class="text-nowrap">Jenis Kelamin</th>
                  <th>Kecamatan</th>
                  <th>Desa/Keluarahan</th>              
                  <th class="text-nowrap">Luas Tambak</th>
                  <th>Status</th>
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
                  <td>{{$aquaculture->district}}</td>
                  <td>{{$aquaculture->village}}</td>
                  <td>{{$aquaculture->pondArea}}</td>
                  <td>
                    @if($aquaculture->status == 'Aktif')
                        <div class="badge badge-success">{{ $aquaculture->status }}</div>
                    @else
                        <div class="badge badge-danger">{{ $aquaculture->status }}</div>
                    @endif
                  </td>
                  <td>{{$aquaculture->cultivationType}}</td>
                  <td>{{$aquaculture->cultivationStage}}</td>                  
                  <td class="d-flex align-items-center">
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
    </div>
  </div>       
@endsection