<?php

namespace App\Http\Controllers;

use App\Models\tabelC5;
use App\Models\TabelDosen;
use App\Models\TabelK5DanaPenelitian;
use App\Models\TabelK5DanaPKM;
use App\Models\TabelK5PemerolehanDana;
use App\Models\TabelK5PenggunaanDana;
use App\Models\TabelK5PrasaranPendidikan;
use App\Models\TabelK5SaranaPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class TabelC5Controller extends Controller
{
  public function __construct()
  {
      $this->akunController = new AkunController();
  }

  public function index()
  {
    //
    return view('kriteria.c5.index');
  }

  // // Kriteria 5 > Tabel Pemerolehan Dana

  public function pemerolehan_dana_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $data = TabelK5PemerolehanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
      $total_ts2 = TabelK5PemerolehanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts2');
      $total_ts1 = TabelK5PemerolehanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts1');
      $total_ts = TabelK5PemerolehanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts');
    }else{
      $data = TabelK5PemerolehanDana::where('prodi_id', auth()->user()->prodi_id)->get();
      $total_ts2 = TabelK5PemerolehanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts2');
      $total_ts1 = TabelK5PemerolehanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts1');
      $total_ts = TabelK5PemerolehanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts');
    }
    
    return view('kriteria.c5.pemerolehan_dana.index', compact('data','total_ts2','total_ts1','total_ts'));
  }
  public function pemerolehan_dana_create()
  {
    //
    return view('kriteria.c5.pemerolehan_dana.form');
  }

  public function pemerolehan_dana_store(Request $request)
  {
    // Validate request data
    $request->validate([
      'sumber_dana' => 'required|string|max:255',
      'jenis_dana' => 'required|string|max:255',
      'jumlah_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_ts2.regex' => 'The jumlah_ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts1.regex' => 'The jumlah_ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts.regex' => 'The jumlah_ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_ts2 = str_replace(',', '', $request->jumlah_ts2);
    $jumlah_ts1 = str_replace(',', '', $request->jumlah_ts1);
    $jumlah_ts = str_replace(',', '', $request->jumlah_ts);

    // Get 'prodi_id' from logged-in user session
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana = TabelK5PemerolehanDana::create([
      'sumber_dana' => $request->sumber_dana,
      'jenis_dana' => $request->jenis_dana,
      'jumlah_ts2' => $jumlah_ts2,
      'jumlah_ts1' => $jumlah_ts1,
      'jumlah_ts' => $jumlah_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);
    
    return redirect()->route('pemerolehan_dana.index')->with('success', 'Data K5 Pemerolehan Dana ADDED successfully');    
  }

  public function pemerolehan_dana_show(tabelC5 $tabelC5)
  {
    //
  }

  public function pemerolehan_dana_edit($id)
  {
    $item = TabelK5PemerolehanDana::findOrFail($id);
    return view('kriteria.c5.pemerolehan_dana.form', ['item' => $item]);
  }

  public function pemerolehan_dana_update(Request $request, $id)
  {
    // Validate request data
    $idx = Crypt::decryptString($id);
    $request->validate([
      'sumber_dana' => 'required|string|max:255',
      'jenis_dana' => 'required|string|max:255',
      'jumlah_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_ts2.regex' => 'The jumlah_ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts1.regex' => 'The jumlah_ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts.regex' => 'The jumlah_ts format is invalid. It should be in the format like 123,000,000.',
    ]);
    
    $jumlah_ts2 = str_replace(',', '', $request->jumlah_ts2);
    $jumlah_ts1 = str_replace(',', '', $request->jumlah_ts1);
    $jumlah_ts = str_replace(',', '', $request->jumlah_ts);

    // Find the record by ID
    $dana = TabelK5PemerolehanDana::findOrFail($idx);

    // Verify the 'prodi_id' matches the logged-in user
    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('pemerolehan_dana.index')->with('error', 'Unauthorized action.');
    }
    $prodiId = Auth::user()->prodi_id;
    // Update the record
    $dana->update([
      'sumber_dana' => $request->sumber_dana,
      'jenis_dana' => $request->jenis_dana,
      'jumlah_ts2' => $jumlah_ts2,
      'jumlah_ts1' => $jumlah_ts1,
      'jumlah_ts' => $jumlah_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);

    return redirect()->route('pemerolehan_dana.index')->with('success', 'Data K5 Pemerolehan Dana UPDATED successfully');    

  }

  public function pemerolehan_dana_destroy($id)
  {
    // Find the record by ID
    $dana = TabelK5PemerolehanDana::findOrFail($id);

    // Verify the 'prodi_id' matches the logged-in user
    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('pemerolehan_dana.index')->with('error', 'Unauthorized action.');
    }

    // Delete the record
    $dana->delete();
    return redirect()->route('pemerolehan_dana.index')->with('success', 'Data K5 Pemerolehan Dana DELETED successfully');    
  }

  // // Kriteria 5 > Tabel Penggunaan Dana

  public function penggunaan_dana_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $items = TabelK5PenggunaanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
      $total_ts2 = TabelK5PenggunaanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts2');
      $total_ts1 = TabelK5PenggunaanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts1');
      $total_ts = TabelK5PenggunaanDana::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())
        ->sum('jumlah_ts');
    }else{
      $items = TabelK5PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)->get();
      $total_ts2 = TabelK5PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts2');
      $total_ts1 = TabelK5PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts1');
      $total_ts = TabelK5PenggunaanDana::where('prodi_id', auth()->user()->prodi_id)
        ->sum('jumlah_ts');
    }
    
    return view('kriteria.c5.penggunaan_dana.index', compact('items','total_ts2','total_ts1','total_ts'));
  }
  public function penggunaan_dana_create()
  {
    //
    return view('kriteria.c5.penggunaan_dana.form');
  }

  public function penggunaan_dana_store(Request $request)
  {
    // Validate request data
    $request->validate([
      'jenis_penggunaan' => 'required|string|max:255',
      'jumlah_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_ts2.regex' => 'The jumlah_ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts1.regex' => 'The jumlah_ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts.regex' => 'The jumlah_ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_ts2 = str_replace(',', '', $request->jumlah_ts2);
    $jumlah_ts1 = str_replace(',', '', $request->jumlah_ts1);
    $jumlah_ts = str_replace(',', '', $request->jumlah_ts);

    // Get 'prodi_id' from logged-in user session
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana = TabelK5PenggunaanDana::create([
      'jenis_penggunaan' => $request->jenis_penggunaan,
      'jumlah_ts2' => $jumlah_ts2,
      'jumlah_ts1' => $jumlah_ts1,
      'jumlah_ts' => $jumlah_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);

    return redirect()->route('penggunaan_dana.index')->with('success', 'Data K5 Penggunaan Dana ADDED successfully');    
  }

  public function penggunaan_dana_show(tabelC5 $tabelC5)
  {
    //
  }

  public function penggunaan_dana_edit($id)
  {
    $item = TabelK5PenggunaanDana::findOrFail($id);
    return view('kriteria.c5.penggunaan_dana.form', compact('item'));
  }

  public function penggunaan_dana_update(Request $request, $id)
  {
    $idx = Crypt::decryptString($id);
    $request->validate([
      'jenis_penggunaan' => 'required|string|max:255',
      'jumlah_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_ts2.regex' => 'The jumlah_ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts1.regex' => 'The jumlah_ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_ts.regex' => 'The jumlah_ts format is invalid. It should be in the format like 123,000,000.',
    ]);
    
    $jumlah_ts2 = str_replace(',', '', $request->jumlah_ts2);
    $jumlah_ts1 = str_replace(',', '', $request->jumlah_ts1);
    $jumlah_ts = str_replace(',', '', $request->jumlah_ts);

    // Find the record by ID
    $dana = TabelK5PenggunaanDana::findOrFail($idx);

    // Verify the 'prodi_id' matches the logged-in user
    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('penggunaan_dana.index')->with('error', 'Unauthorized action.');
    }
    $prodiId = Auth::user()->prodi_id;
    // Update the record
    $dana->update([
      'jenis_penggunaan' => $request->jenis_penggunaan,
      'jumlah_ts2' => $jumlah_ts2,
      'jumlah_ts1' => $jumlah_ts1,
      'jumlah_ts' => $jumlah_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);

    return redirect()->route('penggunaan_dana.index')->with('success', 'Data K5 Penggunaan Dana UPDATED successfully');    
  }

  public function penggunaan_dana_destroy($id)
  {
    $dana = TabelK5PenggunaanDana::findOrFail($id);

    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('penggunaan_dana.index')->with('error', 'Unauthorized action.');
    }
    $dana->delete();

    return redirect()->route('penggunaan_dana.index')->with('success', 'Data K5 Penggunaan Dana DELETED successfully');    
  }

  // Kriteria 5 > Tabel Dana Penelitian

  public function dana_penelitian_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $prodiID = $this->akunController->get_session_prodi_by_fakultas();
    }else{
      $prodiID = auth()->user()->prodi_id;
    }

    $items = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->get();
    $jumlah_dana_ts2 = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts2');
    $jumlah_dana_ts1 = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts1');
    $jumlah_dana_ts = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts');

    return view('kriteria.c5.dana_penelitian.index', compact('items','jumlah_dana_ts2','jumlah_dana_ts1','jumlah_dana_ts'));
  }
  public function dana_penelitian_create()
  {
    $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
    return view('kriteria.c5.dana_penelitian.form', compact('dosens'));
  }

  public function dana_penelitian_store(Request $request)
  {
    $request->validate([
      'judul_penelitian' => 'required|string|max:255',
      'nidn_nidk' => 'required|string|max:255',
      'sumber_dana' => 'required|string|max:255',
      'jumlah_dana_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_dana_ts2.regex' => 'The jumlah dana ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts1.regex' => 'The jumlah dana ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts.regex' => 'The jumlah dana ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_dana_ts2 = str_replace(',', '', $request->jumlah_dana_ts2);
    $jumlah_dana_ts1 = str_replace(',', '', $request->jumlah_dana_ts1);
    $jumlah_dana_ts = str_replace(',', '', $request->jumlah_dana_ts);

    // Get 'prodi_id' from logged-in user session
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana = TabelK5DanaPenelitian::create([
      'judul_penelitian' => $request->judul_penelitian,
      'nidn_nidk' => $request->nidn_nidk,
      'sumber_dana' => $request->sumber_dana,
      'jumlah_dana_ts2' => $jumlah_dana_ts2,
      'jumlah_dana_ts1' => $jumlah_dana_ts1,
      'jumlah_dana_ts' => $jumlah_dana_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);

    return redirect()->route('dana_penelitian.index')->with('success', 'Data K5 Dana Penelitian ADDED successfully');    

  }

  public function dana_penelitian_show(tabelC5 $tabelC5)
  {
    //
  }

  public function dana_penelitian_edit($id)
  {
    $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
    $item = TabelK5DanaPenelitian::findOrFail($id);
    return view('kriteria.c5.dana_penelitian.form', compact('item', 'dosens'));
  }

  public function dana_penelitian_update(Request $request, $id)
  {
    $idx = Crypt::decryptString($id);
    $request->validate([
      'judul_penelitian' => 'required|string|max:255',
      'nidn_nidk' => 'required|string|max:255',
      'sumber_dana' => 'required|string|max:255',
      'jumlah_dana_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_dana_ts2.regex' => 'The jumlah dana ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts1.regex' => 'The jumlah dana ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts.regex' => 'The jumlah dana ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_dana_ts2 = str_replace(',', '', $request->jumlah_dana_ts2);
    $jumlah_dana_ts1 = str_replace(',', '', $request->jumlah_dana_ts1);
    $jumlah_dana_ts = str_replace(',', '', $request->jumlah_dana_ts);
    // Find the record by ID
    $dana = TabelK5DanaPenelitian::findOrFail($idx);

    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('dana_penelitian.index')->with('error', 'Unauthorized action.');
    }
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana->update([
      'judul_penelitian' => $request->judul_penelitian,
      'nidn_nidk' => $request->nidn_nidk,
      'sumber_dana' => $request->sumber_dana,
      'jumlah_dana_ts2' => $jumlah_dana_ts2,
      'jumlah_dana_ts1' => $jumlah_dana_ts1,
      'jumlah_dana_ts' => $jumlah_dana_ts,
      'tautan' => $request->tautan,
    ]);

    return redirect()->route('dana_penelitian.index')->with('success', 'Data K5 Dana Penelitian UPDATED successfully');    
  }

  public function dana_penelitian_destroy($id)
  {
    TabelK5DanaPenelitian::destroy($id);
    return redirect()->route('dana_penelitian.index')->with('success', 'Data K5 Dana Penelitian DELETED successfully');    
  }

  // Kriteria 5 > Tabel Dana PKM

  public function dana_pkm_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $prodiID = $this->akunController->get_session_prodi_by_fakultas();
    }else{
      $prodiID = auth()->user()->prodi_id;
    }

    $items = TabelK5DanaPKM::where('prodi_id', $prodiID)->get();    
    // $jumlah_dana_ts2 = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts2');
    // $jumlah_dana_ts1 = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts1');
    // $jumlah_dana_ts = TabelK5DanaPenelitian::where('prodi_id', $prodiID)->sum('jumlah_dana_ts');

    return view('kriteria.c5.dana_pkm.index', compact('items'));
  }
  public function dana_pkm_create()
  {
    $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
    return view('kriteria.c5.dana_pkm.form', compact('dosens'));
  }

  public function dana_pkm_store(Request $request)
  {
    $request->validate([
      'judul_pkm' => 'required|string|max:255',
      'nidn_nidk' => 'required|string|max:255',
      'sumber_dana' => 'required|string|max:255',
      'jumlah_dana_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_dana_ts2.regex' => 'The jumlah dana ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts1.regex' => 'The jumlah dana ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts.regex' => 'The jumlah dana ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_dana_ts2 = str_replace(',', '', $request->jumlah_dana_ts2);
    $jumlah_dana_ts1 = str_replace(',', '', $request->jumlah_dana_ts1);
    $jumlah_dana_ts = str_replace(',', '', $request->jumlah_dana_ts);

    // Get 'prodi_id' from logged-in user session
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana = TabelK5DanaPKM::create([
      'judul_pkm' => $request->judul_pkm,
      'nidn_nidk' => $request->nidn_nidk,
      'sumber_dana' => $request->sumber_dana,
      'jumlah_dana_ts2' => $jumlah_dana_ts2,
      'jumlah_dana_ts1' => $jumlah_dana_ts1,
      'jumlah_dana_ts' => $jumlah_dana_ts,
      'tautan' => $request->tautan,
      'prodi_id' => $prodiId,
    ]);

    return redirect()->route('dana_pkm.index')->with('success', 'Data K5 Dana PKM ADDED successfully');    
  }

  public function dana_pkm_show(tabelC5 $tabelC5)
  {
    //
  }

  public function dana_pkm_edit($id)
  {
    $dosens = TabelDosen::where('prodi_id', auth()->user()->prodi_id)->get();
    $item = TabelK5DanaPKM::findOrFail($id);
    return view('kriteria.c5.dana_pkm.form', compact('item', 'dosens'));
  }

  public function dana_pkm_update(Request $request, $id)
  {
    $idx = Crypt::decryptString($id);
    $request->validate([
      'judul_pkm' => 'required|string|max:255',
      'nidn_nidk' => 'required|string|max:255',
      'sumber_dana' => 'required|string|max:255',
      'jumlah_dana_ts2' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts1' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'jumlah_dana_ts' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
      'tautan' => 'required|string|max:255',
    ], [
      'jumlah_dana_ts2.regex' => 'The jumlah dana ts2 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts1.regex' => 'The jumlah dana ts1 format is invalid. It should be in the format like 123,000,000.',
      'jumlah_dana_ts.regex' => 'The jumlah dana ts format is invalid. It should be in the format like 123,000,000.',
    ]);

    $jumlah_dana_ts2 = str_replace(',', '', $request->jumlah_dana_ts2);
    $jumlah_dana_ts1 = str_replace(',', '', $request->jumlah_dana_ts1);
    $jumlah_dana_ts = str_replace(',', '', $request->jumlah_dana_ts);
    // Find the record by ID
    $dana = TabelK5DanaPKM::findOrFail($idx);

    if ($dana->prodi_id != Auth::user()->prodi_id) {
        return redirect()->route('dana_pkm.index')->with('error', 'Unauthorized action.');
    }
    $prodiId = Auth::user()->prodi_id;

    // Create a new record
    $dana->update([
      'judul_pkm' => $request->judul_pkm,
      'nidn_nidk' => $request->nidn_nidk,
      'sumber_dana' => $request->sumber_dana,
      'jumlah_dana_ts2' => $jumlah_dana_ts2,
      'jumlah_dana_ts1' => $jumlah_dana_ts1,
      'jumlah_dana_ts' => $jumlah_dana_ts,
      'tautan' => $request->tautan,
    ]);

    return redirect()->route('dana_pkm.index')->with('success', 'Data K5 Dana pkm UPDATED successfully');    
  }

  public function dana_pkm_destroy($id)
  {
    TabelK5DanaPKM::destroy($id);
    return redirect()->route('dana_pkm.index')->with('success', 'Data K5 Dana PKM DELETED successfully');    
  }

  // Kriteria 5 > Tabel Data Prasarana Pendidikan

  public function prasarana_pendidikan_index(Request $request)
  {
    $items = TabelK5PrasaranPendidikan::where('prodi_id',  auth()->user()->prodi_id)->get();
    return view('kriteria.c5.prasarana_pendidikan.index', ['items'=>$items]);
  }
  public function prasarana_pendidikan_create()
  {
    return view('kriteria.c5.prasarana_pendidikan.form');
  }

  public function prasarana_pendidikan_store(Request $request)
  {
    $request->validate([
      "jenis_prasarana" => "required",
      "jumlah_unit" => "required",
      "luas" => "required",
      "kepemilikan" => "required",
      "kondisi" => "required",
      "penggunaan" => "required",      
    ]);

    TabelK5PrasaranPendidikan::create([
      "jenis_prasarana" => $request->jenis_prasarana,
      "jumlah_unit" => $request->jumlah_unit,
      "luas" => $request->luas,
      "kepemilikan" => $request->kepemilikan,
      "kondisi" => $request->kondisi,
      "penggunaan" => $request->penggunaan,
      "tautan" => $request->tautan,
      "prodi_id" => auth()->user()->prodi_id,
    ]);

    return redirect()->route('prasarana_pendidikan.index')->with('success', 'Data K5 Prasarana Pendidikan ADDED successfully');    
  }

  public function prasarana_pendidikan_show(tabelC5 $tabelC5)
  {
    //
  }

  public function prasarana_pendidikan_edit($id)
  {
    $item = TabelK5PrasaranPendidikan::findOrFail($id);
    return view('kriteria.c5.prasarana_pendidikan.form', ['item'=>$item]);
  }

  public function prasarana_pendidikan_update(Request $request, $id)
  {
    $idx = Crypt::decryptString($id);
    $data = TabelK5PrasaranPendidikan::findOrFail($idx);

    $request->validate([
      "jenis_prasarana" => "required",
      "jumlah_unit" => "required",
      "luas" => "required",
      "kepemilikan" => "required",
      "kondisi" => "required",
      "penggunaan" => "required",      
    ]);

    $data->update([
      "jenis_prasarana" => $request->jenis_prasarana,
      "jumlah_unit" => $request->jumlah_unit,
      "luas" => $request->luas,
      "kepemilikan" => $request->kepemilikan,
      "kondisi" => $request->kondisi,
      "penggunaan" => $request->penggunaan,
      "tautan" => $request->tautan,
    ]);

    return redirect()->route('prasarana_pendidikan.index')->with('success', 'Data K5 Prasarana Pendidikan UPDATED successfully');    
  }

  public function prasarana_pendidikan_destroy($id)
  {
    TabelK5PrasaranPendidikan::destroy($id);
    return redirect()->route('prasarana_pendidikan.index')->with('success', 'Data K5 Prasarana Pendidikan DELETED successfully');
  }

  // Kriteria 5 > Tabel Data Sarana Pendidikan

  public function sarana_pendidikan_index()
  {
    if(Auth::user()->role == 'fakultas'){
      $prodiID = $this->akunController->get_session_prodi_by_fakultas();
    }else{
      $prodiID = auth()->user()->prodi_id;
    }

    $items = TabelK5SaranaPendidikan::where('prodi_id', $prodiID)->get();
    return view('kriteria.c5.sarana_pendidikan.index', ['items'=>$items]);
  }
  public function sarana_pendidikan_create()
  {
    //
    return view('kriteria.c5.sarana_pendidikan.form');
  }

  public function sarana_pendidikan_store(Request $request)
  {
    $request->validate([
      'jenis_sarana' => 'required',
      'jumlah_unit'  => 'required|numeric',
      'kualitas'  => 'required',
      'kondisi' => 'required',
      'unit_pengelola' => 'required',
      'tautan' => 'required',
    ]);

    TabelK5SaranaPendidikan::create([
      'jenis_sarana'  => $request->jenis_sarana,
      'jumlah_unit'  => $request->jumlah_unit,
      'kualitas'  => $request->kualitas,
      'kondisi' => $request->kondisi,
      'unit_pengelola' => $request->unit_pengelola,
      'tautan' => $request->tautan,
      'prodi_id' => auth()->user()->prodi_id,
    ]);

    return redirect()->route('sarana_pendidikan.index')->with('success', 'Data K5 Sarana Pendidikan ADDED successfully');
  }

  public function sarana_pendidikan_show(tabelC5 $tabelC5)
  {
    //
  }

  public function sarana_pendidikan_edit($id)
  {
    $item = TabelK5SaranaPendidikan::findOrFail($id);
    return view('kriteria.c5.sarana_pendidikan.form', ['item'=>$item]);
  }

  public function sarana_pendidikan_update(Request $request, $id)
  {
    $idx = Crypt::decryptString($id);
    $data = TabelK5SaranaPendidikan::findOrFail($idx);
    $request->validate([
      'jenis_sarana' => 'required',
      'jumlah_unit'  => 'required|numeric',
      'kualitas'  => 'required',
      'kondisi' => 'required',
      'unit_pengelola' => 'required',
      'tautan' => 'required',
    ]);
    $data->update([
      'jenis_sarana'  => $request->jenis_sarana,
      'jumlah_unit'  => $request->jumlah_unit,
      'kualitas'  => $request->kualitas,
      'kondisi' => $request->kondisi,
      'unit_pengelola' => $request->unit_pengelola,
      'tautan' => $request->tautan,
    ]);
    return redirect()->route('sarana_pendidikan.index')->with('success', 'Data K5 Sarana Pendidikan UPDATED successfully');
  }

  public function sarana_pendidikan_destroy($id)
  {
    TabelK5SaranaPendidikan::destroy($id);
    return redirect()->route('sarana_pendidikan.index')->with('success', 'Data K5 Sarana Pendidikan DELETED successfully');
  }


}
