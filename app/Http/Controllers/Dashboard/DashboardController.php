<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Aspirasi;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware admin ke metode-metode yang memerlukannya
        $this->middleware('admin');
    }
    public function index()
    {
        $todayAduanCount = Aduan::whereDate('created_at', Carbon::today())->count();
        $todayAspirasiCount = Aspirasi::whereDate('created_at', Carbon::today())->count();
        $todayUserCount = User::whereDate('created_at', Carbon::today())->count();


        $kategoriAduan =
            Aduan::select(
                FacadesDB::raw('MONTH(created_at) as month'),
                'jenis_pengaduan',
                FacadesDB::raw('count(*) as count')
            )->groupBy('month', 'jenis_pengaduan')->get();

        $kategoriAspirasi =
            Aspirasi::select(
                FacadesDB::raw('MONTH(created_at) as month'),
                'jenis_aspirasi',
                FacadesDB::raw('count(*) as count')
            )->groupBy('month', 'jenis_aspirasi')->get();

        $aduanByProgramStudi = Aduan::select('program_studi', FacadesDB::raw('count(*) as count'))
            ->groupBy('program_studi')
            ->get();

        $aspirasiByProgramStudi = Aspirasi::select('program_studi', FacadesDB::raw('count(*) as count'))
            ->groupBy('program_studi')
            ->get();

        return view('dashboard.index', compact(
            'aduanByProgramStudi',
            'aspirasiByProgramStudi',
            'kategoriAduan',
            'kategoriAspirasi',
            'todayAduanCount',
            'todayAspirasiCount',
            'todayUserCount'
        ));
    }
}
