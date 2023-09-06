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
                <h1>DataPasien</h1>
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
                            <div class="card-header">

                            <div class="btn-group mb-3"
                            role="group"
                            aria-label="Basic example">
                            <a href="tambah-pasien" role="button" class="btn btn-icon btn-primary"><i class="far fa-add"></i>RSA</a>
                            <a href="add-pasien" role="button" class="btn btn-icon btn-danger"><i class="far fa-add"></i>ELGAMAL</a>
                            </div>
<!-- 
                            <a href="tambah-pasien" role="button" class="btn btn-icon btn-primary"><i class="far fa-add"></i></a>
                            <a href="tambah-pasien" role="button" class="btn btn-icon btn-success"><i class="far fa-add"></i></a> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table"
                                        id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Enkripsi</th>
                                                <th>Kode Pasien</th>
                                                <th>Nama Pasien</th>
                                                <th>Kategori</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Nomor Hp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($nama_pasien as $item)
                                            <tr>
                                                @if ($item->role===0)
                                                <td>RSA</td>
                                                @else
                                                <td>ElGamal</td>
                                                @endif
                                                <td>{{ $item->kode_pasien }}</td>
                                                <td>{{ $item->nama_pasien }}</td>
                                                <td>{{ $item->kategori_pasien }}</td>
                                                <td>{{ $item->umur_pasien }}</td>
                                                <td>{{ $item->jkel_pasien }}</td>
                                                <td>{{ $item->nohp_pasien }}</td>
                                                <td>
                                                <div class="btn-group mb-3"
                                                    role="group"
                                                    aria-label="Basic example">
                                                    @if ($item->role===0)
                                                    <a href="/edit-pasien/{{ $item->id_pasien }}" role="button" class="btn btn-icon btn-secondary"><i class="fas fa-pencil-alt"></i></a> 
                                                    @else
                                                    <a href="/ubah-pasien/{{ $item->id_pasien }}" role="button" class="btn btn-icon btn-secondary"><i class="fas fa-pencil-alt"></i></a> 
                                                    @endif
                                                    
                                                    <a href="/hapus-pasien/{{ $item->id_pasien }}" role="button" class="btn btn-icon btn-dark"><i class="fas fa-trash"></i></a>

                                                    @if ($item->role===0)
                                                    <a href="/desc-pasien/{{ $item->id_pasien }}" role="button" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                                                    @else
                                                    <a href="/deks-pasien/{{ $item->id_pasien }}" role="button" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                                                    @endif
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
      <!-- JS Libraies -->
      <script src="{{ asset('library/prismjs/prism.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

@endpush
