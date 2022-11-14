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
                                <th>Absen</th>
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
                                    <td>{{ $item->jumlah_absen }}</td>
                                    <td>
                                        @if (\Carbon\Carbon::parse(\Carbon\Carbon::now())->isoFormat('dddd') ==
                                            Str::ucfirst($item->list_pelajaran->hari) &&
                                            $item->riwayat_absensi->where('tangal_absensi', date('Y-m-d'))->count() == 0)
                                            <form action="{{ route('absensi') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="jadwal_siswa_id" value="{{ $item->id }}">

                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    Absen
                                                </button>
                                            </form>
                                        @else
                                        @endif


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
