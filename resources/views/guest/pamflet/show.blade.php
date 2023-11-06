@extends('layouts.guest')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('guest.home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('guest.pamflet.index')}}">Pamflet</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Single News Start-->
<div class="single-news">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="sn-container">
                    <div class="float-right">
                        <h6> <i class="fas fa-solid fa-eye"></i>  {{$pamflet->view_count}}</h6>
                    </div>       
                    <h1 class="sn-title">{{$pamflet->judul}}</h1>
                    <span class="date">Dibuat pada: {{$pamflet->created_at}}</span>
                    <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                        <div class="d-flex creator-profile">
                            @if ($pamflet->users->foto)
                                <img src="/foto_user/{{$pamflet->users->foto}}" alt="Admin" class="rounded-circle" width="45" height="45">
                            @else   
                                <img src="/asset/defaultphoto.png" alt="Admin" class="rounded-circle" width="45" height="45">
                            @endif
                            <div class="d-flex flex-column ml-2">
                                <h6 class="username">{{$pamflet->users->name}}</h6>
                            </div><br>
                        </div>
                    </div>

                    <div class="sn-content">
                        <p>
                            {!! nl2br($pamflet->deskripsi) !!}
                        </p>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    @if ($pamflet->ext == "pdf")
                        <iframe src="{{asset('pdf_js/web/viewer.html')}}?file={{asset('/file_pamflet')}}/{{$pamflet->file}}" 
                            align="top" height="1000" width="100%" frameborder="0" scrolling="auto"></iframe>
                    @elseif ($pamflet->ext == "jpg" || $pamflet->ext == "jpeg" || $pamflet->ext == "png" || $pamflet->ext == "bmp")
                        <div class="justify-content-center align-items-center ">
                            {{-- <a href="/file_pamflet/{{$pamflet->foto}}" data-toggle="lightbox" data-gallery="gallery" class="lightbox-link"> --}}
                                <img src="/file_pamflet/{{$pamflet->file}}" width="100%" alt="Image 1" style="position: center;">
                                <br><br>
                                <div class="float-right">
                                    <a href="{{route('guest.pamflet.download', $pamflet->pamflet_id)}}" class="btn btn-default">
                                        <i class="fas fa-print"></i> Unduh
                                    </a>    
                                </div>
                            {{-- </a> --}}
                        </div><br>
                    @else
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li>
                                <span class="mailbox-attachment-icon">
                                    @if ($pamflet->ext == "docx" || $pamflet->ext == "doc")
                                        <i class="far fa-file-word"></i>
                                    @elseif ($pamflet->ext == "pptx" || $pamflet->ext == "ppt")
                                        <i class="far fa-file-powerpoint"></i>
                                    @elseif ($pamflet->ext == "xlsx" || $pamflet->ext == "xls")
                                        <i class="far fa-file-excel"></i>
                                    @endif
                                </span>           
                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$pamflet->file}}</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>
                                            @if ($pamflet->ukuran >= '1024')
                                                {{round($pamflet->ukuran / 1024, 2)}} KB
                                            @elseif ($pamflet->ukuran >= '1048576')
                                                {{round($pamflet->ukuran / 1048576, 2)}} MB
                                            @else
                                                {{$pamflet->ukuran}} Bytes
                                            @endif
                                        </span>
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    @endif
                    <br>
                </div>
                <!-- /.card-footer -->
            </div>

        </div>
    </div>
</div>
<!-- Single News End-->   
@endsection