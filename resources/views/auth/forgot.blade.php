<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USM HUB | Lupa Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">

        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card" style="border-radius: 2rem">
                    <div class="card-body p-5 text-center">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                            <!-- Toast for displaying errors -->
                            <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; top: 10px; right: 10px;">
                                <div class="toast-body bg-danger text-white">
                                    @if ($errors->has('username'))
                                        Username tidak ditemukan
                                    @elseif ($errors->has('password_baru'))
                                        Password tidak cocok
                                    @endif
                                </div>
                            </div>
                        </div>
                        <form id="forgotPassForm" method="POST" action="{{ route('auth.forgot_pass') }}">
                            @csrf
                            <div class="form-group">
                                {{-- <label for="username">Username</label> --}}
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
                            </div>
                            <div class="form-group">
                                {{-- <label for="password_baru">New Password</label> --}}
                                <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password baru" required>
                            </div>
                            <div class="form-group">
                                {{-- <label for="password_baru_confirmation">Confirm New Password</label> --}}
                                <input type="password" class="form-control" id="password_baru_confirmation" name="password_baru_confirmation" placeholder="Konfirmasi password baru" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('register') }}">Daftar akun baru</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('auth.login') }}">Sudah punya akun? <b>Login!</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <!-- Custom script for form validation without page refresh -->
    <script>
        $(document).ready(function(){
            @if ($errors->any())
                $('#errorToast').toast('show');
            @endif
        });
    </script>
</body>
</html>
