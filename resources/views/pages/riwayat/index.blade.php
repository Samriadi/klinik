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
                            <div class="btn-group mb-3"
                            role="group"
                            aria-label="Basic example">
                            <a href="tambah-riwayat" role="button" class="btn btn-icon btn-primary"><i class="far fa-add"></i>RSA</a>
                            <a href="add-riwayat" role="button" class="btn btn-icon btn-danger"><i class="far fa-add"></i>ELGAMAL</a>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Enkripsi</th>
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
                                                @if ($item->role===0)
                                                <td>RSA</td>
                                                @else
                                                <td>ElGamal</td>
                                                @endif
                                                <td>{{ $item->identitas_pasien }}</td>
                                                <td>{{ $item->tanggal_berobat }}</td>
                                                <td>{{ $item->gejala_pasien }}</td>
                                                <td>{{ $item->obat_pasien }}</td>
                                                <td>{{ $item->perawat }}</td>
                                                <td>{{ $item->dokter }}</td>
                                                <td>
                                                <div class="btn-group mb-3"
                                                    role="group"
                                                    aria-label="Basic example">

                                                    @if ($item->role===0)
                                                    <a href="/edit-riwayat/{{ $item->id_riwayat }}" role="button" class="btn btn-icon btn-secondary"><i class="fas fa-pencil-alt"></i></a> 
                                                    @else
                                                    <a href="/ubah-riwayat/{{ $item->id_riwayat }}" role="button" class="btn btn-icon btn-secondary"><i class="fas fa-pencil-alt"></i></a> 
                                                    @endif

                                                    <a href="/hapus-riwayat/{{ $item->id_riwayat}}" role="button" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></a>

                                                    @if ($item->role===0)
                                                    <a href="/desc-riwayat/{{ $item->id_riwayat}}" role="button" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                                                    @else
                                                    <a href="/deks-riwayat/{{ $item->id_riwayat }}" role="button" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                                                    @endif
                                                    
                                                </div>
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
