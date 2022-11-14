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
                <form action="{{ route('simpan.users') }}" method="POST">
                    @csrf

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Name:</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama User">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Password:</label>
                                <input type="password" name="password"
                                    class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Role:</label>
                                <select id="role" name="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror"></select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
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


@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#role').select2({
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Role--',
                ajax: {
                    url: "{{ route('listrole.user') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.role,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
