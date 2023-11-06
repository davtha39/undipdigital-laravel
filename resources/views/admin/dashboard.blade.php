@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ __('Dashboard Admin') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#">Home</a></li>
          </ol> 
        </div><!-- /.col -->
      </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$totaluser}}</h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="fa fa-address-card"></i>
            </div>
            <a href="{{route('admin.user.index')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalguideline}}</h3>

            <p>Guideline</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="{{route('admin.guideline.index')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalmagazine}}</h3>

            <p>Magazine</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="{{route('admin.magazine.index')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalebook}}</h3>

            <p>Ebook</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="{{route('admin.ebook.index')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalpamflet}}</h3>

            <p>Pamflet</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="{{route('admin.pamflet.index')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection