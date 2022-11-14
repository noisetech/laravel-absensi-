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
                        <p>List data</p>
                    </div>

                    <a href="{{ route('tambah.guru') }}" class="btn btn-sm btn-primary">
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
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="{{ route('edit.guru', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-sm fa-edit"></i>
                                        </a>

                                        <a href="{{ route('hapus.guru', $item->id) }}" class="btn btn-sm btn-danger">
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
