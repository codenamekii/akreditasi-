<?php

namespace App\Http\Controllers;

use App\Models\tabelC6;
use App\Models\TabelDosen;
use App\Models\TabelK6Bimbingan;
use App\Models\TabelK6BimbinganMagang;
use App\Models\TabelK6BimbinganTA;
use App\Models\TabelK6DosenTamuTenagaAhli;
use App\Models\TabelK6IntegrasiPenelitianPKMPembelajaran;
use App\Models\TabelK6KegiatanAkademik;
use App\Models\TabelK6KepuasanMahasiswa;
use App\Models\TabelMatakuliah;
use Database\Seeders\tabelDosenSeeder;
use Database\Seeders\TabelK6IntegrasiTridarmaSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class TabelC6Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->akunController = new AkunController();
    }

     public function index()
    {
        //
        return view('kriteria.c6.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelMatakuliah::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.mata_kuliah_cpl_dan_perangkat_pembelajaran.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_create()
    {
        //
        return view('kriteria.c6.mata_kuliah_cpl_dan_perangkat_pembelajaran.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama' => 'required',
            'sks' => 'required|numeric',
            'semester' => 'required',
            'jenis_matakuliah' => 'required',
            'unit_penyelenggara' => 'required',
            'kesesuaian_cpl' => 'required',
            'perangkat_pembelajaran' => 'required',
            'tautan' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;

        TabelMatakuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'jenis_matakuliah' => $request->jenis_matakuliah,
            'unit_penyelenggara' => $request->unit_penyelenggara,
            'kesesuaian_cpl' => $request->kesesuaian_cpl,
            'perangkat_pembelajaran' => $request->perangkat_pembelajaran,
            'prodi_id' => $prodiID,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('mata_kuliah_cpl_dan_perangkat_pembelajaran.index')->with('success', 'Data K6 Data Matakuliah ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_edit($id)
    {
        $item = TabelMatakuliah::findOrFail($id);
        return view('kriteria.c6.mata_kuliah_cpl_dan_perangkat_pembelajaran.form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'kode_mk' => 'required',
            'nama' => 'required',
            'sks' => 'required|numeric',
            'semester' => 'required',
            'jenis_matakuliah' => 'required',
            'unit_penyelenggara' => 'required',
            'kesesuaian_cpl' => 'required',
            'perangkat_pembelajaran' => 'required',
            'tautan' => 'required',
        ]);

        $data = TabelMatakuliah::findOrFail($idx);

        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            $data->update([
                'kode_mk' => $request->kode_mk,
                'nama' => $request->nama,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'jenis_matakuliah' => $request->jenis_matakuliah,
                'unit_penyelenggara' => $request->unit_penyelenggara,
                'kesesuaian_cpl' => $request->kesesuaian_cpl,
                'perangkat_pembelajaran' => $request->perangkat_pembelajaran,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('mata_kuliah_cpl_dan_perangkat_pembelajaran.index')->with('success', 'Data K6 Data Matakuliah UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mata_kuliah_cpl_dan_perangkat_pembelajaran_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            TabelMatakuliah::destroy($id);
        }
        return redirect()->route('mata_kuliah_cpl_dan_perangkat_pembelajaran.index')->with('success', 'Data K6 Data Matakuliah DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6IntegrasiPenelitianPKMPembelajaran::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran.form', compact('dosens','matakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'mk_id' => 'required',
            'nidn_nidk' => 'required',
            'bentuk_integrasi' => 'required',
            'tautan' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6IntegrasiPenelitianPKMPembelajaran::create([
                'judul' => $request->judul,
                'mk_id' => $request->mk_id,
                'nidn_nidk' => $request->nidn_nidk,
                'prodi_id' => $prodiID,
                'bentuk_integrasi' => $request->bentuk_integrasi,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('integrasi_pembelajaran.index')->with('success', 'Data K6 Integrasi Penelitian dan PKM dalam Pembelajaran ADDED successfully');
    }

    /**
     * Show the specified resource.
     *

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_edit($id)
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK6IntegrasiPenelitianPKMPembelajaran::findOrFail($id);
        return view('kriteria.c6.integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran.form', compact('item','dosens','matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);
        $data = TabelK6IntegrasiPenelitianPKMPembelajaran::findOrFail($idx);

        $request->validate([
            'judul' => 'required',
            'mk_id' => 'required',
            'nidn_nidk' => 'required',
            'bentuk_integrasi' => 'required',
            'tautan' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            $data->update([
                'judul' => $request->judul,
                'mk_id' => $request->mk_id,
                'nidn_nidk' => $request->nidn_nidk,
                'prodi_id' => $prodiID,
                'bentuk_integrasi' => $request->bentuk_integrasi,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('integrasi_pembelajaran.index')->with('success', 'Data K6 Integrasi Penelitian dan PKM dalam Pembelajaran UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran_destroy($id)
    {
        $data = TabelK6IntegrasiPenelitianPKMPembelajaran::findOrFail($id);
        $data->delete();
        return redirect()->route('integrasi_pembelajaran.index')->with('success', 'Data K6 Integrasi Penelitian dan PKM dalam Pembelajaran DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6Bimbingan::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.form', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_bimbingan' => 'required|numeric',
            'rata_pertemuan_semester' => 'required|numeric',
            'tautan' => 'required',
        ],[
            'nidn_nidk' => 'Dosen harus diisi',
        ]);

        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6Bimbingan::create([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_bimbingan' => $request->jumlah_bimbingan,
                'rata_pertemuan_semester' => $request->rata_pertemuan_semester,
                'prodi_id' => $prodiID,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan dan Frekuensi Pertemuan ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_edit($id)
    {
        $item = TabelK6Bimbingan::findOrFail($id);
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.form', compact('item', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_bimbingan' => 'required|numeric',
            'rata_pertemuan_semester' => 'required|numeric',
            'tautan' => 'required',
        ],[
            'nidn_nidk' => 'Dosen harus diisi',
        ]);

        $prodiID = auth()->user()->prodi_id;

        $data = TabelK6Bimbingan::findOrFail($idx);

        if (isset($prodiID) && isset($data)){
            $data->update([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_bimbingan' => $request->jumlah_bimbingan,
                'rata_pertemuan_semester' => $request->rata_pertemuan_semester,
                'prodi_id' => $prodiID,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan dan Frekuensi Pertemuan UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6Bimbingan::findOrFail($id);

        if (isset($prodiID, $data)){
            $data->delete();
        }
        return redirect()->route('jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan dan Frekuensi Pertemuan DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6BimbinganMagang::where('prodi_id', $prodiID)->get();
        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.form', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_bimbingan' => 'required|numeric',
            'rata_pertemuan_semester' => 'required|numeric',
            'tautan' => 'required',
        ],[
            'nidn_nidk' => 'Dosen harus diisi',
        ]);

        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6BimbinganMagang::create([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_bimbingan' => $request->jumlah_bimbingan,
                'rata_pertemuan_semester' => $request->rata_pertemuan_semester,
                'prodi_id' => $prodiID,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan Magang dan Frekuensi Pertemuan ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_edit($id)
    {
        $item = TabelK6BimbinganMagang::findOrFail($id);
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.form', compact('item','dosens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_bimbingan' => 'required|numeric',
            'rata_pertemuan_semester' => 'required|numeric',
            'tautan' => 'required',
        ],[
            'nidn_nidk' => 'Dosen harus diisi',
        ]);

        $prodiID = auth()->user()->prodi_id;

        $data = TabelK6BimbinganMagang::findOrFail($idx);

        if (isset($prodiID) && isset($data)){
            $data->update([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_bimbingan' => $request->jumlah_bimbingan,
                'rata_pertemuan_semester' => $request->rata_pertemuan_semester,
                'prodi_id' => $prodiID,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan Magang dan Frekuensi Pertemuan UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6BimbinganMagang::findOrFail($id);

        if (isset($prodiID, $data)){
            $data->delete();
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index')->with('success', 'Data K6 Jumlah Bimbingan Magang dan Frekuensi Pertemuan DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6BimbinganTA::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_ta.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_ta.form', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_store(Request $request)
    {
        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_ps_sendiri_ts2' => 'required',
            'jumlah_ps_sendiri_ts1' => 'required',
            'jumlah_ps_sendiri_ts' => 'required',
            'jumlah_ps_lain_ts2' => 'required',
            'jumlah_ps_lain_ts1' => 'required',
            'jumlah_ps_lain_ts' => 'required',
            'rata_pertemuan' => 'required',
            'tautan' => 'required',
        ],['nidn_nidk' => 'harus memilih Dosen']);

        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            TabelK6BimbinganTA::create([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_ps_sendiri_ts2' => $request->jumlah_ps_sendiri_ts2,
                'jumlah_ps_sendiri_ts1' => $request->jumlah_ps_sendiri_ts1,
                'jumlah_ps_sendiri_ts' => $request->jumlah_ps_sendiri_ts,
                'jumlah_ps_lain_ts2' => $request->jumlah_ps_lain_ts2,
                'jumlah_ps_lain_ts1' => $request->jumlah_ps_lain_ts1,
                'jumlah_ps_lain_ts' => $request->jumlah_ps_lain_ts,
                'rata_pertemuan' => $request->rata_pertemuan,
                'tautan' => $request->tautan,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_ta.index')->with('success', 'Data K6 Jumlah Bimbingan TA ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_edit($id)
    {
        $item = TabelK6BimbinganTA::findOrFail($id);
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.jumlah_mahasiswa_bimbingan_ta.form', compact('item','dosens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'nidn_nidk' => 'required',
            'jumlah_ps_sendiri_ts2' => 'required',
            'jumlah_ps_sendiri_ts1' => 'required',
            'jumlah_ps_sendiri_ts' => 'required',
            'jumlah_ps_lain_ts2' => 'required',
            'jumlah_ps_lain_ts1' => 'required',
            'jumlah_ps_lain_ts' => 'required',
            'rata_pertemuan' => 'required',
            'tautan' => 'required',
        ],['nidn_nidk' => 'harus memilih Dosen']);

        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6BimbinganTA::findOrFail($idx);

        if (isset($prodiID, $data)){
            $data->update([
                'nidn_nidk' => $request->nidn_nidk,
                'jumlah_ps_sendiri_ts2' => $request->jumlah_ps_sendiri_ts2,
                'jumlah_ps_sendiri_ts1' => $request->jumlah_ps_sendiri_ts1,
                'jumlah_ps_sendiri_ts' => $request->jumlah_ps_sendiri_ts,
                'jumlah_ps_lain_ts2' => $request->jumlah_ps_lain_ts2,
                'jumlah_ps_lain_ts1' => $request->jumlah_ps_lain_ts1,
                'jumlah_ps_lain_ts' => $request->jumlah_ps_lain_ts,
                'rata_pertemuan' => $request->rata_pertemuan,
                'tautan' => $request->tautan,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_ta.index')->with('success', 'Data K6 Jumlah Bimbingan TA UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlah_mahasiswa_bimbingan_ta_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            $data = TabelK6BimbinganTA::findOrFail($id);
            $data->delete();
        }

        return redirect()->route('jumlah_mahasiswa_bimbingan_ta.index')->with('success', 'Data K6 Jumlah Bimbingan TA DELETED successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6KegiatanAkademik::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.kegiatan_akademik_di_luar_perkuliahan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_create()
    {
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.kegiatan_akademik_di_luar_perkuliahan.form', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'nidn_nidk' => 'required',
            'frekuensi' => 'required',
            'hasil' => 'required',
            'tautan' => 'required',
        ], ['nidn_nidk' => 'dosen harus dipilih' ]);

        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            TabelK6KegiatanAkademik::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'nidn_nidk' => $request->nidn_nidk,
                'frekuensi' => $request->frekuensi,
                'hasil' => $request->hasil,
                'tautan' => $request->tautan,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('kegiatan_akademik_di_luar_perkuliahan.index')->with('success', 'Data K6 Kegiatan Akademik ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_edit($id)
    {
        $item = TabelK6KegiatanAkademik::findOrFail($id);
        $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kriteria.c6.kegiatan_akademik_di_luar_perkuliahan.form', compact('item','dosens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'nama_kegiatan' => 'required',
            'nidn_nidk' => 'required',
            'frekuensi' => 'required',
            'hasil' => 'required',
            'tautan' => 'required',
        ], ['nidn_nidk' => 'dosen harus dipilih' ]);

        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6KegiatanAkademik::findOrFail($idx);

        if (isset($prodiID, $data)){
            $data->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'nidn_nidk' => $request->nidn_nidk,
                'frekuensi' => $request->frekuensi,
                'hasil' => $request->hasil,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('kegiatan_akademik_di_luar_perkuliahan.index')->with('success', 'Data K6 Kegiatan Akademik UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kegiatan_akademik_di_luar_perkuliahan_destroy($id)
    {
        $data = TabelK6KegiatanAkademik::findOrFail($id);
        $prodiID = auth()->user()->prodi_id;
        if (isset($data, $prodiID)){
            $data->delete();
        }

        return redirect()->route('kegiatan_akademik_di_luar_perkuliahan.index')->with('success', 'Data K6 Kegiatan Akademik DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6DosenTamuTenagaAhli::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.dosen_tamu_dan_tenaga_ahli.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_create()
    {
        $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();

        return view('kriteria.c6.dosen_tamu_dan_tenaga_ahli.form', compact('matakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_lembaga' => 'required',
            'kepakaran' => 'required',
            'waktu_kegiatan' => 'required',
            'tautan'  => 'required',
            'mk_id' => 'required',
        ]);
        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6DosenTamuTenagaAhli::create([
                'nama' => $request->nama,
                'nama_lembaga' => $request->nama_lembaga,
                'kepakaran' => $request->kepakaran,
                'waktu_kegiatan' => $request->waktu_kegiatan,
                'tautan'  => $request->tautan,
                'mk_id' => $request->mk_id,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('dosen_tamu_dan_tenaga_ahli.index')->with('success', 'Data K6 Dosen Tamu dan Tenaga Ahli ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_edit($id)
    {

        $matakuliah = TabelMatakuliah::where('prodi_id', auth()->user()->prodi_id)->get();
        $item = TabelK6DosenTamuTenagaAhli::findOrFail($id);

        return view('kriteria.c6.dosen_tamu_dan_tenaga_ahli.form', compact('matakuliah','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'nama' => 'required',
            'nama_lembaga' => 'required',
            'kepakaran' => 'required',
            'waktu_kegiatan' => 'required',
            'tautan'  => 'required',
            'mk_id' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6DosenTamuTenagaAhli::findOrFail($idx);

        if (isset($prodiID, $data)){
            $data->update([
                'nama' => $request->nama,
                'nama_lembaga' => $request->nama_lembaga,
                'kepakaran' => $request->kepakaran,
                'waktu_kegiatan' => $request->waktu_kegiatan,
                'tautan'  => $request->tautan,
                'mk_id' => $request->mk_id,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('dosen_tamu_dan_tenaga_ahli.index')->with('success', 'Data K6 Dosen Tamu dan Tenaga Ahli UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dosen_tamu_dan_tenaga_ahli_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6DosenTamuTenagaAhli::destroy($id);
        }

        return redirect()->route('dosen_tamu_dan_tenaga_ahli.index')->with('success', 'Data K6 Dosen Tamu dan Tenaga Ahli DELETED successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $prodiID = $this->akunController->get_session_prodi_by_fakultas();
        }else{
            $prodiID = auth()->user()->prodi_id;
        }

        $items = TabelK6KepuasanMahasiswa::where('prodi_id', $prodiID)->get();

        return view('kriteria.c6.kepuasan_mahasiswa.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_create()
    {
        //
        return view('kriteria.c6.kepuasan_mahasiswa.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_store(Request $request)
    {
        $request->validate([
            'aspek' => 'required',
            'kinerja_mengajar' => 'required|numeric',
            'layanan_administrasi_ps'  => 'required|numeric',
            'sarana_prasarana_ps' => 'required|numeric',
            'tindak_lanjut' => 'required',
            'tautan' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;

        if (isset($prodiID)){
            TabelK6KepuasanMahasiswa::create([
                'aspek' => $request->aspek,
                'kinerja_mengajar' => $request->kinerja_mengajar,
                'layanan_administrasi_ps'  => $request->layanan_administrasi_ps,
                'sarana_prasarana_ps' => $request->sarana_prasarana_ps,
                'tindak_lanjut' => $request->tindak_lanjut,
                'tautan' => $request->tautan,
                'prodi_id' => $prodiID,
            ]);
        }

        return redirect()->route('kepuasan_mahasiswa.index')->with('success', 'Data K6 Kepuasan Mahasiswa ADDED successfully');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_edit($id)
    {
        $item = TabelK6KepuasanMahasiswa::findOrFail($id);
        return view('kriteria.c6.kepuasan_mahasiswa.form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_update(Request $request, $id)
    {
        $idx = Crypt::decryptString($id);

        $request->validate([
            'aspek' => 'required',
            'kinerja_mengajar' => 'required|numeric',
            'layanan_administrasi_ps'  => 'required|numeric',
            'sarana_prasarana_ps' => 'required|numeric',
            'tindak_lanjut' => 'required',
            'tautan' => 'required',
        ]);

        $prodiID = auth()->user()->prodi_id;
        $data = TabelK6KepuasanMahasiswa::findOrFail($idx);

        if (isset($prodiID, $data)){
            $data->update([
                'aspek' => $request->aspek,
                'kinerja_mengajar' => $request->kinerja_mengajar,
                'layanan_administrasi_ps'  => $request->layanan_administrasi_ps,
                'sarana_prasarana_ps' => $request->sarana_prasarana_ps,
                'tindak_lanjut' => $request->tindak_lanjut,
                'tautan' => $request->tautan,
            ]);
        }

        return redirect()->route('kepuasan_mahasiswa.index')->with('success', 'Data K6 Kepuasan Mahasiswa UPDATED successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kepuasan_mahasiswa_destroy($id)
    {
        $prodiID = auth()->user()->prodi_id;
        if (isset($prodiID)){
            TabelK6KepuasanMahasiswa::destroy($id);
        }
        return redirect()->route('kepuasan_mahasiswa.index')->with('success', 'Data K6 Kepuasan Mahasiswa DELETED successfully');
    }



}
