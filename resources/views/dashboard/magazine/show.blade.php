@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail Magazine</h1>
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
                    <a href="{{route('admin.magazine.index')}}">Magazine</a></li>
                @elseif (Auth::user()->role == 'user')
                    <a href="{{route('user.magazine.index')}}">Magazine</a></li>
                @endif        
            <li class="breadcrumb-item active">Detail magazine</li>
        </ol> 
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-body p-0">
            <div class="mailbox-read-info">
            <h5>{{$magazine->judul}}</h5>
            <h6>Author: {{$magazine->users->name}}
                <span class="mailbox-read-time float-right">Tanggal dibuat: {{$magazine->created_at}}</span></h6>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                {!! nl2br($magazine->deskripsi) !!}
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            @if($magazine->ext == "pdf")
            <iframe src="{{asset('pdf_js/web/viewer.html')}}?file={{asset('/file_magazine')}}/{{$magazine->file}}" 
                align="top" height="1000" width="100%" frameborder="0" scrolling="auto"></iframe>
            @else
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon">
                            @if ($magazine->ext == "docx" || $magazine->ext == "doc")
                                <i class="far fa-file-word"></i>
                            @elseif ($magazine->ext == "pptx" || $magazine->ext == "ppt")
                                <i class="far fa-file-powerpoint"></i>
                            @elseif ($magazine->ext == "xlsx" || $magazine->ext == "xls")
                                <i class="far fa-file-excel"></i>
                            @endif
                        </span>           
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$magazine->file}}</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                            <span>
                                @if ($magazine->ukuran >= '1024')
                                    {{round($magazine->ukuran / 1024, 2)}} KB
                                @elseif ($magazine->ukuran >= '1048576')
                                    {{round($magazine->ukuran / 1048576, 2)}} MB
                                @else
                                    {{$magazine->ukuran}} Bytes
                                @endif
                            </span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                </ul>
            @endif
        </div>
        <!-- /.card-footer -->
        <div class="card-footer">
            <div class="float-right">
                <form action="
                @if (Auth::user()->role == 'admin')
                    {{route('admin.magazine.destroy', $magazine->magazine_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.magazine.destroy', $magazine->magazine_id)}}
                @endif
                " method="POST">
                    @if ($magazine->users->users_id == Auth::user()->users_id)
                        <a class="btn btn-info" href="
                        @if (Auth::user()->role == 'admin')
                            {{route('admin.magazine.edit', $magazine->magazine_id)}}
                        @elseif (Auth::user()->role == 'user')
                            {{route('user.magazine.edit', $magazine->magazine_id)}}
                        @endif
                        ">
                            <i class="fas fa-pencil-alt"></i>
                            Ubah
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin' || $magazine->users->users_id == Auth::user()->users_id )
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation()">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    @endif
                </form>
            </div>
            <a href="
                @if (Auth::user()->role == 'admin')
                    {{route('admin.magazine.download', $magazine->magazine_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.magazine.download', $magazine->magazine_id)}}
                @endif
            " class="btn btn-default"><i class="fas fa-print"></i> Unduh</a>        </div>
        <!-- /.card-footer -->
        </div>
</section>

@endsection
