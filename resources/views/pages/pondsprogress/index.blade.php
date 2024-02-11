@extends('layouts.main')
@section('title', 'Perkembangan Tambak')
@section('content')
<div class="section-body">
    <div class="card">
      <div class="card-header">
        <div class="buttons">   
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
                  <th class="text-nowrap">Foto Tambak</th>
                  <th class="text-nowrap">Jenis Budidaya</th>            
                  <th class="text-nowrap">Tahap Budi Daya</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach --}}
                <tr>  
                  <td></td>
                  <td class="text-nowrap"></td>
                  <td></td>                  
                  <td></td>
                  <td></td>                
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><div class="badge badge-success"></div></td>
                  <td class="text-nowrap  d-flex align-items-center">
                    <a href="#" class="btn btn-icon icon-left btn-warning"><i class="fas fa-edit"></i></a>                               
                    <form method="POST" action="#">                      
                      <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i></button>
                  </form>          
                  </td>
                </tr>
                {{-- @endforeach --}}
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
    
@endsection