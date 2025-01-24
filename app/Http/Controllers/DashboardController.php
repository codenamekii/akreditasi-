<?php

namespace App\Http\Controllers;

use App\Models\dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\DataProgramStudiController;
use App\Models\TabelK3MahasiswaLuarNegeri;
use App\Models\TabelK3MahasiswaReguler;
use App\Models\TabelK4DtpsKeahlianPS;
use App\Models\TabelK7PelibatanMahasiswaPenelitian;
use App\Models\TabelK8PelibatanMhsPkm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
 
    public function __construct()
    {
        $this->akunController = new AkunController();
    }

    public function index()
    {
        
        $tahun_sekarang = Carbon::now()->year;
        $tahun_terakhir = $tahun_sekarang - 4;
        $semua_tahun = range($tahun_terakhir, $tahun_sekarang);

        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        // $jumlah_user = User::where('prodi_id', $prodiID)->count();
        if(auth()->user()->role == 'fakultas') {
            $jumlah_user = User::where('id', '!=', 1)
            ->where('role', "!=", "asesor")
            ->where('role', '!=', 'root')
            ->whereHas('prodi', function ($query) {
                $query->where('fakultas_id', Auth::user()->prodi->fakultas_id);
            })
            ->count();
        } else {
            $jumlah_user = User::where('id', '!=', 1)
            ->where('prodi_id', auth()->user()->prodi->id)
            ->where('role', "!=", "fakultas")
            ->where('role', '!=', 'root')
            ->count();
        }


        $data_mhs = $items = TabelK3MahasiswaReguler::where('prodi_id', $prodiID)
            ->whereBetween('tahun_akademik', [$tahun_terakhir, $tahun_sekarang])
            ->orderBy('tahun_akademik', 'desc')
            ->get();
        $totalMhsReguler = $data_mhs->sum('total');

        $data_mhs_ln = $items = TabelK3MahasiswaLuarNegeri::where('prodi_id', $prodiID)
            ->whereBetween('tahun_akademik', [$tahun_terakhir, $tahun_sekarang])
            ->orderBy('tahun_akademik', 'desc')
            ->get();
        $totalMhsLN = $data_mhs_ln->sum('total_mahasiswa');
        

        $dtpsSesuaiBidang = TabelK4DtpsKeahlianPS::where('prodi_id', $prodiID)
            ->where('sesuai_ps', 'ya')
            ->count();
        $dtpsTidakSesuaiBidang = TabelK4DtpsKeahlianPS::where('prodi_id', $prodiID)
            ->where('sesuai_ps', '!=', 'ya')
            ->count();

        $data_penelitian = DB::table('tabel_k7_pelibatan_mhs_penelitians')
        ->select(
            DB::raw('tahun_akademik'),
            DB::raw('COUNT(tahun_akademik) as jumlah')
        )
        ->where('prodi_id', $prodiID)
        ->whereBetween('tahun_akademik', [$tahun_terakhir, $tahun_sekarang])
        ->groupBy('tahun_akademik')
        ->orderBy('tahun_akademik')
        ->get()
        ->keyBy('tahun_akademik')
        ->toArray();

        $data_pkm = DB::table('tabel_k8_pelibatan_mhs_pkms')
        ->select(
            DB::raw('tahun_akademik'),
            DB::raw('COUNT(tahun_akademik) as jumlah')
        )
        ->where('prodi_id', $prodiID)
        ->whereBetween('tahun_akademik', [$tahun_terakhir, $tahun_sekarang])
        ->groupBy('tahun_akademik')
        ->orderBy('tahun_akademik')
        ->get()
        ->keyBy('tahun_akademik')
        ->toArray();

        // Gabungkan hasil query dengan array semua tahun, mengisi dengan 0 jika tidak ada data untuk tahun tertentu
        $jumlah_penelitian = [];
        foreach ($semua_tahun as $tahun) {
            $jumlah_penelitian[] = [
                'tahun_akademik' => $tahun,
                'jumlah' => isset($data_penelitian[$tahun]) ? $data_penelitian[$tahun]->jumlah : 0
            ];
        }
        
        $jumlah_pkm = [];
        foreach ($semua_tahun as $tahun) {
            $jumlah_pkm[] = [
                'tahun_akademik' => $tahun,
                'jumlah' => isset($data_pkm[$tahun]) ? $data_pkm[$tahun]->jumlah : 0
            ];
        }

        //prestasi Mahasiswa
        $prestasiMahasiswa = DB::table('tabel_k9_prestasi_mahasiswas')
            ->select(
                DB::raw('YEAR(waktu) as tahun'),
                'tingkat',
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween(DB::raw('YEAR(waktu)'), [$tahun_terakhir, $tahun_sekarang])
            ->groupBy('tahun', 'tingkat')
            ->orderBy('tahun')
            ->get()
            ->groupBy('tahun')
            ->toArray();

        $years = range($tahun_terakhir, $tahun_sekarang);
        $levels = ['internasional', 'nasional', 'lokal'];

        $prestasiMhs = [];
        foreach ($levels as $level) {
            $data = [];
            foreach ($years as $year) {
                $tahunData = $prestasiMahasiswa[$year] ?? null;
                if ($tahunData) {
                    $tingkatData = collect($tahunData)->firstWhere('tingkat', $level);
                    $data[] = $tingkatData ? $tingkatData->total : 0;
                } else {
                    $data[] = 0;
                }
            }
            $prestasiMhs[] = [
                'label' => $level,
                'data' => $data,
                'backgroundColor' => ($level == 'internasional') ? 'rgba(255, 99, 132, 0.2)' : (($level == 'nasional') ? 'rgba(54, 162, 235, 0.2)' : 'rgba(75, 192, 192, 0.2)'),
                'borderColor' => ($level == 'internasional') ? 'rgba(255, 99, 132, 1)' : (($level == 'nasional') ? 'rgba(54, 162, 235, 1)' : 'rgba(75, 192, 192, 1)'),
                'borderWidth' => 1,
            ];
        }
        
        $programStudiController = new DataProgramStudiController();
        $semuaProdi = $programStudiController->getSemuaProdi();

        if ($prodiID != null) {
            return view('dashboard.index', compact(
                'semuaProdi', 'jumlah_penelitian', 'jumlah_pkm', 
                'jumlah_user', 'totalMhsReguler', 'dtpsSesuaiBidang',
                'totalMhsLN', 'prestasiMhs', 'years', 'levels'
            ));
        }else{
            $jumlah_penelitian[] = 0; $jumlah_pkm[] = 0;
            $jumlah_user = 0; $totalMhsReguler = 0;
            $dtpsSesuaiBidang = 0; $totalMhsLN = 0;
            $prestasiMhs[] = 0; $years = 0;
        }

        return view('dashboard.index', compact(
            'semuaProdi', 'jumlah_penelitian', 'jumlah_pkm',
            'jumlah_user', 'totalMhsReguler', 'dtpsSesuaiBidang',
            'totalMhsLN', 'prestasiMhs', 'years','levels'
            ))->withErrors(['pesan' => 'Silahkan pilih prodi terlebih dahulu']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(dashboard $dashboard)
    {
        //
        return view('dashboard.form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(dashboard $dashboard)
    {
        //
    }
}
