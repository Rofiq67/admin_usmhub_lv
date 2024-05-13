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
    <!-- Tambahkan konfigurasi TinyMCE -->
    <x-head.tinymce-config/>
    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">
    
    <title>USM HUB | Create Postingan </title>
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
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" name="category" id="category" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Aspirasi">Aspirasi</option>
                            <option value="Pengaduan">Pengaduan</option>
                            <option value="Informasi">Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Post</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan judul" required>
                    </div>
                    {{-- <x-forms.tinymce-editor/>` --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan</label>
                        <textarea class="form-control editor" name="description" id="description" placeholder="Masukkan keterangan" required></textarea>
                        {{-- <x-forms.tinymce-editor/> --}}
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" value="Belum diupload" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Bukti Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('public/tinymce/tinymce-jquery.min.js') }}"></script>
<!-- Tambahkan TinyMCE dari CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description', // ID textarea yang ingin diubah
        plugins: 'link image code', // Tambahkan plugin sesuai kebutuhan
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image', // Toolbar untuk pengguna
        branding: false, // Hilangkan branding TinyMCE
        menubar: false, // Hilangkan menu bar untuk tampilan minimalis
        height: 300, // Tinggi editor
    });
</script>
<script>
    $('.editor').tinymce({
    height: 500,
    menubar: false,
    plugins: [
        'a11ychecker','advlist','advcode','advtable','autolink','checklist','markdown',
        'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
        'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
    ],
    toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
    });
</script>

</body>
</html>
