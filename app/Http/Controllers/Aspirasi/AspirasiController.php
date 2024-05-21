<?php

namespace App\Http\Controllers\Aspirasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\AspirasiRequest;
use App\Models\Aspirasi;
use App\Models\Aspriasi;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::all();
        return view('aspirasi.index', compact('aspirasi'));
    }

    public function view($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return view('aspirasi.view', compact('aspirasi'));
    }
}
