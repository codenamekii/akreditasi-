<?php

namespace App\Http\Controllers;

use App\Models\tabelC3;
use App\Models\TabelK3LayananPembinaanMahasiswa;
use App\Models\TabelK3MahasiswaDalamNegeri;
use App\Models\TabelK3MahasiswaLuarNegeri;
use App\Models\TabelK3MahasiswaReguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TabelC3Controller extends Controller
{
  protected $akunController;

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
    return view('kriteria.c3.index');
  }

  public function create()
  {
    //
  }
  public function store(Request $request)
  {
    //
  }
  public function show(tabelC3 $tabelC3)
  {
    //
  }
  public function edit(tabelC3 $tabelC3)
  {
    //
  }

  public function update(Request $request, tabelC3 $tabelC3)
  {
    //
  }
  public function destroy(tabelC3 $tabelC3)
  {
    //
  }

  // ===========================
  // Tabel Mahasiswa Reguler
  // ===========================
  public function mahasiswa_reguler_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK3MahasiswaReguler::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }else{
      $items = TabelK3MahasiswaReguler::where('prodi_id', auth()->user()->prodi_id)
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }

    $tot[0] = $items->sum('daya_tampung');
    $tot[1] = $items->sum('pendaftar');
    $tot[2] = $items->sum('lulus_seleksi');
    $tot[3] = $items->sum('jum_mahasiswa_baru');
    $tot[4] = $items->sum('total');
    return view('kriteria.c3.mahasiswa_reguler.index', ['items' => $items, 'total' => $tot]);
  }

  public function mahasiswa_reguler_create()
  {
    //
    return view('kriteria.c3.mahasiswa_reguler.form');
  }

  public function mahasiswa_reguler_store(Request $request)
  {
    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'daya_tampung' => 'required',
      'pendaftar' => 'required',
      'lulus_seleksi' => 'required',
      'jum_mahasiswa_baru' => 'required',
      'total' => 'required'
    ]);

    TabelK3MahasiswaReguler::create([
      'tahun_akademik' => $request->tahun_akademik,
      'daya_tampung' => $request->daya_tampung,
      'pendaftar' => $request->pendaftar,
      'lulus_seleksi' =>  $request->lulus_seleksi,
      'jum_mahasiswa_baru' => $request->jum_mahasiswa_baru,
      'total' => $request->total,
      'tautan' => $request->tautan,
      'prodi_id' => auth()->user()->prodi_id,
    ]);

    return redirect('/kriteria3/mahasiswa_reguler')->with('success', 'Data K3 Mahasiswa Reguler created successfully');
  }

  public function mahasiswa_reguler_show(tabelC3 $tabelC3)
  {
    //
  }

  public function mahasiswa_reguler_edit($id)
  {
    $item = TabelK3MahasiswaReguler::findOrFail($id);
    return view('kriteria.c3.mahasiswa_reguler.form', ['item' => $item]);
  }

  public function mahasiswa_reguler_update(Request $request, $id)
  {
    $idx =Crypt::decryptString($id);
    $data = TabelK3MahasiswaReguler::find($idx);

    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'daya_tampung' => 'required',
      'pendaftar' => 'required',
      'lulus_seleksi' => 'required',
      'jum_mahasiswa_baru' => 'required',
      'total' => 'required'
    ]);

    $data->update([
      'tahun_akademik' => $request->tahun_akademik,
      'daya_tampung' => $request->daya_tampung,
      'pendaftar' => $request->pendaftar,
      'lulus_seleksi' =>  $request->lulus_seleksi,
      'jum_mahasiswa_baru' => $request->jum_mahasiswa_baru,
      'total' => $request->total,
      'tautan' => $request->tautan
    ]);

    return redirect('/kriteria3/mahasiswa_reguler')->with('success', 'Data K3 Mahasiswa Reguler UPDATED successfully');
  }

  public function mahasiswa_reguler_destroy($id)
  {
    $prodiID = auth()->user()->prodi_id;
    if (isset($prodiID)){
      TabelK3MahasiswaReguler::destroy($id);
    }

    return redirect('/kriteria3/mahasiswa_reguler')->with('success', 'Data K3 Mahasiswa Reguler DELETED successfully');
  }

  // ===============================
  // Calon mahasiswa dalam negeri
  // ===============================
  public function mahasiswa_dalam_negeri_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK3MahasiswaDalamNegeri::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }else{
      $items = TabelK3MahasiswaDalamNegeri::where('prodi_id', auth()->user()->prodi_id)
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }

    $tot[0] = $items->sum('jumlah_provinsi');
    $tot[1] = $items->sum('laki_laki');
    $tot[2] = $items->sum('perempuan');
    $tot[3] = $items->sum('total_mahasiswa');
    return view('kriteria.c3.mhs_dalam_negeri.index', ['items' => $items, 'total' => $tot]);
  }

  public function mahasiswa_dalam_negeri_create()
  {
    //
    return view('kriteria.c3.mhs_dalam_negeri.form');
  }
  public function mahasiswa_dalam_negeri_store(Request $request)
  {    
    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'jumlah_provinsi' => 'required',
      'laki_laki' => 'required',
      'perempuan' => 'required',
      // 'total_mahasiswa' => 'required'
    ]);

    TabelK3MahasiswaDalamNegeri::create([
      'tahun_akademik' => $request->tahun_akademik,
      'jumlah_provinsi' => $request->jumlah_provinsi,
      'laki_laki' => $request->laki_laki,
      'perempuan' =>  $request->perempuan,
      // 'total_mahasiswa' => $request->total_mahasiswa,
      'tautan' => $request->tautan,
      'prodi_id' => auth()->user()->prodi_id,
    ]);

    return redirect('/kriteria3/mahasiswa_dalam_negeri')->with('success', 'Data K3 Mahasiswa Dalam Negeri CREATED successfully');
  }
  public function mahasiswa_dalam_negeri_show(tabelC3 $tabelC3)
  {
    //
  }
  public function mahasiswa_dalam_negeri_edit($id)
  {
    $item = TabelK3MahasiswaDalamNegeri::findOrFail($id);
    return view('kriteria.c3.mhs_dalam_negeri.form', ['item' => $item]);
  }

  public function mahasiswa_dalam_negeri_update(Request $request, $id)
  {    
    $idx =Crypt::decryptString($id);
    $data = TabelK3MahasiswaDalamNegeri::find($idx);

    $request->validate([
      'tahun_akademik' => 'required',
      'jumlah_provinsi' => 'required',
      'laki_laki' => 'required',
      'perempuan' => 'required',
    ]);

    $data->update([
      'tahun_akademik' => $request->tahun_akademik,
      'jumlah_provinsi' => $request->jumlah_provinsi,
      'laki_laki' => $request->laki_laki,
      'perempuan' =>  $request->perempuan,
      // 'total_mahasiswa' => $request->total_mahasiswa,
      'tautan' => $request->tautan
    ]);

    return redirect('/kriteria3/mahasiswa_dalam_negeri')->with('success', 'Data K3 Mahasiswa Dalam Negeri UPDATED successfully');
  }

  public function mahasiswa_dalam_negeri_destroy($id)
  {
    TabelK3MahasiswaDalamNegeri::destroy($id);
    return redirect('/kriteria3/mahasiswa_dalam_negeri')->with('success', 'Data K3 Mahasiswa Dalam Negeri DELETED successfully');
  }

  // ===============================
  // Calon mahasiswa luar negeri
  // ===============================
  public function mahasiswa_luar_negeri_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK3MahasiswaLuarNegeri::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }else{
      $items = TabelK3MahasiswaLuarNegeri::where('prodi_id', auth()->user()->prodi_id)
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }

    $tot[0] = $items->sum('jumlah_provinsi');
    $tot[1] = $items->sum('laki_laki');
    $tot[2] = $items->sum('perempuan');
    $tot[3] = $items->sum('total_mahasiswa');
    return view('kriteria.c3.mhs_luar_negeri.index', ['items' => $items, 'total' => $tot]);
  }

  public function mahasiswa_luar_negeri_create()
  {
    //
    return view('kriteria.c3.mhs_luar_negeri.form');
  }
  public function mahasiswa_luar_negeri_store(Request $request)
  {    
    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'jumlah_negara' => 'required',
      'laki_laki' => 'required',
      'perempuan' => 'required',
      'total_mahasiswa' => 'required'
    ]);

    TabelK3MahasiswaLuarNegeri::create([
      'tahun_akademik' => $request->tahun_akademik,
      'jumlah_negara' => $request->jumlah_negara,
      'laki_laki' => $request->laki_laki,
      'perempuan' =>  $request->perempuan,
      'total_mahasiswa' => $request->total_mahasiswa,
      'tautan' => $request->tautan,
      'prodi_id' => auth()->user()->prodi_id,
    ]);

    return redirect('/kriteria3/mahasiswa_luar_negeri')->with('success', 'Data K3 Mahasiswa Luar Negeri CREATED successfully');
  }
  public function mahasiswa_luar_negeri_show(tabelC3 $tabelC3)
  {
    //
  }
  public function mahasiswa_luar_negeri_edit($id)
  {
    $item = TabelK3MahasiswaLuarNegeri::findOrFail($id);
    return view('kriteria.c3.mhs_luar_negeri.form', ['item' => $item]);
  }

  public function mahasiswa_luar_negeri_update(Request $request, $id)
  {    
    $idx =Crypt::decryptString($id);
    $data = TabelK3MahasiswaLuarNegeri::find($idx);

    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'jumlah_negara' => 'required',
      'laki_laki' => 'required',
      'perempuan' => 'required',
      'total_mahasiswa' => 'required'
    ]);

    $data->update([
      'tahun_akademik' => $request->tahun_akademik,
      'jumlah_negara' => $request->jumlah_negara,
      'laki_laki' => $request->laki_laki,
      'perempuan' =>  $request->perempuan,
      'total_mahasiswa' => $request->total_mahasiswa,
      'tautan' => $request->tautan
    ]);

    return redirect('/kriteria3/mahasiswa_luar_negeri')->with('success', 'Data K3 Mahasiswa Luar Negeri UPDATED successfully');
  }

  public function mahasiswa_luar_negeri_destroy($id)
  {
    TabelK3MahasiswaLuarNegeri::destroy($id);
    return redirect('/kriteria3/mahasiswa_luar_negeri')->with('success', 'Data K3 Mahasiswa Luar Negeri DELETED successfully');
  }

  // ===============================
  // Program Layanan Dan Pembinaan Minat, Bakat, Penalaran, Kesejahteraan, Dan Keprofesian Mahasiswa
  // ===============================
  public function program_layanan_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK3LayananPembinaanMahasiswa::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }else{
      $items = TabelK3LayananPembinaanMahasiswa::where('prodi_id', auth()->user()->prodi_id)
      ->take(5)
      ->orderBy('tahun_akademik', 'desc')
      ->get();
    }

    $tot[0] = $items->sum('minat');
    $tot[1] = $items->sum('bakat');
    $tot[2] = $items->sum('penalaran');
    $tot[3] = $items->sum('kesejahteraan');
    $tot[4] = $items->sum('keprofesian');

    return view('kriteria.c3.program_layanan.index', ['items' => $items, 'total' => $tot]);
  }
  
  public function program_layanan_create()
  {
    //
    return view('kriteria.c3.program_layanan.form');
  }
  public function program_layanan_store(Request $request)
  {  
    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'minat' => 'required',
      'bakat' => 'required',
      'penalaran' => 'required',
      'kesejahteraan' => 'required',
      'keprofesian' => 'required'
    ]);

    TabelK3LayananPembinaanMahasiswa::create([
      'tahun_akademik' => $request->tahun_akademik,
      'minat' => $request->minat,
      'bakat' => $request->bakat,
      'penalaran' =>  $request->penalaran,
      'kesejahteraan' => $request->kesejahteraan,
      'keprofesian' => $request->keprofesian,
      'tautan' => $request->tautan,
      'prodi_id' => auth()->user()->prodi_id,
    ]);

    return redirect('/kriteria3/program_layanan')->with('success', 'Data K3 Program Layanan dan Pembinaan CREATED successfully');
  }
  public function program_layanan_show(tabelC3 $tabelC3)
  {
    //
  }
  public function program_layanan_edit($id)
  {
    $item = TabelK3LayananPembinaanMahasiswa::findOrFail($id);
    return view('kriteria.c3.program_layanan.form',['item' => $item]);
  }

  public function program_layanan_update(Request $request, $id)
  {
    $idx =Crypt::decryptString($id);
    $data = TabelK3LayananPembinaanMahasiswa::find($idx);

    $request->validate([
      'tahun_akademik' => 'required|numeric',
      'minat' => 'required',
      'bakat' => 'required',
      'penalaran' => 'required',
      'kesejahteraan' => 'required',
      'keprofesian' => 'required'
    ]);

    $data->update([
      'tahun_akademik' => $request->tahun_akademik,
      'minat' => $request->minat,
      'bakat' => $request->bakat,
      'penalaran' =>  $request->penalaran,
      'kesejahteraan' => $request->kesejahteraan,
      'keprofesian' => $request->keprofesian,
      'tautan' => $request->tautan
    ]);

    return redirect('/kriteria3/program_layanan')->with('success', 'Data K3 Program Layanan dan Pembinaan UPDATED successfully');
  }
  public function program_layanan_destroy($id)
  {
    TabelK3LayananPembinaanMahasiswa::destroy($id);
    return redirect('/kriteria3/program_layanan')->with('success', 'Data K3 Program Layanan dan Pembinaan DELETED successfully');
  }


}
