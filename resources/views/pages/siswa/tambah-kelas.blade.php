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
                <form action="{{ route('simpan-kelas-siswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="kelas_id" class="form-control" id="kelas"></select>
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
            $('#kelas').select2({
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Kelas--',
                ajax: {
                    url: "{{ route('list-kelas-siswa') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kelas,
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
