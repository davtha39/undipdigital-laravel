@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0">Profil Akun</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          @if (Auth::user()->role == 'admin')
              <a href="{{route('admin.dashboard')}}">Dashboard</a></li>
          @elseif (Auth::user()->role == 'user')
              <a href="{{route('user.dashboard')}}">Dashboard</a></li>
          @endif
        <li class="breadcrumb-item active">Profil Akun</li>
        </ol> 
      </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content section about-section gray-bg" id="about">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                @if ($user->foto)
                  <img src="/foto_user/{{$user->foto}}" alt="Admin" class="rounded-circle" width="200" height="200">
                @else
                  <img src="/asset/defaultphoto.png" alt="Admin" class="rounded-circle" width="200" height="200">
                @endif
                <div class="mt-3">
                  <h4>{{$user->name}}</h4>
                  <p class="text-secondary mb-1">{{$user->role}}</p>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="float-center">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nama</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$user->name}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$user->email}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Role</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$user->role}}
                </div>
              </div>
              <hr>
            </div>
            <div class="card-footer">
              <div class="float-right">
                @if (Auth::user()->role == "admin")
                  <a type="button" class="btn btn-info" href="{{route('admin.profile.edit')}}"><i class="fas fa-pencil-alt"></i> Ubah</a>
                @elseif (Auth::user()->role == "user")
                  <a type="button" class="btn btn-info" href="{{route('user.profile.edit')}}"><i class="fas fa-pencil-alt"></i> Ubah</a>
                @endif
              </div>
            </div>
          </div>
        </div>
</section>

@endsection
