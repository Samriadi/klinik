<!-- @extends('layouts.app')

@section('title', 'DataRiwayat')

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
                <h1>Edit data</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pages</a></div>
                    <div class="breadcrumb-item">DataRiwayat</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="form-group">
                                <h4>Edit Riwayat</h4>
                                <form action="/update-riwayat" method="post">
                                    {{ csrf_field() }}
		                            <input type="hidden" name="id_riwayat" id="id_riwayat"  value="{{ $id_riwayat }}"> <br/>
                                    <div class="mb-3">
                                        <label for="identitas_pasien" class="form-label">Identitas Pasien</label>
                                        <input type="text" class="form-control" name="identitas_pasien" id="identitas_pasien" value="{{ $identitas_pasien }}">
                                    
                                    <div class="mb-3">
                                        <label for="gejala_pasien" class="form-label">Gejala Pasien</label>
                                        <input type="text" class="form-control" name="gejala_pasien" id="gejala_pasien" value="{{ $gejala_pasien }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="obat_pasien" class="form-label">Obat Pasien</label>
                                        <input type="text" class="form-control" name="obat_pasien" id="obat_pasien" value="{{ $obat_pasien }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="perawat" class="form-label">Perawat</label>
                                        <input type="text" class="form-control" name="perawat" id="perawat" value="{{ $perawat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dokter" class="form-label">Dokter</label>
                                        <input type="text" class="form-control" name="dokter" id="dokter" value="{{ $dokter }}">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Simpan Data">
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

@endpush -->
