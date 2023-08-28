@extends('layouts.guest')

@section('content')

<!-- Tab News Start-->
<br>
<div class="tab-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" style="background-color: black;" data-toggle="pill" href="{{route('guest.ebook.index')}}">EBOOK</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="ebook" class="container tab-pane active">
                        @foreach ($ebook as $ebooks)
                            <div class="tn-news">
                                <div class="tn-img">
                                    @if ($ebooks->ext == "docx" || $ebooks->ext == "doc")
                                        <i class="far fa-file-word fa-4x"></i>
                                    @elseif ($ebooks->ext == "pptx" || $ebooks->ext == "ppt")
                                        <i class="far fa-file-powerpoint fa-4x"></i>
                                    @elseif ($ebooks->ext == "xlsx" || $ebooks->ext == "xls")
                                        <i class="far fa-file-excel fa-4x"></i>
                                    @elseif ($ebooks->ext == "pdf")
                                        <i class="far fa-file-pdf fa-4x"></i>
                                    @else
                                        <i class="far fa-file fa-4x"></i>
                                    @endif
                                </div>
                                <div class="tn-title">
                                    <a href="">{{$ebooks->judul}}</a>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" style="background-color: #10144c" href="{{route('guest.ebook.index')}}">
                                    Lihat Selengkapnya 
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link " style="background-color: black;" data-toggle="pill" href="{{route('guest.ejournal.index')}}">EJOURNAL</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="ejournal" class="container tab-pane active">
                        @foreach ($ejournal as $ejournals)
                            <div class="tn-news">
                                <div class="tn-img">
                                    
                                    @if ($ejournals->ext == "docx" || $ejournals->ext == "doc")
                                        <i class="far fa-file-word fa-4x"></i>
                                    @elseif ($ejournals->ext == "pptx" || $ejournals->ext == "ppt")
                                        <i class="far fa-file-powerpoint fa-4x"></i>
                                    @elseif ($ejournals->ext == "xlsx" || $ejournals->ext == "xls")
                                        <i class="far fa-file-excel fa-4x"></i>
                                    @elseif ($ejournals->ext == "pdf")
                                        <i class="far fa-file-pdf fa-4x"></i>
                                    @else
                                        <i class="far fa-file fa-4x"></i>
                                    @endif
                                </div>
                                <div class="tn-title">
                                    <a href="">{{$ejournals->judul}}</a>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="pill" style="background-color: #10144c" href="{{route('guest.ejournal.index')}}">
                                    Lihat Selengkapnya 
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" style="background-color: black;" data-toggle="pill" href="{{route('guest.pamflet.index')}}">pamflet</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="pamflet" class="container tab-pane active">
                    @foreach ($pamflet as $pamflets)
                        <div class="tn-news">
                            <div class="tn-img">
                                
                                @if ($pamflets->ext == "docx" || $pamflets->ext == "doc")
                                    <i class="far fa-file-word fa-4x"></i>
                                @elseif ($pamflets->ext == "pptx" || $pamflets->ext == "ppt")
                                    <i class="far fa-file-powerpoint fa-4x"></i>
                                @elseif ($pamflets->ext == "xlsx" || $pamflets->ext == "xls")
                                    <i class="far fa-file-excel fa-4x"></i>
                                @elseif ($pamflets->ext == "pdf")
                                    <i class="far fa-file-pdf fa-4x"></i>
                                @else
                                    <i class="far fa-file fa-4x"></i>
                                @endif
                            </div>
                            <div class="tn-title">
                                <a href="">{{$pamflets->judul}}</a>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" style="background-color: #10144c" href="{{route('guest.pamflet.index')}}">
                                Lihat Selengkapnya 
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<!-- Tab News Start-->

@endsection