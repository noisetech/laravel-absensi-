@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-weight-bold text-dark">
                        <p>Form Ubah</p>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('update.guru', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center" hidden>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama:</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama"
                                    value="{{ $item->nama }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Telepon:</label>
                                <input type="number" name="telp"
                                    class="form-control  @error('telp') is-invalid @enderror" placeholder="Telepon"
                                    value="{{ $item->telp }}">
                                @error('telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alamat:</label>
                                <textarea name="alamat" id="" cols="30" rows="10"
                                    class="form-control  @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ $item->alamat }}</textarea>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Foto:</label> <sup>isi jika ingin diubah</sup>
                                <input type="file" name="foto"
                                    class="form-control  @error('foto') is-invalid @enderror">
                                @error('foto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <select id="email" name="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror">
                                </select>

                                @error('user_id')
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



@push('script')
    <script>
        $(document).ready(function() {
            $('#email').select2({
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Email--',
                ajax: {
                    url: "{{ route('list-user-guru') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.email,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $.ajax({
            type: 'GET',
            url: "{{ route('list-user-guru-byid', $item->id) }}",
        }).then(function(data) {
            // console.log(data);
            if ($('#email').find("option[value='" + data.user.id + "']")
                .length) {
                $('#email').val(data.user.id).trigger('change');
            } else {

                var newOption = new Option(data.user.email, data.user.id, true,
                    true);

                $('#email').append(newOption).trigger('change');
            }
        });
    </script>
@endpush
