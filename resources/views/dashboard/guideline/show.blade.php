@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail Guideline</h1>
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
                    <a href="{{route('admin.guideline.index')}}">Guideline</a></li>
                @elseif (Auth::user()->role == 'user')
                    <a href="{{route('user.guideline.index')}}">Guideline</a></li>
                @endif        
            <li class="breadcrumb-item active">Detail guideline</li>
        </ol> 
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-body p-0">
            <div class="mailbox-read-info">
            <h5>{{$guideline->judul}}</h5>
            <h6>Author: {{$guideline->users->name}}
                <span class="mailbox-read-time float-right">Tanggal dibuat: {{$guideline->created_at}}</span></h6>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                {!! nl2br($guideline->deskripsi) !!}
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            @if($guideline->ext == "pdf")
            <iframe src="{{asset('pdf_js/web/viewer.html')}}?file={{asset('/file_guideline')}}/{{$guideline->file}}" 
                align="top" height="1000" width="100%" frameborder="0" scrolling="auto"></iframe>
            @else
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon">
                            @if ($guideline->ext == "docx" || $guideline->ext == "doc")
                                <i class="far fa-file-word"></i>
                            @elseif ($guideline->ext == "pptx" || $guideline->ext == "ppt")
                                <i class="far fa-file-powerpoint"></i>
                            @elseif ($guideline->ext == "xlsx" || $guideline->ext == "xls")
                                <i class="far fa-file-excel"></i>
                            @endif
                        </span>           
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$guideline->file}}</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                            <span>
                                @if ($guideline->ukuran >= '1024')
                                    {{round($guideline->ukuran / 1024, 2)}} KB
                                @elseif ($guideline->ukuran >= '1048576')
                                    {{round($guideline->ukuran / 1048576, 2)}} MB
                                @else
                                    {{$guideline->ukuran}} Bytes
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
                    {{route('admin.guideline.destroy', $guideline->guideline_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.guideline.destroy', $guideline->guideline_id)}}
                @endif
                " method="POST">
                    @if ($guideline->users->users_id == Auth::user()->users_id)
                        <a class="btn btn-info" href="
                        @if (Auth::user()->role == 'admin')
                            {{route('admin.guideline.edit', $guideline->guideline_id)}}
                        @elseif (Auth::user()->role == 'user')
                            {{route('user.guideline.edit', $guideline->guideline_id)}}
                        @endif
                        ">
                            <i class="fas fa-pencil-alt"></i>
                            Ubah
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin' || $guideline->users->users_id == Auth::user()->users_id )
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
                    {{route('admin.guideline.download', $guideline->guideline_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.guideline.download', $guideline->guideline_id)}}
                @endif
            " class="btn btn-default"><i class="fas fa-print"></i> Unduh</a>        </div>
        <!-- /.card-footer -->
        </div>
</section>

@endsection
