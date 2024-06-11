<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">
    
    <title>USM HUB | Feed </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <!-- Toast Notifikasi -->
        <div id="toast-container" class="toast-container">
            @if(session('success'))
                <div class="toast border-1" role="alert" aria-live="assertive"  data-delay="3000" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                    <div class="toast-header">
                        <div class="rounded me-2 bg-primary" style="width: 20px; height: 20px;"></div> <!-- Kotak berwarna biru untuk penambahan data -->
                        <strong class="mr-auto">Notifikasi</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('danger'))
                <div class="toast border-1" role="alert" aria-live="assertive"  data-delay="3000" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                    <div class="toast-header">
                        <div class="rounded me-2 bg-danger" style="width: 20px; height: 20px;"></div> 
                        <strong class="mr-auto">Notifikasi</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body bg-light">
                        {{ session('danger') }}
                    </div>
                </div>
            @endif
        </div>

        <!--table-->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"> Posting informasi</h6>
                <a href="{{ route('feed.create') }}" class="btn btn-primary md-6">Buat Informasi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4" id="dataTable_wrapper">
                        <div class="row mt-2">
                            <div class="col-sm 12">
                                <table class="table table-bordered dataTable" id="dataTable"  width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th data-dt-column="0" class="sorting sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="No: activate to sort column ascending" aria-sort="descending" style="width: 65.2px;">
                                                <span class="dt-column-title" role="button">
                                                    No
                                                </span>
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-sort="ascending" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column descending" style="width: 194.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Kategori
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 250.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Judul
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Keterangan: activate to sort column ascending" style="width: 293.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Deskripsi
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Rating: activate to sort column ascending" style="width: 194.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Status
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Tanggal
                                                </span>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 250.2px;">
                                                <span class="dt-column-title" role="button">
                                                    File
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 194.2px;">
                                                <span  class="dt-column-title" role="button">
                                                    Photo Banner
                                                </span>
                                            </th>
                                            <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 134.2px;">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">No</th>
                                            <th rowspan="1" colspan="1">Kategori</th>
                                            <th rowspan="1" colspan="1">Judul</th>
                                            <th rowspan="1" colspan="1">Deskripsi</th>
                                            <th rowspan="1" colspan="1">Status</th>
                                            <th rowspan="1" colspan="1">Tanggal</th>
                                            <th rowspan="1" colspan="1">File</th>
                                            <th rowspan="1" colspan="1">Photo Banner</th>
                                            <th rowspan="1" colspan="1">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($feed as $data)
                                        <tr class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->kategori }}</td>
                                            <td>{{ $data->judul }}</td>
                                            <td class="">
                                                <span class="d-inline-block text-truncate" 
                                                style="max-width: 300px; max-height: 5em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                                    {!! clean($data->deskripsi) !!}
                                                </span>
                                            </td>

                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if($data->doc_feed)
                                                    <a href="{{ asset('storage/' . $data->doc_feed) }}" target="_blank">Lihat Dokumen</a>
                                                @else
                                                    Tidak ada File
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->img_banner)
                                                    <img src="{{ asset('storage/' . str_replace('public/', '', $data->img_banner)) }}" alt="Bukti Photo" style="height: 100px; width: 100px; object-fit: cover; border-radius: 5px;">
                                                @else
                                                    Tidak ada photo
                                                @endif
                                            </td>

                                            <td class="">
                                                <a href="{{ route('feed.view', $data->id) }}" class="btn btn-primary">View</a>
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
    </div>
@endsection

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#dataTable').DataTable({
            // paging: true
            lengthMenu: [5, 10, 15],
            language: {
                info: 'Memperlihatkan halaman  _PAGE_ of _PAGES_',
                infoEmpty: 'Tidak ada data',
                infoFiltered: '(filtered from _MAX_ total records)',
                lengthMenu: 'Tampilkan _MENU_ per page',
                zeroRecords: 'Data tidak ada - sorry'
            },
            dom: '<"row"<"col-md-6 d-flex align-items-center"l<"dataTables_length">><"col-md-6 d-flex justify-content-end align-items-center"f>>t<"row"<"col-md-12 d-flex justify-content-between align-items-center"ip>>',
        });

        // Mengatur ulang jumlah data yang ditampilkan ketika dropdown berubah
        $('select[name="dataTable_length"]').change(function() {
            var length = $(this).val(); // Mendapatkan nilai pilihan dropdown
            table.page.len(length).draw(); // Mengatur jumlah data yang ditampilkan dan merender ulang tabel
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Tampilkan toast notifikasi saat halaman dimuat
        $('.toast').toast('show');
    });
</script>


<style>
    /* Mengatur lebar input pencarian */
    .dataTables_filter input {
        width: 150px; /* Atur sesuai kebutuhan */
    }

    /* Mengatur lebar dropdown jumlah data per halaman */
    .dataTables_length select {
        width: auto; /* Atur sesuai kebutuhan */
    }
</style>

</body>
</html>
