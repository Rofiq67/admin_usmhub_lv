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
    {{-- <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}"> --}}
    
    <title>USM HUB | View Aduan </title>
    
    
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"> Pengaduan {{ $pengaduan->jenis_pengaduan }} </h6>
                <div class="d-flex justify-content-end align-items-center">
                    <form id="forwardForm" action="{{ route('pengaduan.forward', $pengaduan->id) }}" method="POST" class="input-group me-2">
                        @csrf
                        @method('PUT')
                        <select class="form-select" name="program_studi" id="programSelect" aria-label="Example select with button addon">
                            <option disabled selected>Pilih Program Studi</option>
                            @if(Auth::user()->progdi === 'Dekan FTIK')
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <option value="Pariwisata">Pariwisata</option>
                            @else
                            <option value="Dekan FTIK">Dekan FTIK</option>
                            @endif
                        </select>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmForwardModal">Teruskan Aduan</button>
                    </form>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">Kembali</a>
                </div>
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
                                        <td>{{ $pengaduan->user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $pengaduan->jenis_pengaduan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $pengaduan->program_studi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td> 
                                            {{ $pengaduan->keterangan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>rating</th>
                                        <td>{{ $pengaduan->rating }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Photo</th>
                                        <td>
                                            @if($pengaduan->bukti_photo)
                                                <img src="{{ asset('storage/photos/' . $pengaduan->bukti_photo) }}" alt="Bukti Photo" style="height: 100px; width: 100px; object-fit: cover; border-radius: 5px;">
                                            @else
                                                Tidak ada photo
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ $pengaduan->status }}
                                                <div>
                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#confirmDitindaklanjutiModal">Ditindaklanjuti</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#confirmSelesaiModal">Selesai</button>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDitolakModal">Ditolak</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal for forward aduan--}}
                                    <div class="modal fade" id="confirmForwardModal" tabindex="-1" aria-labelledby="confirmForwardModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmForwardModalLabel">Konfirmasi Teruskan Aduan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin untuk meneruskan laporan aduan ini ke <span id="selectedProgramStudi"></span>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-warning" id="confirmForwardBtn">Teruskan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal for Ditindaklanjuti --}}
                                    <div class="modal fade" id="confirmDitindaklanjutiModal" tabindex="-1" role="dialog" aria-labelledby="confirmDitindaklanjutiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDitindaklanjutiModalLabel">Konfrimasi Update Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin merubah status menjadi "Ditindaklanjuti"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pengaduan.updateStatus', ['id' => $pengaduan->id, 'status' => 'Ditindaklanjuti']) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Ditindaklanjuti</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal for Selesai --}}
                                    <div class="modal fade" id="confirmSelesaiModal" tabindex="-1" role="dialog" aria-labelledby="confirmSelesaiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmSelesaiModalLabel">Konfrimasi Update Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin merubah status menjadi "Selesai"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pengaduan.updateStatus', ['id' => $pengaduan->id, 'status' => 'Selesai']) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Modal for Ditolak--}}
                                    <div class="modal fade" id="confirmDitolakModal" tabindex="-1" role="dialog" aria-labelledby="confirmDitolakModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDitolakModalLabel">Konfrimasi Update Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin untuk <b>menolak</b> aduan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pengaduan.updateStatus', ['id' => $pengaduan->id, 'status' => 'Ditolak']) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </table>
                                
                                {{-- Fitur Riwayat Komentar --}}
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary">Komentar</h6>
                                    </div>
                                    <div class="card-body" style="max-width: 100%; overflow-x: auto;">
                                        <div class="mt-4" style="max-height: 500px; overflow-y: auto;">
                                            @foreach($pengaduan->comments as $komen)
                                            <div class="mb-2 mt-2 d-flex @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) flex-column @else flex-column-reverse align-items-end @endif">
                                                <div class="comment-box mt-2 rounded d-inline-block @if(!($komen->user->isAdmin() || $komen->user->isSuperAdmin())) text-right float-right d-flex flex-column align-items-end @else float-left d-flex flex-column @endif">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="@if(!($komen->user->isAdmin() || $komen->user->isSuperAdmin())) float-left mr-3 @endif">{{ $komen->user->first_name }} {{ $komen->user->last_name }}</h6>
                                                            @if($komen->user->isAdmin() || $komen->user->isSuperAdmin())
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{ $komen->id }}">Edit</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $komen->id }}">Hapus</a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-column @if(!($komen->user->isAdmin() || $komen->user->isSuperAdmin())) align-items-end  mr-3 @endif">
                                                        @if($komen->file)
                                                        @if(in_array(pathinfo($komen->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <!-- Gambar -->
                                                        <div>
                                                            <a href="{{ asset('storage/' . $komen->file) }}">
                                                                <img class="img-thumbnail mb-2" src="{{ asset('storage/' . $komen->file) }}" alt="File" style="height: 100px; width: 100px; object-fit: cover; border-radius: 5px;">
                                                            </a>
                                                        </div>
                                                        @else
                                                        <!-- File -->
                                                        <div class="p-2 badge mb-2 text-wrap fs-6 rounded @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) bg-primary text-white @else bg-secondary  text-light @endif" style="text-align: left;width: fit-content;">
                                                            <a href="{{ asset('storage/' . $komen->file) }}" download>
                                                                <div class="d-flex align-items-center badge text-wrap fs-6 p-2 mb-2 @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) bg-primary text-white @elseif($komen->user->id === Auth::user()->id) bg-light @endif">
                                                                    <span class="badge bg-light rounded-circle d-flex justify-content-center align-items-center mr-2" style="width: 30px; height: 30px">
                                                                        <i class="fa fa-file @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) text-primary @else text-secondary @endif"></i>
                                                                    </span>
                                                                    <span>{{ $komen->file }}</span>
                                                                    <span class="badge bg-light rounded-circle d-flex justify-content-center align-items-center ml-2" style="width: 30px; height: 30px">
                                                                        <i class="fa fa-download  @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) text-primary @else text-secondary @endif"></i>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @endif
                                                        @endif

                                                        <div class="p-2 badge text-wrap fs-6 rounded @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) bg-primary text-white @else bg-secondary text-light  @endif" style="text-align: left; width: fit-content;">
                                                            {{ $komen->text }}
                                                        </div>
                                                    </div>

                                                    <span class="comment-time m-2 @if($komen->user->isAdmin() || $komen->user->isSuperAdmin()) float-left @else float-right mr-3 @endif" style="padding-top: 0">
                                                        @php
                                                        $commentTime = \Carbon\Carbon::parse($komen->created_at);
                                                        $now = \Carbon\Carbon::now();
                                                        @endphp
                                                        @if($commentTime->isSameDay($now))
                                                        {{ $commentTime->format('H:i') }}
                                                        @else
                                                        {{ $commentTime->format('d/m/Y H:i') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Form untuk menambahkan komentar -->
                                <form class="mr-4 ml-4 mt-3 position-sticky bottom-0" action="{{ route('kirim.komentar') }}" method="POST" enctype="multipart/form-data" id="commentForm">
                                    @csrf
                                    <input type="hidden" name="aduan_id" value="{{ $pengaduan->id }}">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" style="width: fit-content;" for="inputGroupFile"><i class="fa fa-file"></i></label>
                                        <input type="file" class="form-control visually-hidden" id="inputGroupFile" name="file" style="padding-left: 5px;" aria-label="Upload File" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" onchange="fileSelected(this)">
                                        <button class="btn btn-secondary d-none" type="button" id="cancelBtn" onclick="cancelFileSelection()">Batal</button>
                                        <input  type="text" class="form-control" placeholder="Tulis komentar..." aria-label="Tulis komentar..." name="text" id="commentText">
                                        <button class="btn btn-primary" type="submit" id="submitBtn" disabled>Kirim</button>
                                    </div>
                                </form>

                                {{-- modal komentar  --}}
                                {{-- edit  --}}
                                @foreach($pengaduan->comments as $komen)
                                    <div class="modal fade" id="editModal{{ $komen->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Komentar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('komentar.update', $komen->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="text">Komentar</label>
                                                            <textarea class="form-control" name="text" rows="3" required>{{ $komen->text }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="file">File (Optional)</label>
                                                            <input type="file" class="form-control-file" name="file">
                                                            @if($komen->file)
                                                                <small class="form-text text-muted">Current file: {{ $komen->file }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- hapus komentar  --}}
                                    <div class="modal fade" id="deleteModal{{ $komen->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Komentar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus komentar ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('komentar.destroy', $komen->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    //btn select file komentar
    function fileSelected(input) {
        var files = input.files;
        var cancelBtn = document.getElementById('cancelBtn');
        if (files.length > 0) {
            input.classList.remove('visually-hidden');
            cancelBtn.classList.remove('d-none');
        } else {
            input.classList.add('visually-hidden');
            cancelBtn.classList.add('d-none');
        }
        checkFormActivity();
    }

    function cancelFileSelection() {
        var input = document.getElementById('inputGroupFile');
        var cancelBtn = document.getElementById('cancelBtn');
        input.value = ''; // Clear selected file
        input.classList.add('visually-hidden'); // Hide input again
        cancelBtn.classList.add('d-none'); // Hide cancel button
        checkFormActivity();
    }

    document.addEventListener("DOMContentLoaded", function() {
        var commentText = document.getElementById('commentText');
        var inputGroupFile = document.getElementById('inputGroupFile');
        var submitBtn = document.getElementById('submitBtn');

        commentText.addEventListener('input', checkFormActivity);
        inputGroupFile.addEventListener('change', checkFormActivity);

        function checkFormActivity() {
            var textInput = commentText.value.trim();
            var fileInput = inputGroupFile.files.length;
            
            if (textInput !== '' || fileInput > 0) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'disabled');
            }
        }
    });

    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });

    //select forward
    document.addEventListener('DOMContentLoaded', function() {
        const forwardForm = document.querySelector('form[action*="forward"]');
        const programStudiSelect = document.getElementById('inputGroupSelect04');
        const forwardButton = forwardForm.querySelector('button[type="submit"]');

        forwardButton.addEventListener('click', function(event) {
            if (programStudiSelect.value === 'Pilih Program Studi') {
                event.preventDefault();
                alert('Silakan pilih program studi terlebih dahulu.');
            }
        });
    });

    //confirm foraward
     $(document).ready(function() {
            $('#confirmForwardModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var selectedProgram = $('#programSelect').find('option:selected').text();
                var modal = $(this);
                modal.find('#selectedProgramStudi').text(selectedProgram);
            });

            $('#confirmForwardBtn').on('click', function () {
                $('#forwardForm').submit();
            });
        });
</script>

</body>
</html>
