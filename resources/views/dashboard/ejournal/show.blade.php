@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail ejournal</h1>
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
                    <a href="{{route('admin.ejournal.index')}}">Ejournal</a></li>
                @elseif (Auth::user()->role == 'user')
                    <a href="{{route('user.ejournal.index')}}">Ejournal</a></li>
                @endif        
            <li class="breadcrumb-item active">Detail ejournal</li>
        </ol> 
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-body p-0">
            <div class="mailbox-read-info">
            <h5>{{$ejournal->judul}}</h5>
            <h6>Author: {{$ejournal->users->name}}
                <span class="mailbox-read-time float-right">Tanggal dibuat: {{$ejournal->created_at}}</span></h6>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                {!! nl2br($ejournal->deskripsi) !!}
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            @if($ejournal->ext == "pdf")
            <iframe src="{{asset('pdf_js/web/viewer.html')}}?file={{asset('/file_ejournal')}}/{{$ejournal->file}}" 
                align="top" height="1000" width="100%" frameborder="0" scrolling="auto"></iframe>
            @else
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon">
                            @if ($ejournal->ext == "docx" || $ejournal->ext == "doc")
                                <i class="far fa-file-word"></i>
                            @elseif ($ejournal->ext == "pptx" || $ejournal->ext == "ppt")
                                <i class="far fa-file-powerpoint"></i>
                            @elseif ($ejournal->ext == "xlsx" || $ejournal->ext == "xls")
                                <i class="far fa-file-excel"></i>
                            @endif
                        </span>           
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$ejournal->file}}</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                            <span>
                                @if ($ejournal->ukuran >= '1024')
                                    {{round($ejournal->ukuran / 1024, 2)}} KB
                                @elseif ($ejournal->ukuran >= '1048576')
                                    {{round($ejournal->ukuran / 1048576, 2)}} MB
                                @else
                                    {{$ejournal->ukuran}} Bytes
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
                    {{route('admin.ejournal.destroy', $ejournal->ejournal_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.ejournal.destroy', $ejournal->ejournal_id)}}
                @endif
                " method="POST">
                    @if ($ejournal->users->users_id == Auth::user()->users_id)
                        <a class="btn btn-info" href="
                        @if (Auth::user()->role == 'admin')
                            {{route('admin.ejournal.edit', $ejournal->ejournal_id)}}
                        @elseif (Auth::user()->role == 'user')
                            {{route('user.ejournal.edit', $ejournal->ejournal_id)}}
                        @endif
                        ">
                            <i class="fas fa-pencil-alt"></i>
                            Ubah
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin' || $ejournal->users->users_id == Auth::user()->users_id )
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
                    {{route('admin.ejournal.download', $ejournal->ejournal_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.ejournal.download', $ejournal->ejournal_id)}}
                @endif
            " class="btn btn-default"><i class="fas fa-print"></i> Unduh</a>        </div>
        <!-- /.card-footer -->
        </div>
</section>

@endsection
