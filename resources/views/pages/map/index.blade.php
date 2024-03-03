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
       
@endsection