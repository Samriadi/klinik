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
                <h1>DataPerawat</h1>
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
                            <div class="card-header">
                            <a href="tambah-perawat" role="button" class="btn btn-icon btn-primary"><i class="far fa-add"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                          
                                                <th>Nama Perawat</th>
                                                <th>NIP</th>
                                                <th>Nomor Hp</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($perawat as $item)
                                            <tr>
                                                 <td>{{ $item->nama_perawat }}</td>
                                                 <td>{{ $item->nip_perawat }}</td>
                                                 <td>{{ $item->nohp_perawat }}</td>
                                                 <td>
                                                 <img src="{{ asset('storage/'.$item->foto_perawat) }}" width="100" alt="Perawat's Photo">


                                                 </td>
                                                <td>
                                                    <!-- <a href="#"class="btn btn-warning">Edit</a>
                                                <a href="#"class="btn btn-danger">Hapus</a> -->
                                                <div class="btn-group mb-3"
                                                    role="group"
                                                    aria-label="Basic example">
                                                    <a href="tambah-perawat" role="button" class="btn btn-icon btn-danger"><i class="far fa-edit"></i></a> 
                                                    <a href="tambah-perawat" role="button" class="btn btn-icon btn-warning"><i class="fas fa-times"></i></a>
                                                    <a href="tambah-perawat" role="button" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                                                </div>
                                            </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
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
