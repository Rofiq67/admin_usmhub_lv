<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // register user mobile
        $request->validated();

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($userData);

        // Tambahkan peran admin secara default jika user yang didaftarkan adalah admin
        if ($request->is_admin) {
            $user->is_admin = true;
            $user->save();
        }

        $token = $user->createToken('usm_hub')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // public function loginApi(LoginRequest $request)
    // {
    //     $user = User::where('username', $request->username)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'message' => 'Invalid credentials',
    //         ], 422);
    //     }

    //     $token = $user->createToken('usm_hub')->plainTextToken;

    //     return response()->json([
    //         'user' => $user,
    //         'token' => $token,
    //         'is_admin' => $user->isAdmin(),
    //     ], 200);
    // }


    public function login(LoginRequest $request)
    {
        $request->validated();

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Cek apakah pengguna merupakan admin
            if (Auth::user()->is_admin) {
                return response()->json([
                    'redirect' => route('dashboard.index'),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Anda bukan admin',
                ], 422);
            }
        }

        // Validasi gagal, cek apakah salah username atau password
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Username salah',
            ], 422);
        } else {
            if (!password_verify($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Password salah',
                ], 422);
            }
        }

        // Jika tidak ada pengguna dengan username yang cocok atau password yang salah
        return response()->json([
            'message' => 'Username atau password salah',
        ], 422);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }




    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('login');
    // }





    // public function logoutAdmin()
    // {
    //     // Logout admin
    //     Auth::logout();
    //     return redirect()->route('login.admin');
    // }


    // public function registerAdmin(RegisterRequest $request)
    // {
    //     // Register admin
    //     $request->validated();

    //     $userData = [
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'username' => $request->username,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'is_admin' => true,
    //     ];

    //     $user = User::create($userData);

    //     $token = $user->createToken('usm_hub')->plainTextToken;

    //     return response([
    //         'user' => $user,
    //         'token' => $token,
    //     ], 201);
    // }
}
