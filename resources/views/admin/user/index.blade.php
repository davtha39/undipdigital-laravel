@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
                </ol> 
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.container-fluid -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-success" href="{{route('admin.user.create')}}">+ Tambah User</a>
        </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col">Role</th> --}}
                        <th scope="col" width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{$row->name}}</td>
                        <td>
                            @if($row->foto)
                                <img class="rounded-circle" src="/foto_user/{{$row->foto}}" width="100px"></td>
                            @else
                                <img class="rounded-circle" src="/asset/defaultphoto.png" width="100px"></td>
                            @endif
                        <td>{{$row->email}}</td>
                        <td>  
                            <form action="{{route('admin.user.destroy', $row->users_id)}}" method="POST">                                 
                                <a class="btn btn-info btn-sm" href="{{route('admin.user.edit', $row->users_id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Ubah
                                </a>
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
            text: "Apakah anda yakin ingin menghapus user ini? tindakan ini juga akan menghapus SEMUA data yang ditulis oleh user {{$row->name}}, serta tindakan ini tidak dapat dibatalkan.",
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
