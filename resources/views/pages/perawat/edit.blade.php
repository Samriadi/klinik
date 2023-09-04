@extends('layouts.app')

@section('title', 'DataPerawat')

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
                    <div class="breadcrumb-item">DataPerawat</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="form-group">
                            @foreach ($perawat as $item)
                                <h4>Edit Perawat</h4>
                                <form action="/update-perawat" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
		                            <input type="hidden" name="id_perawat" id="id_perawat"  value="{{ $item->id_perawat }}"> <br/>
                                    <div class="mb-3">
                                        <label for="nama_perawat" class="form-label">Nama Perawat</label>
                                        <input type="text" class="form-control" name="nama_perawat" id="nama_perawat" value="{{ $item->nama_perawat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip_perawat" class="form-label">Nip Perawat</label>
                                        <input type="text" class="form-control" name="nip_perawat" id="nip_perawat" value="{{ $item->nip_perawat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nohp_perawat" class="form-label">Nomor Hp Perawat</label>
                                        <input type="text" class="form-control" name="nohp_perawat" id="nohp_perawat" value="{{ $item->nohp_perawat }}">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="image" class="form-label">Foto Perawat</label>
                                        <input type="file" class="form-control" name="image" id="image" value="{{ $item->foto_perawat }}">
                                        <img src="{{ asset('storage/'.$item->foto_perawat) }}" width="100" alt="Perawat's Photo">
                                    </div> -->
                                    <input type="submit" class="btn btn-primary" value="Simpan Data">
                                </form>
                                @endforeach

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
