@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <p>List Pelajaran</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('simpan-jadwal-siswa') }}" method="POST">
                    @csrf

                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Pengajaran</th>
                                    <th>Hari</th>
                                    <th>Waktu Pembelajaran</th>
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
                                            <input type="checkbox" name="list_pelajaran[]" value="{{ $item->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="container">
                        <div class="row mt-4 justify-content-start">
                            <div class="col-sm-4">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan <i class="fas fa-sm fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
