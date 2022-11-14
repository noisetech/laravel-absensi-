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
                <form action="{{ route('update.siswa', $item->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama:</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama"
                                    value="{{ $item->nama }}">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin:</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jk" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio1" value="L" @if ($item->jk == 'L') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">L</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jk" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio2" value="P" @if ($item->jk == 'P') checked  @endif>
                                    <label class="form-check-label" for="inlineRadio2">P</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir"
                                    value="{{ $item->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir:</label>
                                <textarea name="tempat_lahir" class="form-control" cols="30" rows="10">{{ $item->tempat_lahir }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alamat:</label>
                                <textarea name="alamat" class="form-control" cols="30" rows="10">{{ $item->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Wali:</label>
                                <input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali"
                                    value="{{ $item->nama_wali }}">
                            </div>
                        </div>
                    </div>




                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <select id="email" name="user_id" class="form-control">

                                </select>
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
                    url: "{{ route('list-user') }}",
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
            url: "{{ route('list-user.siswa', $item->id) }}",
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
