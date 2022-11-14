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
                <form action="{{ route('simpan-list-pelajaran') }}" method="POST">
                    @csrf

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Mata Pelajaran</label>
                                <select name="mata_pelajaran_id" class="form-control" id="mapel"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Pengajar</label>
                                <select name="guru_id" class="form-control" id="pengajar"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Hari</label>
                                <input type="text" name="hari" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-4">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan <i class="fas fa-sm fa-paper-plane"></i>
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
            $('#mapel').select2({
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Mata Pelajaran--',
                ajax: {
                    url: "{{ route('mata-pelajaran.list-pelajaran') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_mapel,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $(document).ready(function() {
            $('#pengajar').select2({
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Pengajar--',
                ajax: {
                    url: "{{ route('pengajar-list-pelajaran') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama,
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
