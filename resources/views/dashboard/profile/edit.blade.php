@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Data</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              @if (Auth::user()->role == 'admin')
                  <a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              @elseif (Auth::user()->role == 'user')
                  <a href="{{route('user.dashboard')}}">Dashboard</a></li>
              @endif
            <li class="breadcrumb-item">
              @if (Auth::user()->role == 'admin')
                <a href="{{route('admin.profile.index')}}">Dashboard</a></li>
              @elseif (Auth::user()->role == 'user')
                <a href="{{route('user.profile.index')}}">Dashboard</a></li>
              @endif
            <li class="breadcrumb-item active">Ubah Profil</li>
          </ol> 
        </div><!-- /.col -->
      </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
  <form method="POST" action=" 
    @if (Auth::user()->role === "admin") 
      {{route('admin.profile.update')}}
    @elseif (Auth::user()->role === "user")
      {{route('user.profile.update')}}
    @endif
  " enctype="multipart/form-data">      
    @csrf
    @method('PUT')
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="Nama Lengkap" aria-describedby="name.">
        </div>
        <div class="form-group">
          <label>Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label>Password (Minimal 8 karakter)</label>
          <input type="password" class="form-control" value="" name="password" id="password" placeholder="Password" aria-describedby="Password">
        </div>   
        {{-- <div class="form-group">
          <label for="">Role</label>
          <select class="custom-select" name="role" id="role">
            <option selected disabled>-- Pilih Role --</option>
            <option @if(old('role') == 'admin') selected @endif value="admin">Admin</option>
            <option @if(old('role') == 'user') selected @endif value="user">User</option>
          </select>
        </div> --}}
        <div class="form-group">
          <label for="formFile" class="form-label">Upload Foto (opsional)</label><br>
          @if ($user->foto)
            <img src="/foto_user/{{$user->foto}}" alt="Admin" class="rounded-circle" width="200" height="200">
          @else
            <img src="/asset/defaultphoto.png" alt="Admin" class="rounded-circle" width="200" height="200">
          @endif  
          <input class="form-control" value="{{ old('foto') }}" type="file" name="foto" id="formFile">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="form-group">
          <input type="submit" class="btn btn-success" value="Simpan">
        </div>
      </div>
  </div>
  </form>
</section>

<script>
  $(function() {
    $('input[name="tanggal_lahir"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1901,
      maxYear: parseInt(moment().format('YYYY'),10)
    }, function(start, end, label) {
      var years = moment().diff(start, 'years');
      //alert("You are " + years + " years old!");
    });
  });
</script>
@endsection
