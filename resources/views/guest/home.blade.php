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
                        <a class="nav-link " style="background-color: #f01e2c;" href="{{route('guest.guideline.index')}}"><b>Guideline</b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="guideline" class="container tab-pane active">
                        @foreach ($guideline as $guidelines)
                            <div class="tn-news">
                                <div class="tn-img">
                                    
                                    @if ($guidelines->ext == "docx" || $guidelines->ext == "doc")
                                        <i class="far fa-file-word fa-4x"></i>
                                    @elseif ($guidelines->ext == "pptx" || $guidelines->ext == "ppt")
                                        <i class="far fa-file-powerpoint fa-4x"></i>
                                    @elseif ($guidelines->ext == "xlsx" || $guidelines->ext == "xls")
                                        <i class="far fa-file-excel fa-4x"></i>
                                    @elseif ($guidelines->ext == "pdf")
                                        <i class="far fa-file-pdf fa-4x"></i>
                                    @else
                                        <i class="far fa-file fa-4x"></i>
                                    @endif
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('guest.guideline.show', $guidelines->guideline_id)}}">{{$guidelines->judul}}</a>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link " style="background-color: #10144c" href="{{route('guest.guideline.index')}}">
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
                        <a class="nav-link " style="background-color: #f01e2c;" href="{{route('guest.magazine.index')}}"><b>Magazine</b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="magazine" class="container tab-pane active">
                        @foreach ($magazine as $magazines)
                            <div class="tn-news">
                                <div class="tn-img">
                                    
                                    @if ($magazines->ext == "docx" || $magazines->ext == "doc")
                                        <i class="far fa-file-word fa-4x"></i>
                                    @elseif ($magazines->ext == "pptx" || $magazines->ext == "ppt")
                                        <i class="far fa-file-powerpoint fa-4x"></i>
                                    @elseif ($magazines->ext == "xlsx" || $magazines->ext == "xls")
                                        <i class="far fa-file-excel fa-4x"></i>
                                    @elseif ($magazines->ext == "pdf")
                                        <i class="far fa-file-pdf fa-4x"></i>
                                    @else
                                        <i class="far fa-file fa-4x"></i>
                                    @endif
                                </div>
                                <div class="tn-title">
                                    <a href="{{route('guest.magazine.show', $magazines->magazine_id)}}">{{$magazines->judul}}</a>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link " style="background-color: #10144c" href="{{route('guest.magazine.index')}}">
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
                        <a class="nav-link active" style="background-color: #f01e2c;" href="{{route('guest.ebook.index')}}"><b>Ebook</b></a>
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
                                    <a href="{{route('guest.ebook.show', $ebooks->ebook_id)}}">{{$ebooks->judul}}</a>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" style="background-color: #10144c" href="{{route('guest.ebook.index')}}">
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
                        <a class="nav-link active" style="background-color: #f01e2c;" href="{{route('guest.pamflet.index')}}"><b>Pamflet</b></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="pamflet" class="container tab-pane active">
                        @if($pamflet != null)
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
                                        <a href="{{route('guest.pamflet.show', $pamflets->pamflet_id)}}">{{$pamflets->judul}}</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 align="center">Tidak Ada Data</h3>
                        @endif
                        <br>
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" style="background-color: #10144c" href="{{route('guest.pamflet.index')}}">
                                    Lihat Selengkapnya 
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Tab News Start-->

@endsection