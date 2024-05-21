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

    <title>USM HUB | Edit Postingan</title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Postingan {{ $feed->judul }}</h6>
                <a href="{{ route('feed.view', $feed->id) }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('feed.update', $feed->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" id="kategori" required>
                            <option value="" disabled>Pilih Kategori</option>
                            <option value="Aspirasi" {{ $feed->kategori == 'Aspirasi' ? 'selected' : '' }}>Aspirasi</option>
                            <option value="Pengaduan" {{ $feed->kategori == 'Pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                            <option value="Informasi" {{ $feed->kategori == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Post</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul" value="{{ $feed->judul }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Gunakan deskripsi sebaik mungkin)</label>
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ $feed->deskripsi }}" required>
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>
                    <div class="mb-3">
    <label for="doc_feed" class="form-label">File pendukung (pdf)</label>
    <input type="file" class="form-control" name="doc_feed" id="doc_feed">
    @if ($feed->doc_feed)
        <div class="mt-2">
            <a href="{{ asset('storage/' . $feed->doc_feed) }}" target="_blank">Lihat Dokumen</a>
        </div>
    @else
        <div class="mt-2">Tidak ada File</div>
    @endif
</div>
<div class="mb-3">
    <label for="img_banner" class="form-label">Photo Banner</label>
    <input type="file" class="form-control" name="img_banner" id="img_banner">
    @if ($feed->img_banner)
        <div class="mt-2">
            <img src="{{ asset('storage/' . str_replace('public/', '', $feed->img_banner)) }}" alt="Current Photo" style="max-width: 100%; height: auto;">
        </div>
    @else
        <div class="mt-2">Tidak ada Photo</div>
    @endif
</div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ $feed->status ? 'Sudah diupload' : 'Belum diupload' }}" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

</body>
</html>
