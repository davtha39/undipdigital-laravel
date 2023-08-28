@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail ebook</h1>
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
                <a href="{{route('admin.ebook.index')}}"></a>Ebook</li>
            @elseif (Auth::user()->role == 'user')
                <a href="{{route('user.ebook.index')}}"></a>Ebook</li>
            @endif
        <li class="breadcrumb-item active">Detail ebook</li>
        </ol> 
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-body p-0">
            <div class="mailbox-read-info">
            <h5>{{$ebook->judul}}</h5>
            <h6>Author: {{$ebook->users->name}}
                <span class="mailbox-read-time float-right">Tanggal dibuat: {{$ebook->created_at}}</span></h6>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                {!! nl2br($ebook->deskripsi) !!}
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            @if($ebook->ext == "pdf")
            <iframe src="{{asset('pdf_js/web/viewer.html')}}?file={{asset('/file_ebook')}}/{{$ebook->file}}" 
                align="top" height="1000" width="100%" frameborder="0" scrolling="auto"></iframe>
            @else
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon">
                            @if ($ebook->ext == "docx" || $ebook->ext == "doc")
                                <i class="far fa-file-word"></i>
                            @elseif ($ebook->ext == "pptx" || $ebook->ext == "ppt")
                                <i class="far fa-file-powerpoint"></i>
                            @elseif ($ebook->ext == "xlsx" || $ebook->ext == "xls")
                                <i class="far fa-file-excel"></i>
                            @endif
                        </span>           
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$ebook->file}}</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                            <span>
                                @if ($ebook->ukuran >= '1024')
                                    {{round($ebook->ukuran / 1024, 2)}} KB
                                @elseif ($ebook->ukuran >= '1048576')
                                    {{round($ebook->ukuran / 1048576, 2)}} MB
                                @else
                                    {{$ebook->ukuran}} Bytes
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
                    {{route('admin.ebook.destroy', $ebook->ebook_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.ebook.destroy', $ebook->ebook_id)}}
                @endif
                " method="POST">
                    @if ($ebook->users->users_id == Auth::user()->users_id)
                        <a class="btn btn-info" href="
                        @if (Auth::user()->role == 'admin')
                            {{route('admin.ebook.edit', $ebook->ebook_id)}}
                        @elseif (Auth::user()->role == 'user')
                            {{route('user.ebook.edit', $ebook->ebook_id)}}
                        @endif
                        ">
                            <i class="fas fa-pencil-alt"></i>
                            Ubah
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin' || $ebook->users->users_id == Auth::user()->users_id )
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
                    {{route('admin.ebook.download', $ebook->ebook_id)}}
                @elseif (Auth::user()->role == 'user')
                    {{route('user.ebook.download', $ebook->ebook_id)}}
                @endif
            " class="btn btn-default"><i class="fas fa-print"></i> Unduh</a>
        </div>
        <!-- /.card-footer -->
        </div>
</section>
<script>
    function showDeleteConfirmation() {
        Swal.fire({
            title: 'Konfirmasi Penghapusan Ebook',
            text: "Apakah anda yakin ingin menghapus ebook ini?",
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

@endsection
