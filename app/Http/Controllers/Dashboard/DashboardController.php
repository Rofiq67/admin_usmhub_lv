<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware admin ke metode-metode yang memerlukannya
        $this->middleware('admin');
    }
    public function index()
    {
        return view('dashboard.index');
    }
}
