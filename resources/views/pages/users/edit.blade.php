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
                <form action="{{ route('update.user', $item->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Name:</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama User"
                                    value="{{ $item->name }}">

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
                                    class="form-control  @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ $item->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Password:</label> <sup><small>isi jika ingin diubah</small></sup>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Role:</label>
                                <select id="role" name="role_id" class="form-control"></select>
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
        $.ajax({
            type: 'GET',
            url: "{{ route('roleByUser', $item->id) }}",
        }).then(function(data) {
            // console.log(data);
            if ($('#role').find("option[value='" + data.role.id + "']")
                .length) {
                $('#role').val(data.role.id).trigger('change');
            } else {

                var newOption = new Option(data.role.role, data.role.id, true,
                    true);

                $('#role').append(newOption).trigger('change');
            }
        });

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
