@extends('layouts.guest')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('guest.home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('guest.guideline.index')}}">guideline</a></li>
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
                        <h6> <i class="fas fa-solid fa-eye"></i>  {{$guideline->view_count}}</h6>
                    </div>       
                    <h1 class="sn-title">{{$guideline->judul}}</h1>
                    <span class="date">Dibuat pada: {{$guideline->created_at}}</span>
                    <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                        <div class="d-flex creator-profile">
                            @if ($guideline->users->foto)
                                <img src="/foto_user/{{$guideline->users->foto}}" alt="Admin" class="rounded-circle" width="45" height="45">
                            @else   
                                <img src="/asset/defaultphoto.png" alt="Admin" class="rounded-circle" width="45" height="45">
                            @endif
                            <div class="d-flex flex-column ml-2">
                                <h6 class="username">{{$guideline->users->name}}</h6>
                            </div><br>
                        </div>
                    </div>

                    <div class="sn-content">
                        <p>
                            {!! nl2br($guideline->deskripsi) !!}
                        </p>
                    </div>
                </div>
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
                    <br>
                </div>
                <!-- /.card-footer -->
            </div>

        </div>
    </div>
</div>
<!-- Single News End-->   
@endsection