@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Pamflet</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @if (Auth::user()->role == 'admin')
              <a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            @elseif (Auth::user()->role == 'user')
              <a href="{{route('user.dashboard')}}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item">
              @if (Auth::user()->role == 'admin')
                <a href="{{route('admin.pamflet.index')}}"></a>Pamflet</li>
              @elseif (Auth::user()->role == 'user')
                <a href="{{route('user.pamflet.index')}}"></a>Pamflet</li>
              @endif
            <li class="breadcrumb-item active">Tambah Pamflet</li>
          </ol> 
        </div><!-- /.col -->
      </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
  <form method="POST" action="
  @if (Auth::user()->role == 'admin')
  {{route('admin.pamflet.store')}}
  @elseif (Auth::user()->role == 'user')
    {{route('user.pamflet.store')}}
  @endif
  " enctype="multipart/form-data">      
    @csrf
    <div class="card card-primary">
        <div class="card-body">
            <div class="row justify-content-md-center">
              <div class="col">
                <div class="form-group">
                  <label>Judul</label>
                  <input class="form-control" name="judul" id="judul" value="{{old('judul')}}">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea input class="form-control" name="deskripsi" id="deskripsi" rows="6">{{old('deskripsi')}}</textarea>
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Unggah File</label>
                  <input class="form-control" type="file" name="file" id="formFile">
                  <p class="red-text">Maksimal 10 MB<br>Format File yang diterima: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX</p>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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
@endsection
