<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Aspirasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware admin ke metode-metode yang memerlukannya
        $this->middleware('admin');
    }

    public function index()
    {
        $admin = Auth::user();
        $isSuperadmin = $admin->role === 'Superadmin';
        $isDekanFTIK = $admin->role === 'Admin' && $admin->progdi === 'Dekan FTIK';
        $adminProgramStudi = $admin->progdi;

        if ($isSuperadmin || $isDekanFTIK) {
            $totalAduan = Aduan::count();
            $totalAspirasi = Aspirasi::count();
            $totalMahasiswa = User::where('role', 'User')->count();
            $todayAduanCount = Aduan::whereDate('created_at', Carbon::today())->count();
            $todayAspirasiCount = Aspirasi::whereDate('created_at', Carbon::today())->count();
            $todayUserCount = User::whereDate('created_at', Carbon::today())->count();
        } else {
            $totalAduan = Aduan::where('program_studi', $adminProgramStudi)->count();
            $totalAspirasi = Aspirasi::where('program_studi', $adminProgramStudi)->count();
            $totalMahasiswa = User::where('role', 'User')
                ->where('progdi', $adminProgramStudi)
                ->count();
            $todayAduanCount = Aduan::whereDate('created_at', Carbon::today())
                ->where('program_studi', $adminProgramStudi)
                ->count();
            $todayAspirasiCount = Aspirasi::whereDate('created_at', Carbon::today())
                ->where('program_studi', $adminProgramStudi)
                ->count();
            $todayUserCount = User::whereDate('created_at', Carbon::today())
                ->where('progdi', $adminProgramStudi)
                ->count();
        }

        // chart 
        // Kategori Aduan dan Aspirasi line chart
        $kategoriAduanQuery = Aduan::select(
            DB::raw('MONTH(created_at) as month'),
            'jenis_pengaduan',
            DB::raw('count(*) as count')
        );
        $kategoriAspirasiQuery = Aspirasi::select(
            DB::raw('MONTH(created_at) as month'),
            'jenis_aspirasi',
            DB::raw('count(*) as count')
        );

        if (!($isSuperadmin || $isDekanFTIK)) {
            $kategoriAduanQuery->where('program_studi', $adminProgramStudi);
            $kategoriAspirasiQuery->where('program_studi', $adminProgramStudi);
        }

        $kategoriAduan = $kategoriAduanQuery->groupBy('month', 'jenis_pengaduan')->get();
        $kategoriAspirasi = $kategoriAspirasiQuery->groupBy('month', 'jenis_aspirasi')->get();

        // Aduan dan Aspirasi berdasarkan Program Studi donut chart
        $aduanByProgramStudi = Aduan::select('program_studi', DB::raw('count(*) as count'))
            ->groupBy('program_studi')
            ->get();

        $aspirasiByProgramStudi = Aspirasi::select('program_studi', DB::raw('count(*) as count'))
            ->groupBy('program_studi')
            ->get();

        return view('dashboard.index', compact(
            'admin',
            'totalAduan',
            'totalAspirasi',
            'aduanByProgramStudi',
            'aspirasiByProgramStudi',
            'kategoriAduan',
            'kategoriAspirasi',
            'todayAduanCount',
            'todayAspirasiCount',
            'todayUserCount',
            'totalMahasiswa'
        ));
    }
}
