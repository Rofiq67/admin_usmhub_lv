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
                <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">Kembali</a>
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
                                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#confirmSelesaiModal">Selesai</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

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
                                </table>
                                
                                {{-- Fitur Riwayat Komentar --}}
                                
                                <h5 class="mb-4 font-weight-bold text-primary card-header py-3 d-flex justify-content-between">Komentar</h5>
                                <div class="container bg-body-tertiary">
                                    <div class="mt-4" style="max-height: 500px; overflow-y: auto;">
                                        @foreach($pengaduan->comments as $komen)
                                        <div class="mb-2 mt-2">
                                            <div class="comment-box mt-2 rounded d-inline-block">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h6>{{ $komen->user->first_name }} {{ $komen->user->last_name }}</h6>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{ $komen->id }}">Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $komen->id }}">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                        <a href="{{ asset('storage/' . $komen->file) }}" download>
                                                            <div class="d-flex align-items-center badge text-wrap fs-6 p-2 mb-2 @if($komen->user->is_admin) bg-primary text-white @elseif($komen->user->id === Auth::user()->id) bg-light @endif">
                                                                <span class="badge bg-light rounded-circle d-flex justify-content-center align-items-center mr-2" style="width: 30px; height: 30px">
                                                                    <i class="fa fa-file text-primary"></i>
                                                                </span>
                                                                <span>{{ $komen->file }}</span>
                                                                <span class="badge bg-light rounded-circle d-flex justify-content-center align-items-center ml-2" style="width: 30px; height: 30px">
                                                                    <i class="fa fa-download text-primary"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endif
                                                <p class=" p-2 badge text-wrap fs-6 @if($komen->user->is_admin) bg-primary text-white @elseif($komen->user->id === Auth::user()->id) bg-light @endif" style="text-align: left;">{{ $komen->text }}</p>
                                                <span class="comment-time" style="padding-top: 0">
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
                                <form class="mr-4 ml-4 mt-3" action="{{ route('kirim.komentar') }}" method="POST" enctype="multipart/form-data" id="commentForm">
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

</script>
</body>
</html>
