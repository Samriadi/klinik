@extends('layouts.app')

@section('title', 'DataDokter')

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
                    <div class="breadcrumb-item">DataDokter</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="form-group">
                                <h4>Edit dokter</h4>
                                <form action="/update-dokter" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
		                            <input type="hidden" name="id_dokter" id="id_dokter"  value="{{ $id }}"> <br/>
                                    <div class="mb-3">
                                        <label for="nama_dokter" class="form-label">Nama dokter</label>
                                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="{{ $nama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip_dokter" class="form-label">Nip dokter</label>
                                        <input type="text" class="form-control" name="nip_dokter" id="nip_dokter" value="{{ $nip }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nohp_dokter" class="form-label">Nomor Hp dokter</label>
                                        <input type="text" class="form-control" name="nohp_dokter" id="nohp_dokter" value="{{ $nohp }}">
                                    </div>
                               z
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

@endpush
