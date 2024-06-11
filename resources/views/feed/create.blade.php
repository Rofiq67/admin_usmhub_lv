<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">
    <!-- Add Trix Editor CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    
    <title>USM HUB | Postingan </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Buat Postingan</h6>
                <a href="{{ route('feed.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('feed.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" id="kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Aspirasi">Aspirasi</option>
                            <option value="Pengaduan">Pengaduan</option>
                            <option value="Informasi">Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Post</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Gunakan deskripsi sebaik mungkin)</label>
                        <input id="deskripsi" type="hidden" name="deskripsi" required>
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>
                    <div class="mb-3">
                        <label for="doc_feed" class="form-label">File ( pdf - max 2mb )</label>
                        <input type="file" class="form-control" name="doc_feed" id="doc_feed">
                        @error('doc_feed')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo Banner ( jpg, jpeg, png - max : 2mb )</label>
                        <input type="file" class="form-control" name="img_banner" id="photo" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" value="Belum diupload" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    {{-- modal confirm create  --}}
                    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Simpan Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menyimpan data feed ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Ya, Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add Trix Editor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script>
    document.addEventListener('trix-attachment-add', function(event) {
        event.preventDefault();  // This line disables attachments
    });
</script>

<script>
    $(document).ready(function() {
        // Tampilkan modal saat tombol "Simpan" ditekan
        $('form').submit(function(e) {
            e.preventDefault(); // Mencegah form submit langsung

            // Tampilkan modal konfirmasi
            $('#confirmationModal').modal('show');
        });
    });
</script>
</body>
</html>
