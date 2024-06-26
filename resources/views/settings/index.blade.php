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
    
    <title>USM HUB | Profile </title>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        {{-- profile page  --}}
        <div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="{{ $user->img_profile ? asset('storage/' . str_replace('public/', '', $user->img_profile)) : 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg' }}" 
									alt="User" class="rounded-circle p-1 bg-secondary-subtle" width="110">
								<div class="mt-3">
									<h4>{{ $user->username}}</h4>
									<p class="text-secondary mb-1">{{ $user->progdi }}</p>
									<p class="text-secondary mb-1">Fakultas Teknologi Informasi dan Komunikasi</p>
									<p class="text-muted font-size-sm">Universitas Semarang</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nama Lengkap</h6>
								</div>
								<div class=" border border-secondary p-2 px-3 mb-2 rounded-pill col-sm-9 text-dark">
									{{ $user->first_name }} {{ $user->last_name }}
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
                                <div class=" border border-secondary p-2 px-3 mb-2 rounded-pill col-sm-9 text-dark">
                                    {{ $user->email}}
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Role</h6>
								</div>
                                <div class=" border border-secondary p-2 px-3 mb-2 rounded-pill col-sm-9 text-dark">
									{{ $user->role}}
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tanggal Lahir</h6>
								</div>
                                <div class=" border border-secondary p-2 px-3 mb-2 rounded-pill col-sm-9 text-dark">
                                    {{ $user->tgl_lahir}}
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Program Studi</h6>
								</div>
                                <div class=" border border-secondary p-2 px-3 mb-2 rounded-pill col-sm-9 text-dark">
									{{ $user->progdi}}
								</div>
							</div>
						</div>
					</div>
                    <div class="row mt-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary d-flex justify-content-end">
                            <a href="{{ route('settings.edit', $user->id) }}" class="btn btn-primary px-4">Edit Profile </a>
							<a href="{{ route('password.edit') }}" class="btn btn-danger ml-3 px-4">Edit Password</a>
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
