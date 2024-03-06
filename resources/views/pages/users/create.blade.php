@extends('layouts.main')
@section('title', 'Tambah User')
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
        <h4>User Information</h4>
    </div>
    <div class="card-body py-4-5 px-4"> 
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-12 col-md-3"><label for="username" style="font-weight:bold"
                        class="mb-md-0 w-100 mb-2 text-start">Username</label>
                    </div>
                <div class="col-12 col-md-9">
                    <input type="text" class="form-control @error('username') border-danger @enderror"
                        id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-3"><label for="email" style="font-weight:bold"
                        class="mb-md-0 w-100 mb-2 text-start">Email</label></div>
                <div class="col-12 col-md-9">
                    <input type="email" class="form-control @error('email') border-danger @enderror"
                        id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-3"><label for="role" style="font-weight:bold"
                        class="mb-md-0 w-100 mb-2 text-start">Role</label></div>
                <div class="col-12 col-md-9">
                    <select class="form-control w-100" name="role" id="role" required>                                    
                        <option value="Penyuluh" {{ old('role')=='Penyuluh' ? 'selected' : '' }}>Penyuluh</option>
                        <option value="Pimpinan" {{ old('role')=='Pimpinan' ? 'selected' : '' }}>Kepala Dinas</option>                                   
                    </select>
                    @error('role')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>                        
            <div class="row mb-3">
                <div class="col-12 col-md-3"><label for="password" style="font-weight:bold"
                        class="mb-md-0 w-100 mb-2 text-start">Password</label></div>
                <div class="col-12 col-md-9">
                    <input type="password" class="form-control @error('password') border-danger @enderror"
                        id="password" name="password" required>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-3"><label for="password_confirmation" style="font-weight:bold"
                        class="mb-md-0 w-100 mb-2 text-start">Confirm Password</label></div>
                <div class="col-12 col-md-9">
                    <input type="password"
                        class="form-control @error('password_confirmation') border-danger @enderror"
                        id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
</div>


@endsection