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
          @if (Auth::user()->role != 'Kepala Dinas')
          <a href="{{route('aquaculture.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a> 
          @endif
          <a href="{{route('aquaculture.export')}}" class="btn  btn-success"><i class="fas fa-file-export"></i> Eksport</a>
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
                  <th class="text-nowrap text-center">Kecamatan</th>
                  <th class="text-nowrap text-center">Desa/Keluarahan</th>              
                  <th class="text-nowrap">Luas Tambak</th>
                  <th class="text-nowrap text-center">Status</th>
                  <th class="text-nowrap">Jenis Budidaya</th>
                  <th class="text-nowrap">Tahap Budi Daya</th>
                  @if (Auth::user()->role != 'Kepala Dinas')
                  <th class="text-nowrap text-center">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($aquacultures as $aquaculture)
                <tr>  
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-nowrap">{{$aquaculture->ponds}}</td>
                  <td class="text-nowrap text-center">{{$aquaculture->gender}}</td>
                  <td class="text-nowrap text-center">{{$aquaculture->district}}</td>
                  <td class="text-nowrap text-center">{{$aquaculture->village}}</td>
                  <td class="text-center">{{$aquaculture->pondArea}}</td>
                  <td class="text-nowrap text-center">
                    @if($aquaculture->status == 'Aktif')
                        <div class="badge badge-success">{{ $aquaculture->status }}</div>
                    @else
                        <div class="badge badge-danger">{{ $aquaculture->status }}</div>
                    @endif
                  </td>
                  <td class="text-nowrap text-center">{{$aquaculture->cultivationType}}</td>
                  <td class="text-nowrap text-center">{{$aquaculture->cultivationStage}}</td>  
                  @if (Auth::user()->role != 'Kepala Dinas')
                  <td class="d-flex align-items-center">
                    <a href="{{route('aquaculture.edit', $aquaculture->id) }}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-edit"></i></a>                
                    <form method="POST" action="{{ route('aquaculture.destroy', $aquaculture->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i></button>
                  </form>          
                  </td>     
                  @endif     
                </tr>
                @endforeach
              </tbody>              
            </table>
          </div>
        </div>      
    </div>
  </div>       
@endsection