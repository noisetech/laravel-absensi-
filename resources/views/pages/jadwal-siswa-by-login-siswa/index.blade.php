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
                        <p>Jadwal Pelajaran</p>
                    </div>

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
                                <th>Waktu Pembelajaran</th>
                                <th>Jumlah Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal_siswa as $item)
                                <tr>
                                    <td>{{ $item->list_pelajaran->mata_pelajaran->nama_mapel }}</td>
                                    <td>{{ $item->list_pelajaran->guru->nama }}</td>
                                    <td>{{ $item->list_pelajaran->hari }}</td>
                                    <td>{{ $item->list_pelajaran->waktu_mulai . ' - ' . $item->list_pelajaran->waktu_selesai }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse(\Carbon::now())->format('dd mm yy') }}
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
