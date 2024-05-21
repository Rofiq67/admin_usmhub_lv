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
    
    <title>USM HUB | Data Mahasiswa </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <!--table-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Data Mahasiswa</h6>
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
                                                    Nama Lengkap
                                                </span>
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-sort="ascending" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="NIM: activate to sort column descending" style="width: 194.2px;">
                                                <span class="dt-column-title" role="button">
                                                    NIM
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 194.2px;">
                                                <span class="dt-column-title" role="button"> 
                                                    Program Studi
                                                </span>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Tanggal Lahir
                                                </span>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 194.2px;">
                                                <span class="dt-column-title" role="button">
                                                    Gender
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
                                            <th rowspan="1" colspan="1">Nama Lengkap</th>
                                            <th rowspan="1" colspan="1">NIM</th>
                                            <th rowspan="1" colspan="1">Program Studi</th>
                                            <th rowspan="1" colspan="1">Tanggal Lahir</th>
                                            <th rowspan="1" colspan="1">Gender</th>
                                            <th rowspan="1" colspan="1">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->progdi }}</td>
                                            <td>
                                                @if($user->tgl_lahir)
                                                    {{ \Carbon\Carbon::parse($user->tgl_lahir)->format('d/m/Y') }}
                                                @endif
                                            </td>
                                            <td>{{ $user->gender }}</td>
                                            <td class="">
                                                <a href="{{ route('users.view', $user->id) }}" class="btn btn-primary">View</a>
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
