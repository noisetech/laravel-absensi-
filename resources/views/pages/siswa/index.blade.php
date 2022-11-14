@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <p>List data</p>
                    </div>

                    <a href="{{ route('tambah.siswa') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-sm fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->nama }}

                                        @if ($item->kelas->isEmpty())
                                            <sup><small><a href="{{ route('tambah-kelas-siswa', $item->id) }}"
                                                        class="text-secondary"><i
                                                            class="fas fa-sm fa-plus-circle"></i></a></small></sup>
                                        @else
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('edit-siswa', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-sm fa-edit"></i>
                                        </a>

                                        <a href="" class="btn btn-sm btn-danger">
                                            <i class="fas fa-sm fa-trash-alt"></i>
                                        </a>

                                        <a href="{{ route('hapus.siswa', $item->id) }}" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-sm fa-eye"></i>
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
