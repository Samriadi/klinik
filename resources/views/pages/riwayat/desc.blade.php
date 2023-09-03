@extends('layouts.app')

@section('title', 'DataPasien')

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
                <h1>Data Riwayat Pasien</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pages</a></div>
                    <div class="breadcrumb-item">DataPasien</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="form-group">
                                <h4>Data Riwayat Pasien</h4>
                                <form action="/update-pasien" method="post">
                                {{ csrf_field() }}
                                    <div class="mb-3">
                                        <label for="nama_pasien" class="form-label">Identitas Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" value="{{ $identitas_pasien }}">
                                    <div class="mb-3">
                                        <label for="nama_pasien" class="form-label">Gejala Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" value="{{ $gejala_pasien }}">
                                    <div class="mb-3">
                                        <label for="nama_pasien" class="form-label">Obat Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" value="{{ $obat_pasien }}">
                                </form>
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
      <!-- JS Libraies -->
      <script src="{{ asset('library/prismjs/prism.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

@endpush
