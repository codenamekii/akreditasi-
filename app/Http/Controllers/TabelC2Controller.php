<?php

namespace App\Http\Controllers;

use App\Models\tabelC2;
use App\Models\TabelK2BidangKelembagaan;
use App\Models\TabelK2BidangPendidikan;
use App\Models\TabelK2BidangPenelitian;
use App\Models\TabelK2BidangPkm;
use App\Models\TabelK9IpkLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TabelC2Controller extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  protected $akunController;

  public function __construct()
  {
      $this->akunController = new AkunController();
  }

  public function index()
  {
    return view('kriteria.c2.index');
  }

  // bidang pendidikan
  public function bidang_pendidikan_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK2BidangPendidikan::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
    }else{
      $items = TabelK2BidangPendidikan::where('prodi_id', auth()->user()->prodi_id)->get();
    }

    return view('kriteria.c2.bidang_pendidikan.index', compact('items'));
  }
  public function bidang_pendidikan_create($bidang)
  {
    return view('kriteria.c2.form', ['bidang' => $bidang]);
  }
  public function bidang_pendidikan_store(Request $request)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    $prodiID = auth()->user()->prodi_id;

    TabelK2BidangPendidikan::create([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan'),
      'prodi_id' => $prodiID,
    ]);

    return redirect('/kriteria2/bidang_pendidikan')->with('success', 'Data K2 Bidang Pendidikan created successfully');
  }
  public function bidang_pendidikan_edit(tabelC2 $tabelC2, $id, $bidang)
  {
    $item = TabelK2BidangPendidikan::find($id);
    return view('kriteria.c2.form', ['bidang' => $bidang, 'item' => $item]);
  }
  public function bidang_pendidikan_update(Request $request, $id, tabelC2 $tabelC2, $bidang)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangPendidikan::where('id', $id)->update([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan')
    ]);

    return redirect('/kriteria2/bidang_pendidikan')->with('success', 'Data K2 Bidang Pendidikan updated successfully');
  }

  public function bidang_pendidikan_destroy($id)
  {
    TabelK2BidangPendidikan::destroy($id);
    return redirect('/kriteria2/bidang_pendidikan')->with('success', 'Data K2 Bidang Pendidikan deleted successfully');
  }

  // bidang Penelitian
  public function bidang_penelitian_index()
  {
    
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK2BidangPenelitian::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
    }else{
        $items = TabelK2BidangPenelitian::where('prodi_id', Auth::user()->prodi->id)->get();
    }
    
    return view('kriteria.c2.bidang_penelitian.index', compact('items'));
  }

  public function bidang_penelitian_create($bidang)
  {
    $data['bidang'] = $bidang;
    return view('kriteria.c2.form', $data);
  }

  public function bidang_penelitian_store(Request $request)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangPenelitian::create([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan'),
      'prodi_id' => auth()->user()->prodi_id,
    ]);
    return redirect('/kriteria2/bidang_penelitian')->with('success', 'Data K2 Bidang Penelitian created successfully');
  }
  public function bidang_penelitian_edit(tabelC2 $tabelC2, $id, $bidang)
  {
    $item = TabelK2BidangPenelitian::find($id);
    return view('kriteria.c2.form', ['bidang' => $bidang, 'item' => $item]);
  }
  public function bidang_penelitian_update(Request $request, $id)
  {    
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangPenelitian::where('id', $id)->update([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan')
    ]);

    return redirect('/kriteria2/bidang_penelitian')->with('success', 'Data K2 Bidang Penelitian updated successfully');
  }

  public function bidang_penelitian_destroy($id)
  {
    TabelK2BidangPenelitian::destroy($id);
    return redirect('/kriteria2/bidang_penelitian')->with('success', 'Data K2 Bidang Penelitian deleted successfully');
  }

  // bidang Pengabdian Kepada Masyarakat (PKM)
  public function bidang_pkm_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $prodiID = $this->akunController->get_session_prodi_by_fakultas();
    }else{
      $prodiID = Auth::user()->prodi->id;
    }
    
    $items = TabelK2BidangPkm::where('prodi_id', $prodiID)->get();
    
    return view('kriteria.c2.bidang_Pkm.index', ['items' => $items]);
  }

  public function bidang_pkm_create($bidang)
  {
    $data['bidang'] = $bidang;
    return view('kriteria.c2.form', $data);
  }

  public function bidang_pkm_store(Request $request)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangPkm::create([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan'),
      'prodi_id' => auth()->user()->prodi_id,
    ]);
    return redirect('/kriteria2/bidang_pkm')->with('success', 'Data K2 Bidang PKM created successfully');
  }

  public function bidang_pkm_edit($id, $bidang)
  {
    $item = TabelK2BidangPkm::find($id);
    return view('kriteria.c2.form', ['bidang' => $bidang, 'item' => $item]);
  }

  public function bidang_pkm_update(Request $request, $id)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangPkm::where('id', $id)->update([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan')
    ]);

    return redirect('/kriteria2/bidang_pkm')->with('success', 'Data K2 Bidang PKM updated successfully');
  }

  public function bidang_pkm_destroy($id)
  {
    TabelK2BidangPkm::destroy($id);
    return redirect('/kriteria2/bidang_pkm')->with('success', 'Data K2 Bidang PKM deleted successfully');
  }

  // bidang Pengembangan Kelembagaan
  public function bidang_pengembangan_kelembagaan_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $prodiID = $this->akunController->get_session_prodi_by_fakultas();
    }else{
      $prodiID = auth()->user()->prodi_id;
    }

    $items = TabelK2BidangKelembagaan::where('prodi_id', $prodiID)->get();

    return view('kriteria.c2.bidang_pengembangan_kelembagaan.index', ['items' => $items]);
  }
  public function bidang_pengembangan_kelembagaan_create($bidang)
  {
    $data['bidang'] = $bidang;
    return view('kriteria.c2.form', $data);
  }

  public function bidang_pengembangan_kelembagaan_store(Request $request)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangKelembagaan::create([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan'),
      'prodi_id' => auth()->user()->prodi_id,
    ]);
    return redirect('/kriteria2/bidang_pengembangan_kelembagaan')->with('success', 'Data K2 Bidang Pengembangan Kelembagaan created successfully');
  }

  public function bidang_pengembangan_kelembagaan_edit($id, $bidang)
  {
    $item = TabelK2BidangKelembagaan::find($id);
    return view('kriteria.c2.form', ['bidang' => $bidang, 'item' => $item]);
  }

  public function bidang_pengembangan_kelembagaan_update(Request $request, $id)
  {
    $request->validate([
      'nama_mitra' => 'required',
      'tingkat' => 'required',
      'judul_ruang_lingkup' => 'required|min:6',
      'manfaat_output' => 'required',
      'durasi' => 'required'
    ]);

    TabelK2BidangKelembagaan::where('id', $id)->update([
      'nama_mitra' => $request->input('nama_mitra'),
      'tingkat' => $request->input('tingkat'),
      'judul_ruang_lingkup' => $request->input('judul_ruang_lingkup'),
      'manfaat_output' => $request->input('manfaat_output'),
      'durasi' => $request->input('durasi'),
      'tautan' => $request->input('tautan')
    ]);

    return redirect('/kriteria2/bidang_pengembangan_kelembagaan')->with('success', 'Data K2 Bidang Pengembangan Kelembagaan updated successfully');
  }

  public function bidang_pengembangan_kelembagaan_destroy($id)
  {
    TabelK2BidangKelembagaan::destroy($id);
    return redirect('/kriteria2/bidang_pengembangan_kelembagaan')->with('success', 'Data K2 Bidang Pengembangan Kelembagaan deleted successfully');
  }
}
