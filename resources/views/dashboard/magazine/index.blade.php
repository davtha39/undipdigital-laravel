@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Magazine</h1>
        </div><!-- /.col -->    
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                @if (Auth::user()->role == 'admin')
                    <a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                @elseif (Auth::user()->role == 'user')
                    <a href="{{route('user.dashboard')}}">Dashboard</a></li>
                @endif
            <li class="breadcrumb-item active">Magazine</li>
            </ol> 
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card">
        <div class="card-header">
            @if (Auth::user()->role == 'admin')
                <a class="btn btn-success" href="{{route('admin.magazine.create')}}">+ Tambah Magazine</a>
            @elseif (Auth::user()->role == 'user')
                <a class="btn btn-success" href="{{route('user.magazine.create')}}">+ Tambah Magazine</a>
            @endif        </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="20px">No</th>
                        <th scope="col">Judul</th>                                    
                        <th scope="col">Tanggal Upload</th>
                        <th scope="col">File</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($magazine as $row)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>
                                <a class="mailbox-attachment-name" style="color: black" href="
                                    @if (Auth::user()->role == 'admin')
                                        {{route('admin.magazine.show', $row->magazine_id)}}
                                    @elseif (Auth::user()->role == 'user')
                                        {{route('user.magazine.show', $row->magazine_id)}}
                                    @endif
                                ">
                                    {{$row->judul}}
                                </a>
                            </td>
                            <td>{{$row->updated_at}}</td>
                            <td>
                                <div class="col" style="text-align: center">
                                    <a href="
                                        @if (Auth::user()->role == 'admin')
                                            {{route('admin.magazine.show', $row->magazine_id)}}
                                        @elseif (Auth::user()->role == 'user')
                                            {{route('user.magazine.show', $row->magazine_id)}}
                                        @endif
                                    ">
                                        @if ($row->ext == "docx" || $row->ext == "doc")
                                            <i class="far fa-file-word fa-3x"></i>
                                        @elseif ($row->ext == "pptx" || $row->ext == "ppt")
                                            <i class="far fa-file-powerpoint fa-3x"></i>
                                        @elseif ($row->ext == "xlsx" || $row->ext == "xls")
                                            <i class="far fa-file-excel fa-3x"></i>
                                        @elseif ($row->ext == "pdf")
                                            <i class="far fa-file-pdf fa-3x"></i>
                                        @else
                                            <i class="far fa-file fa-3x"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="col" style="text-align: center">
                                    @if ($row->ukuran >= '1024')
                                        {{round($row->ukuran / 1024, 2)}} KB
                                    @elseif ($row->ukuran >= '1048576')
                                        {{round($row->ukuran / 1048576, 2)}} MB
                                    @else
                                        {{$row->ukuran}} Bytes
                                    @endif
                                </div>
                            </td>
                            <td>{{$row->users->name}}</td>
                            <td>
                                <form action="
                                    @if (Auth::user()->role == 'admin')
                                        {{route('admin.magazine.destroy', $row->magazine_id)}}
                                    @elseif (Auth::user()->role == 'user')
                                        {{route('user.magazine.destroy', $row->magazine_id)}}
                                    @endif
                                " method="POST">
                                    <a class="btn btn-primary btn-sm" href="
                                        @if (Auth::user()->role == 'admin')
                                            {{route('admin.magazine.show', $row->magazine_id)}}
                                        @elseif (Auth::user()->role == 'user')
                                            {{route('user.magazine.show', $row->magazine_id)}}
                                        @endif
                                    ">
                                        <i class="fas fa-folder"></i>
                                        Lihat
                                    </a>
                                    @if ($row->users->users_id == Auth::user()->users_id)
                                        <a class="btn btn-info btn-sm" href="
                                            @if (Auth::user()->role == 'admin')
                                                {{route('admin.magazine.edit', $row->magazine_id)}}
                                            @elseif (Auth::user()->role == 'user')
                                                {{route('user.magazine.edit', $row->magazine_id)}}
                                            @endif
                                        ">
                                            <i class="fas fa-pencil-alt"></i>
                                            Ubah
                                        </a>
                                    @endif
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation()">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    function showDeleteConfirmation() {
        Swal.fire({
            title: 'Konfirmasi Penghapusan User',
            text: "Apakah anda yakin ingin menghapus magazine ini?",
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

@if ($message = Session::get('succes'))
    <script>
        Swal.fire(
            'Input Data Berhasil',
            'Data telah berhasil di input ke database.',
            'success'
        )
    </script>
@elseif ($message = Session::get('deleted'))
    <script>
        Swal.fire(
            'Delete Data Berhasil',
            'Data telah berhasil dihapus dari database.',
            'success'
        )
    </script>
@elseif ($message = Session::get('updated'))
    <script>
        Swal.fire(
            'Update Data Berhasil',
            'Data telah berhasil diupdate dari database.',
            'success'
        )
    </script>
@endif
@endsection