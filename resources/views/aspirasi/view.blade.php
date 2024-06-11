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
    
    <title>USM HUB | View </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"> Aspirasi {{ $aspirasi->jenis_aspirasi }} </h6>
                <a href="{{ route('aspirasi.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div  class="dataTables_wrapper dt-bootstrap4" id="dataTable_wrapper">
                        <div class="row">
                            <div class="col-sm 12">
                                <!--itemnya-->
                                <table class="table table-bordered dataTable" id="dataTable"  width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                     <tr>
                                        <th>NIM</th>
                                        <td>{{ $aspirasi->user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $aspirasi->jenis_aspirasi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $aspirasi->program_studi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td> 
                                            {{ $aspirasi->keterangan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>rating</th>
                                        <td>{{ $aspirasi->rating }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ $aspirasi->status }}
                                                <div>
                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#confirmTelahditerimaModal">Telah diterima</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal for Telah diterima --}}
                                    <div class="modal fade" id="confirmTelahditerimaModal" tabindex="-1" role="dialog" aria-labelledby="confirmTelahditerimaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmTelahditerimaModalLabel">Konfrimasi Update Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin merubah status menjadi "Telah diterima"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('aspirasi.updateStatus', ['id' => $aspirasi->id, 'status' => 'Telah diterima']) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Diterima</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

</body>
</html>
