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
    
    <title>USM HUB | Pengaduan</title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <!--table-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Report Pengaduan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="dataTables_wrapper dt-bootstrap4" id="dataTable_wrapper">
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="dataTables_legth" id="dataTable_length">
                                    <label class="me-2">Show: </label>
                                    <select name="dataTable_length" aria-controls="dataTable" style="width: auto;" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="10">20</option>
                                        <option value="10">30</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <div id="dataTable_filter" class="dataTables_filter d-flex align-items-center">
                                    <label class="me-2">Search: </label>
                                    <input type="search" class="form-control form-control-sm" aria-controls="dataTable" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm 12">
                                <table class="table table-bordered dataTable" id="dataTable"  width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_desc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="No: activate to sort column ascending" aria-sort="descending" style="width: 65.2px;">
                                                No
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-sort="ascending" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="NIM: activate to sort column descending" style="width: 194.2px;">
                                                NIM
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-sort="ascending" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column descending" style="width: 194.2px;">
                                                Kategori
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 194.2px;">
                                                Program Studi
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Keterangan: activate to sort column ascending" style="width: 293.2px;">
                                                Keterangan
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 134.2px;">
                                                Tanggal
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending" style="width: 194.2px;">
                                                Butki Photo
                                            </th>
                                            <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 134.2px;">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">No</th>
                                            <th rowspan="1" colspan="1">NIM</th>
                                            <th rowspan="1" colspan="1">Kategori</th>
                                            <th rowspan="1" colspan="1">Program Studi</th>
                                            <th rowspan="1" colspan="1">Keterangan</th>
                                            <th rowspan="1" colspan="1">Tanggal</th>
                                            <th rowspan="1" colspan="1">Butki Photo</th>
                                            <th rowspan="1" colspan="1">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($pengaduan as $aduan)
                                        <tr class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $aduan->user->username }}</td>
                                            <td>{{ $aduan->jenis_pengaduan }}</td>
                                            <td>{{ $aduan->program_studi }}</td>
                                            <td class="">
                                                <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                                    {{ $aduan->keterangan }}
                                                </span>
                                            </td>
                                            <td>{{ $aduan->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if($aduan->bukti_photo)
                                                    <img src="{{ asset('storage/' . $aduan->bukti_photo) }}" alt="Bukti Photo" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                                                @else
                                                    Tidak ada bukti
                                                @endif
                                            </td>
                                            <td class="">
                                                <a href="{{ route('pengaduan.view', $aduan->id) }}" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries
                                    </div>
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                        <ul class="pagination mb-0">
                                            <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                            </li>
                                            <li class="paginate_button page-item">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                            </li>
                                            <li class="paginate_button page-item">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                            </li>
                                            <li class="paginate_button page-item">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                            </li>
                                            <li class="paginate_button page-item next" id="dataTable_next">
                                                <a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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

</body>
</html>
