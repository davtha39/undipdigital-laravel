@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">User</a></li>
            <li class="breadcrumb-item active">Tambah User</li>
          </ol> 
        </div><!-- /.col -->
      </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
  <form method="POST" action="{{route('admin.user.store')}}" enctype="multipart/form-data">      
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Nama Lengkap" aria-describedby="name.">
          </div>
          <div class="form-group">
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label>Password (Minimal 8 karakter)</label>
            <input type="password" class="form-control" value="{{ old('password') }}" name="password" id="password" placeholder="Password" aria-describedby="Password">
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
            <label for="formFile" class="form-label">Upload Foto (opsional)</label>
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
  function showConfirm() {
      Swal.fire({
          title: 'Konfirmasi Tambah User',
          text: "Apakah anda yakin ingin menambahkan data User?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
      }).then((result) => {
          if (result.isConfirmed) {
              // if the user confirms the deletion, submit the form
              document.querySelector('form').submit();
          }
      });
  }
</script>
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
