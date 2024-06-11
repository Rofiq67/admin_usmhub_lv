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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    
    <title>USM HUB | View </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"> Detail Post {{ $feed->judul }} </h6>
                <div class="d-flex">
                    <a href="{{ route('feed.index') }}" class="btn btn-primary me-2">Kembali</a>
                    <a href="{{ route('feed.edit', $feed->id) }}" class="btn btn-warning">Edit</a>
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
                                        <th>Kategori</th>
                                        <td>{{ $feed->kategori }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul Post</th>
                                        <td> {{ $feed->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{!! clean($feed->deskripsi) !!}</td>
                                    </tr>
                                    <tr>
                                        <th>File pendukung</th>
                                        <td>
                                            @if($feed->doc_feed)
                                                <a href="{{ asset('storage/' . $feed->doc_feed) }}" target="_blank">Lihat Dokumen</a>
                                            @else
                                                Tidak ada File
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Status</th>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($feed->uploaded)
                                                    <span class="text-success">Sudah diupload</span>
                                                    <span class="text-muted">({{ $feed->status }})</span>
                                                @else
                                                    <span class="font-weight-bold">Belum diupload</span>
                                                    <form action="{{ route('feed.upload', $feed->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" id="uploadFeedBtn">Upload</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr> --}}

                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{$feed->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Photo</th>
                                        <td>
                                            @if($feed->img_banner)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $feed->img_banner)) }}" alt="Photo Banner" style="height: 100px; width: 100px; object-fit: cover; border-radius: 5px;">
                                            @else
                                                Tidak ada photo
                                            @endif
                                        </td>
                                    </tr>
                                    
                                </table>
                                <div class="d-flex justify-content-end mt-4 mb-2">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Hapus</button>
                                </div>

                                {{-- delete  --}}
                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus item ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form id="deleteForm" action="{{ route('feed.destroy', $feed->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- upload  -->
                                {{-- <div class="modal fade" id="confirmUploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Upload</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin mengupload feed ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <!-- Tambahkan event onclick yang memanggil fungsi confirmUpload() -->
                                                <button type="button" class="btn btn-primary" onclick="confirmUpload()">Ya, Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

{{-- <script>
    function uploadFeed(feedId) {
        // Tampilkan modal konfirmasi sebelum upload
        $('#confirmUploadModal').modal('show');
        // Simpan ID feed untuk digunakan saat upload
        $('#confirmUploadModal').data('feedId', feedId);
    }

    function confirmUpload() {
        // Ambil ID feed dari modal
        var feedId = $('#confirmUploadModal').data('feedId');
        
        fetch(`/api/feed/upload/${feedId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ id: feedId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Jika upload berhasil, tampilkan toast sukses
                showToast('success', 'Feed berhasil diupload');
                // Refresh halaman untuk memperbarui status feed
                window.location.reload();
            } else {
                // Jika upload gagal, tampilkan toast gagal
                showToast('error', 'Gagal mengupload feed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Terjadi kesalahan saat mengupload feed');
        })
        .finally(() => {
            // Tutup modal konfirmasi setelah selesai
            $('#confirmUploadModal').modal('hide');
        });
    }

    function showToast(type, message) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr[type](message);
    }
</script> --}}

</body>
</html>
