@extends('layouts.guest')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('guest.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Ebook</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Single News Start-->
<div class="single-news">

    <div class="container">    
        <div class="float-right"><br>
            <div class="b-search">
                <form action="{{route('guest.ebook.search')}}" method="GET">
                    <input type="text" name="search" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <h1 class="sn-title">Ebook</h1><br>
        <div class="row">
            <div class="col">
                @foreach ($ebook as $ebooks)
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="d-flex flex-row"></div>
                            <div class="row news-card p-3">
                                <div class="col-md-2">
                                    <div class="feed-image">
                                        @if ($ebooks->ext == "docx" || $ebooks->ext == "doc")
                                            <i class="far fa-file-word fa-4x"></i>
                                        @elseif ($ebooks->ext == "pptx" || $ebooks->ext == "ppt")
                                            <i class="far fa-file-powerpoint fa-4x"></i>
                                        @elseif ($ebooks->ext == "xlsx" || $ebooks->ext == "xls")
                                            <i class="far fa-file-excel fa-4x"></i>
                                        @elseif ($ebooks->ext == "pdf")
                                            <i class="far fa-file-pdf fa-4x"></i>
                                        @else
                                            <i class="far fa-file fa-3x"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="news-feed-text">
                                        <h5><a class="mailbox-attachment-name" style="color: black" href="{{route('guest.ebook.show', $ebooks->ebook_id)}}">{{$ebooks->judul}}</a></h5>
                                        <span>{{Str::limit($ebooks->deskripsi, 60)}} ...<br></span>
                                        <div class="float-right">
                                            <br>
                                            <h6> <i class="fas fa-solid fa-eye"></i>  {{$ebooks->view_count}}</h6>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center mt-2">
                                            <div class="d-flex creator-profile">
                                                @if ($ebooks->users->foto)
                                                    <img src="/foto_user/{{$ebooks->users->foto}}" alt="Admin" class="rounded-circle" width="45" height="45">
                                                @else   
                                                    <img src="/asset/defaultphoto.png" alt="Admin" class="rounded-circle" width="45" height="45">
                                                @endif
                                                <div class="d-flex flex-column ml-2">
                                                    <h6 class="username">{{$ebooks->users->name}}</h6>
                                                    <span class="date">{{$ebooks->created_at}}</span>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach            
                <br>
                <div class="float-right">
                    {!! $ebook->links() !!}    
                </div> 
                Halaman {{ $ebook->currentPage() }} dari {{ $ebook->lastPage() }}<br>
            </div>
        </div>
    </div>
</div>
<!-- Single News End-->     
@endsection