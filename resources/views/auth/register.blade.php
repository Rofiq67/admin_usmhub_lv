<!-- register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USM HUB | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body ">
                <div class="col-lg-7">
                    <div class="p-4 ">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create Your Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Repeat Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" name="tgl_lahir" placeholder="Tanggal Lahir" value="{{ old('tgl_lahir') }}">
                            </div>
                            <div class="form-group">
                                <select class="form-control  form-select rounded-pill" name="gender" required aria-label="Small select example" style="width: 100%; height: 50px;">
                                    <option disabled selected>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control  form-select rounded-pill" name="progdi" required aria-label="Small select example" style="width: 100%; height: 50px;">
                                    <option disabled selected>Program Studi</option>
                                    <option value="Dekan FTIK">Dekan FTIK</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                                    <option value="Pariwisata">Pariwisata</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control  form-select rounded-pill" name="role" required aria-label="Small select example" style="width: 100%; height: 50px;">
                                    <option  selected disabled>Role</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                        </form>
                        <hr>
                        {{-- <div class="text-center">
                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div> --}}
                        <div class="text-center">
                            <a class="small" href="{{ route('auth.login') }}">Sudah punya akun? <b>Login!</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
