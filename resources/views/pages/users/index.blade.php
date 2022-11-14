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

                    <a href="{{ route('tambah.users') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-sm fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role->role }}</td>
                                    <td>
                                        @if ($item->role->role == 'admin')
                                        @else
                                            <a href="{{ route('edit.user', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-sm fa-edit"></i>
                                            </a>

                                            <a href="{{ route('hapus.user', $item->id) }}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-sm fa-trash-alt"></i>
                                            </a>
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
