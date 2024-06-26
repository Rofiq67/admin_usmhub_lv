<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Create user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'progdi' => $validated['progdi'],
            'gender' => $validated['gender'],
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('dashboard.index')->with('success', 'Account created successfully! You are now logged in.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return response()->json([
                    'redirect' => route('dashboard.index'),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Anda bukan admin',
                ], 422);
            }
        }

        return response()->json([
            'message' => 'Username atau password salah',
        ], 422);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('settings.edit', compact('user'));
    }

    public function updateProfile(UsersRequest $request)
    {
        $user = Auth::user();

        // Handle file upload
        if ($request->hasFile('img_profile')) {
            // Delete old image if it exists
            if ($user->img_profile) {
                Storage::delete($user->img_profile);
            }
            // Store the new image
            $path = $request->file('img_profile')->store('photos', 'public');
            $user->img_profile = $path;
        }

        // Update user data
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Profile updated successfully.');
    }

    public function editPass()
    {
        $user = Auth::user();
        return view('settings.editPass', compact('user'));
    }

    public function updatePass(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak cocok']);
        }

        // Update password
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('settings.index')->with('success', 'Password updated successfully.');
    }
}
