@extends('layouts.admin')

@section('content')
    <div class="container-fluid">



        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <p>Form Tambah</p>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('update.mapel', $item->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mata Pelajaran:</label>
                                <input type="text" name="nama_mapel"
                                    class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="Nama Mapel"
                                    value="{{ $item->nama_mapel }}">
                                @error('nama_mapel')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center mt-3">
                            <div class="col-sm-4">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan <i class="fas fa-sm fa-paper-plane"> </i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
