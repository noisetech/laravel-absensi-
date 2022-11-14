@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <p>List data</p>
                    </div>

                    <a href="{{ route('tambah-list-pelajaran') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-sm fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Pengajar</th>
                                <th>Hari</th>
                                <th>Jam Pembelajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->mata_pelajaran->nama_mapel }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->waktu_mulai . ' - ' . $item->waktu_selesai }}</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fas fa-sm fa-edit"></i>
                                        </a>


                                        <a href="" class="btn btn-sm btn-danger">
                                            <i class="fas fa-sm fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
