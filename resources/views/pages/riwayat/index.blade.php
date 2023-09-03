@extends('layouts.app')

@section('title', 'DataRiwayatPasien')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>DataRiwayatPasien</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pages</a></div>
                    <div class="breadcrumb-item">DataRiwayatPasien</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <a class="btn btn-success" href="tambah-riwayat" role="button">Tambah</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Identitas Pasien</th>
                                                <th>Tanggal Berobat</th>
                                                <th>Gejala</th>
                                                <th>Obat</th>
                                                <th>Perawat</th>
                                                <th>Dokter</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($riwayat as $item)
                                            <tr>
                                              
                                                <td>{{ $item->identitas_pasien }}</td>
                                                <td>{{ $item->tanggal_berobat }}</td>
                                                <td>{{ $item->gejala_pasien }}</td>
                                                <td>{{ $item->obat_pasien }}</td>
                                                <td>{{ $item->perawat }}</td>
                                                <td>{{ $item->dokter }}</td>
                                                <td>
                                                <a class="btn btn-warning btn-sm" href="/edit-riwayat/{{ $item->id_riwayat }}">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="/hapus-riwayat/{{ $item->id_riwayat }}">Hapus</a>
                                                <a class="btn btn-primary btn-sm" href="/desc-riwayat/{{ $item->id_riwayat }}">Desc</a>
                                            </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
