@extends('layouts.main')
@section('title', 'Data User')
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

@push('style')

<style>
    /* Gaya untuk pagination dan show entries */
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        margin-top: 10px;
    }

    .dataTables_wrapper .dataTables_length {
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length label {
        font-weight: 600;
        margin-right: 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        width: 75px;
        padding: 6px;
        border-radius: 4px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin-right: 10px;
    }
</style>

@endpush
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <div class="buttons">
                <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>            
                <a href="{{route('user.export')}}" class="btn  btn-success"><i class="fas fa-file-export"></i> Eksport</a>
            </div>
          </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped " id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="d-flex align-items-center">
                                <a href="{{route('user.edit', $user->id) }}" class="btn btn-icon icon-left btn-warning"><i class="fas fa-edit"></i></a>                
                                <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i></button>
                                </form>          
                            </td>                             
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <div class="flex mb-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Tambah</a>
                        </div>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection