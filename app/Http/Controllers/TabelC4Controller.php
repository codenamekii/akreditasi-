<?php

namespace App\Http\Controllers;

use App\Models\tabelC4;
use App\Models\TabelDosen;
use App\Models\TabelK3MahasiswaReguler;
use App\Models\TabelK4BebanKerjaDTPS;
use App\Models\TabelK4BimbinganTA;
use App\Models\TabelK4DtpsKeahlianPS;
use App\Models\TabelK4DtpsLuarPS;
use App\Models\TabelK4KegiatanMengajar;
use App\Models\TabelK4KompetensiTendik;
use App\Models\TabelK4PengembanganKompetensiDTPS;
use App\Models\TabelK4PrestasiDTPS;
use App\Models\TabelK4Tendik;
use App\Models\TabelMatakuliah;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TabelC4Controller extends Controller
{
    public function __construct()
    {
        $this->akunController = new AkunController();
    }

    public function index()
    {
        //
        return view('kriteria.c4.index');
    }

    // Tabel 4.1.2.2 DTPS yang Bidang Keahliannya Sesuai dengan Bidang PS
    public function dtps_keahlian_bidang_ps_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4DtpsKeahlianPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
            ->where('sesuai_ps','=','ya')
            ->orderBy('nama', 'asc')
            ->get();
        }else{
            $items = TabelK4DtpsKeahlianPS::where('prodi_id', auth()->user()->prodi_id)
            ->where('sesuai_ps','=','ya')
            ->orderBy('nama', 'asc')
            ->get();
        }

        // $items = TabelK4DtpsKeahlianPS::where('sesuai_ps','=','ya')->get();
        return view('kriteria.c4.dtps_keahlian_bidang_ps.index', ['items' => $items]);
    }
    public function dtps_keahlian_bidang_ps_create()
    {
        //
        return view('kriteria.c4.dtps_keahlian_bidang_ps.form');

    }
    public function dtps_keahlian_bidang_ps_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nidn_nidk' => 'required',
            'tanggal_lahir' => 'required|date',
            'sertifikat_pendidik' => 'required',
            'jabatan_fungsional' => 'required',
            'gelar_akademik' => 'required',
            'pendidikan' => 'required',
            'bidang_keahlian' => 'required',
        ]);

        TabelK4DtpsKeahlianPS::create([
            'nama' => $request->nama,
            'nidn_nidk' => $request->nidn_nidk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'sertifikat_pendidik' => $request->sertifikat_pendidik,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gelar_akademik' => $request->gelar_akademik,
            'pendidikan' => $request->pendidikan,
            'bidang_keahlian' => $request->bidang_keahlian,
            'sesuai_ps' => 'ya',
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);

        return redirect()->route('dtps_ps.index')->with('success', 'Data K4 DTPS Sesuai Keahlian PS CREATED successfully');
    }

    public function dtps_keahlian_bidang_ps_show(tabelC4 $tabelC4)
    {
        //
    }
    public function dtps_keahlian_bidang_ps_edit($id)
    {
        $item = TabelK4DtpsKeahlianPS::findOrFail($id);
        return view('kriteria.c4.dtps_keahlian_bidang_ps.form', ['item' => $item]);
    }

    public function dtps_keahlian_bidang_ps_update(Request $request, $id)
    {
        $idx =Crypt::decryptString($id);
        $data = TabelK4DtpsKeahlianPS::findOrFail($idx);
        $request->validate([
            'nama' => 'required',
            'nidn_nidk' => 'required',
            'tanggal_lahir' => 'required|date',
            'sertifikat_pendidik' => 'required',
            'jabatan_fungsional' => 'required',
            'gelar_akademik' => 'required',
            'pendidikan' => 'required',
            'bidang_keahlian' => 'required',
        ]);

        $data->update([
            'nama' => $request->nama,
            'nidn_nidk' => $request->nidn_nidk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'sertifikat_pendidik' => $request->sertifikat_pendidik,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gelar_akademik' => $request->gelar_akademik,
            'pendidikan' => $request->pendidikan,
            'bidang_keahlian' => $request->bidang_keahlian,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('dtps_ps.index')->with('success', 'Data K4 DTPS Sesuai Keahlian PS Updated successfully');
    }
    public function dtps_keahlian_bidang_ps_destroy($id)
    {
        TabelK4DtpsKeahlianPS::destroy($id);
        return redirect()->route('dtps_ps.index')->with('success', 'Data K4 DTPS Sesuai Keahlian PS Deleted successfully');
    }

    //Tabel 4.1.2.3 DTPS yang Bidang Keahliannya di Luar Bidang PS
    public function dtps_luar_ps_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4DtpsKeahlianPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
            ->where('sesuai_ps','=','tidak')
            ->orderBy('nama', 'asc')
            ->get();
        }else{
            $items = TabelK4DtpsKeahlianPS::where('prodi_id', auth()->user()->prodi_id)
            ->where('sesuai_ps','=','tidak')
            ->orderBy('nama', 'asc')
            ->get();
        }

        // $items = TabelK4DtpsLuarPS::where('sesuai_ps','=','tidak')->get();
        return view('kriteria.c4.dtps_luar_ps.index', ['items' => $items]);
    }
    public function dtps_luar_ps_create()
    {
        return view('kriteria.c4.dtps_luar_ps.form');
    }
    public function dtps_luar_ps_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nidn_nidk' => 'required',
            'tanggal_lahir' => 'required|date',
            'sertifikat_pendidik' => 'required',
            'jabatan_fungsional' => 'required',
            'gelar_akademik' => 'required',
            'pendidikan' => 'required',
            'bidang_keahlian' => 'required',
        ]);

        TabelK4DtpsLuarPS::create([
            'nama' => $request->nama,
            'nidn_nidk' => $request->nidn_nidk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'sertifikat_pendidik' => $request->sertifikat_pendidik,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gelar_akademik' => $request->gelar_akademik,
            'pendidikan' => $request->pendidikan,
            'bidang_keahlian' => $request->bidang_keahlian,
            'sesuai_ps' => 'tidak',
            'prodi_id' => auth()->user()->prodi_id,
        ]);

        return redirect()->route('dtps_luar_ps.index')->with('success', 'Data K4 DTPS diluar Keahlian PS CREATED successfully');
    }
    public function dtps_luar_ps_show(tabelC4 $tabelC4)
    {
        //
    }
    public function dtps_luar_ps_edit($id)
    {
        $item = TabelK4DtpsLuarPS::findOrFail($id);
        return view('kriteria.c4.dtps_luar_ps.form', ['item' => $item]);
    }
    public function dtps_luar_ps_update(Request $request, $id)
    {
        $idx =Crypt::decryptString($id);
        $data = TabelK4DtpsLuarPS::findOrFail($idx);
        $request->validate([
            'nama' => 'required',
            'nidn_nidk' => 'required',
            'tanggal_lahir' => 'required|date',
            'sertifikat_pendidik' => 'required',
            'jabatan_fungsional' => 'required',
            'gelar_akademik' => 'required',
            'pendidikan' => 'required',
            'bidang_keahlian' => 'required',
        ]);

        $data->update([
            'nama' => $request->nama,
            'nidn_nidk' => $request->nidn_nidk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'sertifikat_pendidik' => $request->sertifikat_pendidik,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gelar_akademik' => $request->gelar_akademik,
            'pendidikan' => $request->pendidikan,
            'bidang_keahlian' => $request->bidang_keahlian,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('dtps_luar_ps.index')->with('success', 'Data K4 DTPS Diluar Keahlian PS Updated successfully');
    }
    public function dtps_luar_ps_destroy($id)
    {
        TabelK4DtpsLuarPS::destroy($id);
        return redirect()->route('dtps_luar_ps.index')->with('success', 'Data K4 DTPS diluar Keahlian PS Deleted successfully');
    }

    // Tabel 4.1.2.4 Rasio DTPS terhadap Mahasiswa Reguler
    public function rasio_dtps_terhadap_mahasiswa_reguler_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $jumlah_dtps = TabelK4DtpsKeahlianPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
            ->where('sesuai_ps', 'ya')
            ->count();

            $Jumlah_mhs_reguler = TabelK3MahasiswaReguler::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
            ->take(5)
            ->orderBy('tahun_akademik', 'desc')
            ->sum('total');
        }else{
            $jumlah_dtps = TabelK4DtpsKeahlianPS::where('prodi_id', auth()->user()->prodi_id)
            ->where('sesuai_ps','=','ya')
            ->count();

            $Jumlah_mhs_reguler = TabelK3MahasiswaReguler::where('prodi_id', auth()->user()->prodi_id)
            ->take(5)
            ->orderBy('tahun_akademik', 'desc')
            ->sum('total');
        }

        return view('kriteria.c4.rasio_dtps_terhadap_mahasiswa_reguler.index', compact('jumlah_dtps', 'Jumlah_mhs_reguler'));
    }

    // Tabel 4.1.2.5 Beban Kerja Dosen DTPS
    public function beban_kerja_dosen_dtps_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4BebanKerjaDTPS::join('tabel_dosen','tabel_k4_beban_kerja_dtps.nidn_nidk','=','tabel_dosen.nidn_nidk')
                ->where('tabel_k4_beban_kerja_dtps.prodi_id', $this->akunController->get_session_prodi_by_fakultas())
                ->orderBy('tabel_dosen.nama', 'asc')
                ->select('tabel_k4_beban_kerja_dtps.*','tabel_dosen.nama')
                ->get();
        }else{
            $items = TabelK4BebanKerjaDTPS::join('tabel_dosen','tabel_k4_beban_kerja_dtps.nidn_nidk','=','tabel_dosen.nidn_nidk')
                ->where('tabel_k4_beban_kerja_dtps.prodi_id', auth()->user()->prodi_id)
                ->orderBy('tabel_dosen.nama', 'asc')
                ->select('tabel_k4_beban_kerja_dtps.*','tabel_dosen.nama')
                ->get();
        }
        return view('kriteria.c4.beban_kerja_dosen_dtps.index', ['items' => $items]);
    }
    public function beban_kerja_dosen_dtps_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c4.beban_kerja_dosen_dtps.form', compact('dosens'));
    }
    public function beban_kerja_dosen_dtps_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'sks_ps_sendiri' => 'required',
            'sks_ps_luar' => 'required',
            'sks_pt_luar' => 'required',
            'sks_penelitian' => 'required',
            'sks_p2m' => 'required',
            'sks_manajemen_sendiri' => 'required',
            'sks_manajemen_luar' => 'required',
            'tautan' => 'required',
        ]);

        TabelK4BebanKerjaDTPS::create([
            'nidn_nidk' => $request->nidn_nidk,
            'sks_ps_sendiri' => $request->sks_ps_sendiri ,
            'sks_ps_luar' => $request->sks_ps_luar,
            'sks_pt_luar' => $request->sks_pt_luar,
            'sks_penelitian' => $request->sks_penelitian,
            'sks_p2m' => $request->sks_p2m,
            'sks_manajemen_sendiri' => $request->sks_manajemen_sendiri,
            'sks_manajemen_luar' => $request->sks_manajemen_luar,
            'prodi_id' => auth()->user()->prodi_id,
            'tautan' => $request->tautan,
        ]);
        return redirect()->route('beban_kerja_dosen_dtps.index')->with('success', 'Data K4 Beban kerja PS added successfully');
    }
    public function beban_kerja_dosen_dtps_show(tabelC4 $tabelC4)
    {
        //
    }
    public function beban_kerja_dosen_dtps_edit($id)
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK4BebanKerjaDTPS::findOrFail($id);
        return view('kriteria.c4.beban_kerja_dosen_dtps.form', ['item' => $item, 'dosens' => $dosens]);
    }
    public function beban_kerja_dosen_dtps_update(Request $request, $id)
    {
        $idx =Crypt::decryptString($id);
        $data = TabelK4BebanKerjaDTPS::findOrFail($idx);

        $request->validate([
            'nidn_nidk' => 'required',
            'sks_ps_sendiri' => 'required',
            'sks_ps_luar' => 'required',
            'sks_pt_luar' => 'required',
            'sks_penelitian' => 'required',
            'sks_p2m' => 'required',
            'sks_manajemen_sendiri' => 'required',
            'sks_manajemen_luar' => 'required',
        ]);

        $data->update([
            'sks_ps_sendiri' => $request->sks_ps_sendiri,
            'sks_ps_luar' => $request->sks_ps_luar,
            'sks_pt_luar' => $request->sks_pt_luar,
            'sks_penelitian' => $request->sks_penelitian,
            'sks_p2m' => $request->sks_p2m,
            'sks_manajemen_sendiri' => $request->sks_manajemen_sendiri,
            'sks_manajemen_luar' => $request->sks_manajemen_luar,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('beban_kerja_dosen_dtps.index')->with('success', 'Data K4 Beban kerja PS UPDATED successfully');

    }
    public function beban_kerja_dosen_dtps_destroy($id)
    {
        TabelK4BebanKerjaDTPS::destroy($id);

        return redirect()->route('beban_kerja_dosen_dtps.index')->with('success', 'Data K4 Beban kerja PS DELETED successfully');
    }

    // Tabel 4.1.2.6 Kegiatan Mengajar Dosen Tetap - Semester Gasal & Semester Genap
    public function kegiatan_mengajar_dosen_tetap_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $matakuliah = TabelMatakuliah::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
            $items = TabelK4KegiatanMengajar::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();

        }else{
            $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();
            $items = TabelK4KegiatanMengajar::where('prodi_id', auth()->user()->prodi_id)->get();
        }

        return view('kriteria.c4.kegiatan_mengajar_dosen_tetap.index', ['items' => $items, 'matakuliah' => $matakuliah]);
    }
    public function kegiatan_mengajar_dosen_tetap_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c4.kegiatan_mengajar_dosen_tetap.form', ['dosens'=>$dosens, 'matakuliah'=>$matakuliah]);
    }
    public function kegiatan_mengajar_dosen_tetap_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_kelas' => 'required',
            'kode_mk' => 'required',
            'jum_pertemuan_rencana' => 'required',
            'jum_pertemuan_terlaksana' => 'required',
            'semester' => 'required',
            'tautan' => 'required',
        ]);

        TabelK4KegiatanMengajar::create([
            'nidn_nidk' => $request->nidn_nidk,
            'jumlah_kelas' => $request->jumlah_kelas,
            'kode_mk' => $request->kode_mk,
            'jum_pertemuan_rencana' => $request->jum_pertemuan_rencana,
            'jum_pertemuan_terlaksana' => $request->jum_pertemuan_terlaksana,
            'semester' => $request->semester,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);

        return redirect()->route('kegiatan_mengajar_dosen_tetap.index')->with('success', 'Data K4 Kegiatan Mengajar Dosen Tetap added successfully');
    }
    public function kegiatan_mengajar_dosen_tetap_show(tabelC4 $tabelC4)
    {
        //
    }
    public function kegiatan_mengajar_dosen_tetap_edit($id)
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK4KegiatanMengajar::findOrFail($id);
        return view('kriteria.c4.kegiatan_mengajar_dosen_tetap.form', ['dosens' => $dosens, 'item' => $item]);
    }
    public function kegiatan_mengajar_dosen_tetap_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4KegiatanMengajar::findOrFail($idx);

        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_kelas' => 'required',
            'kode_mk' => 'required',
            'jum_pertemuan_rencana' => 'required',
            'jum_pertemuan_terlaksana' => 'required',
            'semester' => 'required',
        ]);

        $data->update([
            'nidn_nidk' => $request->nidn_nidk,
            'jumlah_kelas' => $request->jumlah_kelas,
            'kode_mk' => $request->kode_mk,
            'jum_pertemuan_rencana' => $request->jum_pertemuan_rencana,
            'jum_pertemuan_terlaksana' => $request->jum_pertemuan_terlaksana,
            'semester' => $request->semester,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('kegiatan_mengajar_dosen_tetap.index')->with('success', 'Data K4 Kegiatan Mengajar Dosen Tetap updated successfully');
    }
    public function kegiatan_mengajar_dosen_tetap_destroy($id)
    {
        TabelK4KegiatanMengajar::destroy($id);
        return redirect()->route('kegiatan_mengajar_dosen_tetap.index')->with('success', 'Data K4 Kegiatan Mengajar Dosen Tetap deleted successfully');
    }

    // Tabel 4.1.2.7 Jumlah Bimbingan Tugas Akhir atau Skripsi, Tesis, dan Disertasi
    public function jumlah_bimbingan_ta_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4BimbinganTA::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
            $items = TabelK4BimbinganTA::where('prodi_id', auth()->user()->prodi_id)->get();
        }
        return view('kriteria.c4.jumlah_bimbingan_ta.index', ['items' => $items]);
    }
    public function jumlah_bimbingan_ta_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c4.jumlah_bimbingan_ta.form', ['dosens' => $dosens]);

    }
    public function jumlah_bimbingan_ta_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'ts_2' => 'required',
            'ts_1' => 'required',
            'ts' => 'required',
            'tautan' => 'required',
        ]);
        TabelK4BimbinganTA::create([
            'nidn_nidk' => $request->nidn_nidk,
            'ts_2' => $request->ts_2,
            'ts_1' => $request->ts_1,
            'ts' => $request->ts,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);

        return redirect()->route('jumlah_bimbingan_ta.index')->with('success', 'Data K4 Jumlah Bimbingan Dosen ADDED successfully');
    }
    public function jumlah_bimbingan_ta_show(tabelC4 $tabelC4)
    {
        //
    }
    public function jumlah_bimbingan_ta_edit($id)
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK4BimbinganTA::findOrFail($id);
        return view('kriteria.c4.jumlah_bimbingan_ta.form', ['dosens' => $dosens, 'item' => $item]);

    }
    public function jumlah_bimbingan_ta_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4BimbinganTA::findOrFail($idx);

        $request->validate([
            'nidn_nidk' => 'required',
            'ts_2' => 'required',
            'ts_1' => 'required',
            'ts' => 'required',
            'tautan' => 'required',
        ]);

        $data->update([
            'ts_2' => $request->ts_2,
            'ts_1' => $request->ts_1,
            'ts' => $request->ts,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('jumlah_bimbingan_ta.index')->with('success', 'Data K4 Jumlah Bimbingan Dosen UPDATED successfully');
    }
    public function jumlah_bimbingan_ta_destroy($id)
    {
        TabelK4BimbinganTA::destroy($id);
        return redirect()->route('jumlah_bimbingan_ta.index')->with('success', 'Data K4 Jumlah Bimbingan Dosen DELETED successfully');
    }

    // Tabel 4.1.2.8 Prestasi DTPS
    public function prestasi_dtps_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4PrestasiDTPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();

        }else{
            $items = TabelK4PrestasiDTPS::where('prodi_id', auth()->user()->prodi_id)->get();
        }

        return view('kriteria.c4.prestasi_dtps.index', ['items' => $items]);
    }
    public function prestasi_dtps_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c4.prestasi_dtps.form', ['dosens' => $dosens ]);
    }
    public function prestasi_dtps_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'prestasi' => 'required',
            'tahun' => 'required',
            'tingkat' => 'required',
            'tautan' => 'required',
        ]);

        TabelK4PrestasiDTPS::create([
            'nidn_nidk' => $request->nidn_nidk,
            'prestasi' => $request->prestasi,
            'tahun' => $request->tahun,
            'tingkat' => $request->tingkat,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);

        return redirect()->route('prestasi_dtps.index')->with('success', 'Data K4 Prestasi Dosen DTPS ADDED successfully');
    }
    public function prestasi_dtps_show(tabelC4 $tabelC4)
    {
        //
    }
    public function prestasi_dtps_edit($id)
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK4PrestasiDTPS::findOrFail($id);
        return view('kriteria.c4.prestasi_dtps.form', ['dosens' => $dosens, 'item'=>$item]);
    }
    public function prestasi_dtps_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4PrestasiDTPS::findOrFail($idx);

        $request->validate([
            'nidn_nidk' => 'required',
            'prestasi' => 'required',
            'tahun' => 'required',
            'tingkat' => 'required',
            'tautan' => 'required',
        ]);

        $data->update([
            'prestasi' => $request->prestasi,
            'tahun' => $request->tahun,
            'tingkat' => $request->tingkat,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('prestasi_dtps.index')->with('success', 'Data K4 Prestasi Dosen DTPS UPDATED successfully');
    }
    public function prestasi_dtps_destroy($id)
    {
        TabelK4PrestasiDTPS::destroy($id);

        return redirect()->route('prestasi_dtps.index')->with('success', 'Data K4 Prestasi Dosen DTPS DELETED successfully');
    }

    // Tabel 4.1.2.9 Pengembangan Kompetensi DTPS
    public function pengembangan_kompetensi_dtps_index()
    {
        $tahun_sekarang = date('Y');
        $tahun_ts = date('Y') - 1;
        $tahun_ts1 = date('Y') - 2;
        $tahun_ts2 = date('Y') - 3;

        if(Auth::user()->role == 'fakultas'){
            $items_ts = TabelK4PengembanganKompetensiDTPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
                ->whereYear('waktu','>=',$tahun_ts)
                ->get();
            $items_ts1 = TabelK4PengembanganKompetensiDTPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
                ->whereYear('waktu',$tahun_ts1)
                ->get();
            $items_ts2 = TabelK4PengembanganKompetensiDTPS::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
                ->whereYear('waktu',$tahun_ts2)
                ->get();
        }else{
            $items_ts = TabelK4PengembanganKompetensiDTPS::where('prodi_id', auth()->user()->prodi_id)->whereYear('waktu','>=',$tahun_ts)->get();
            $items_ts1 = TabelK4PengembanganKompetensiDTPS::where('prodi_id', auth()->user()->prodi_id)->whereYear('waktu',$tahun_ts1)->get();
            $items_ts2 = TabelK4PengembanganKompetensiDTPS::where('prodi_id', auth()->user()->prodi_id)->whereYear('waktu',$tahun_ts2)->get();
        }

        return view('kriteria.c4.pengembangan_kompetensi_dtps.index', compact('items_ts2','items_ts1','items_ts'));
    }
    public function pengembangan_kompetensi_dtps_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c4.pengembangan_kompetensi_dtps.form', ['dosens' => $dosens]);
    }
    public function pengembangan_kompetensi_dtps_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'bidang_keahlian' => 'required',
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'manfaat' => 'required',
            'tautan' =>'required',
        ]);

        TabelK4PengembanganKompetensiDTPS::create([
            'nidn_nidk' => $request->nidn_nidk,
            'bidang_keahlian' =>  $request->bidang_keahlian,
            'nama_kegiatan' =>  $request->nama_kegiatan,
            'tempat' =>  $request->tempat,
            'waktu' =>  $request->waktu,
            'manfaat' =>  $request->manfaat,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);
        return redirect()->route('pengembangan_kompetensi_dtps.index')->with('success', 'Data K4 Pengembangan Kompetensi Dosen DTPS ADDED successfully');
    }
    public function pengembangan_kompetensi_dtps_show(tabelC4 $tabelC4)
    {
        //
    }
    public function pengembangan_kompetensi_dtps_edit($id)
    {
        $item = TabelK4PengembanganKompetensiDTPS::findOrFail($id);
        return view('kriteria.c4.pengembangan_kompetensi_dtps.form', ['item' => $item]);
    }
    public function pengembangan_kompetensi_dtps_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4PengembanganKompetensiDTPS::findOrFail($idx);

        $request->validate([
            'nidn_nidk' => 'required',
            'bidang_keahlian' => 'required',
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'manfaat' => 'required',
            'tautan' =>'required',
        ]);

        $data->update([
            'bidang_keahlian' =>  $request->bidang_keahlian,
            'nama_kegiatan' =>  $request->nama_kegiatan,
            'tempat' =>  $request->tempat,
            'waktu' =>  $request->waktu,
            'manfaat' =>  $request->manfaat,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('pengembangan_kompetensi_dtps.index')->with('success', 'Data K4 Pengembangan Kompetensi Dosen DTPS UPDATED successfully');
    }

    public function pengembangan_kompetensi_dtps_destroy($id)
    {
        TabelK4PengembanganKompetensiDTPS::destroy($id);
        return redirect()->route('pengembangan_kompetensi_dtps.index')->with('success', 'Data K4 Pengembangan Kompetensi Dosen DTPS DELETED successfully');
    }

    // Tabel 4.2.2.2 Profil Tendik
    public function profil_tendik_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = TabelK4Tendik::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();

        }else{
            $items = TabelK4Tendik::where('prodi_id', auth()->user()->prodi_id)->get();
        }

        return view('kriteria.c4.profil_tendik.index', ['items'=>$items]);
    }
    public function profil_tendik_create()
    {
        //
        return view('kriteria.c4.profil_tendik.form');

    }
    public function profil_tendik_store(Request $request)
    {
        $request->validate([
            'id_tendik' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'bidang_keahlian' => 'required',
            'pendidikan' => 'required',
            'unit_kerja' => 'required',
            'tautan' => 'required',
        ]);

        TabelK4Tendik::create([
            'id_tendik' => $request->id_tendik,
            'nama' => $request->nama,
            'status' => $request->status,
            'bidang_keahlian' => $request->bidang_keahlian,
            'pendidikan' => $request->pendidikan,
            'unit_kerja' => $request->unit_kerja,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);
        return redirect()->route('profil_tendik.index')->with('success', 'Data K4 Data Tendik ADDED successfully');
    }
    public function profil_tendik_show(tabelC4 $tabelC4)
    {
        //
    }
    public function profil_tendik_edit($id)
    {
        $item = TabelK4Tendik::findOrFail($id);
        return view('kriteria.c4.profil_tendik.form', ['item'=>$item]);
    }
    public function profil_tendik_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4Tendik::findOrFail($idx);
        $request->validate([
            'id_tendik' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'bidang_keahlian' => 'required',
            'pendidikan' => 'required',
            'unit_kerja' => 'required',
            'tautan' => 'required',
        ]);

        $data->update([
            'nama' => $request->nama,
            'status' => $request->status,
            'bidang_keahlian' => $request->bidang_keahlian,
            'pendidikan' => $request->pendidikan,
            'unit_kerja' => $request->unit_kerja,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('profil_tendik.index')->with('success', 'Data K4 Data Tendik UPDATED successfully');

    }
    public function profil_tendik_destroy($id)
    {
        TabelK4Tendik::destroy($id);
        return redirect()->route('profil_tendik.index')->with('success', 'Data K4 Data Tendik DELETED successfully');
    }

    // Tabel 4.2.2.3 Pengembangan Kompetensi dan Karier Tendik
    public function kompetensi_tendik_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $items = DB::table('tabel_k4_kompetensi_tendik')
            ->join('tabel_tendik', 'tabel_k4_kompetensi_tendik.id_tendik', '=', 'tabel_tendik.id_tendik')
            ->select('tabel_k4_kompetensi_tendik.*', 'tabel_tendik.nama')
            ->where('tabel_k4_kompetensi_tendik.prodi_id', $this->akunController->get_session_prodi_by_fakultas())
            ->get();

            // $items = TabelK4Tendik::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();

        }else{
            $items = DB::table('tabel_k4_kompetensi_tendik')
            ->join('tabel_tendik', 'tabel_k4_kompetensi_tendik.id_tendik', '=', 'tabel_tendik.id_tendik')
            ->select('tabel_k4_kompetensi_tendik.*', 'tabel_tendik.nama')
            ->where('tabel_k4_kompetensi_tendik.prodi_id', auth()->user()->prodi_id)
            ->get();

            // $items = TabelK4Tendik::where('prodi_id', auth()->user()->prodi_id)->get();
        }


        return view('kriteria.c4.kompetensi_tendik.index', ['items' => $items]);
    }
    public function kompetensi_tendik_create()
    {
        $tendiks = TabelK4Tendik::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c4.kompetensi_tendik.form', ['tendiks'=>$tendiks]);

    }
    public function kompetensi_tendik_store(Request $request)
    {
        $request->validate([
            'id_tendik' => 'required',
            'nama_kegiatan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tempat' => 'required',
            'tautan' => 'required',
        ]);

        TabelK4KompetensiTendik::create([
            'id_tendik' => $request->id_tendik,
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tempat' => $request->tempat,
            'tautan' => $request->tautan,
            'prodi_id' => auth()->user()->prodi_id,
        ]);
        return redirect()->route('kompetensi_tendik.index')->with('success', 'Data K4 Pengembangan Kompetensi dan Karir Tendik ADDED successfully');
    }
    public function kompetensi_tendik_show(tabelC4 $tabelC4)
    {
        //
    }
    public function kompetensi_tendik_edit($id)
    {
        // $item = DB::table('tabel_k4_kompetensi_tendik')
        //     ->join('tabel_tendik', 'tabel_k4_kompetensi_tendik.id_tendik', '=', 'tabel_tendik.id_tendik')
        //     ->select('tabel_k4_kompetensi_tendik.*', 'tabel_tendik.nama')
        //     ->where('tabel_k4_kompetensi_tendik.id', $id)
        //     ->get();
        $item = TabelK4KompetensiTendik::findOrFail($id);

        $tendiks = TabelK4Tendik::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c4.kompetensi_tendik.form', ['item' => $item, 'tendiks' => $tendiks]);

    }
    public function kompetensi_tendik_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK4KompetensiTendik::findOrFail($idx);
        $request->validate([
            'id_tendik' => 'required',
            'nama_kegiatan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tempat' => 'required',
            'tautan' => 'required',
        ]);

        $data->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tempat' => $request->tempat,
            'tautan' => $request->tautan,
        ]);
        return redirect()->route('kompetensi_tendik.index')->with('success', 'Data K4 Pengembangan Kompetensi dan Karir Tendik UPDATED successfully');
    }
    public function kompetensi_tendik_destroy($id)
    {
        TabelK4KompetensiTendik::destroy($id);
        return redirect()->route('kompetensi_tendik.index')->with('success', 'Data K4 Pengembangan Kompetensi dan Karir Tendik DELETED successfully');
    }


}
