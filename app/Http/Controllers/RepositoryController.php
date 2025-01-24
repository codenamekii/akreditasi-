<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repository; // Import model Repository
use App\Models\Dokumen; // Import model Dokumen
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt; // library untuk encrypt

class RepositoryController extends Controller
{

  public function __construct()
  {
    // Constructor logic here
  }

  // Menampilkan semua data repository berdasarkan tahun dan kriteria
  public function index(Request $request)
  {
    $kriteria = $request->input('kriteria', 1); // Menetapkan nilai default null jika tidak ada input

    // Query untuk mengambil data repository
    if(Auth::user()->role == 'admin prodi') //menampilkan data untuk admin prodi
    $repositories = Repository::where('kriteria', $kriteria)
    ->where('prodi_id', Auth::user()->prodi->id)
    ->get();
    elseif (Auth::user()->role == 'asesor') { // untuk asesor
      $repositories = Repository::where('kriteria', $kriteria)
      ->where('prodi_id', Auth::user()->prodi->id)
      ->where('view','true') // tampilkan repository yang diperbolehkan untuk asesor
      ->get();
    }
    // Cek jika data repository kosong
    if ($repositories->isEmpty()) {
      $repositories = collect(); // Menggunakan collect() untuk membuat koleksi kosong
      return view('repository.manajemen_repository', compact('repositories'))->with('error', 'Data tidak ditemukan.');
    } else {

      foreach ($repositories as $repository) {
        $repository->encrypted_id = Crypt::encryptString($repository->id);
      }
      return view('repository.manajemen_repository', ['repositories' => $repositories])
      ->with('success', 'Data berhasil ditampilkan.');
    }
  }

  // Menyimpan data repository baru
  public function store(Request $request)
  {
    // Validasi data input
    $validatedData = $request->validate([
      'namaRepository' => 'required|string|max:255',
      'kriteria' => 'required|integer',
      'view' => 'required',
    ]);

    // Membuat instance baru dari model Repository
    $repository = new Repository();
    $repository->nama_repository = $validatedData['namaRepository'];
    $repository->prodi_id = Auth::user()->prodi->id;
    $repository->kriteria = $validatedData['kriteria'];
    $repository->view = $validatedData['view'];
    $repository->save();

    // Redirect ke form dengan pesan sukses
    return redirect()->route('repository.form')->with('success', 'Repository berhasil disimpan.');
  }

  // Fungsi untuk mengedit data repository
  public function edit($id)
  {
    $repository = Repository::find($id);

    // Cek jika repository tidak ditemukan
    if (!$repository) {
      return redirect()->route('repository.semua')->with('error', 'Repository tidak ditemukan.');
    }

    return view('repository.form_repository', compact('repository'));
  }

  // Fungsi untuk memperbarui data repository
  public function update(Request $request, $id)
  {
    // Mengambil data repository berdasarkan id
    $repository = Repository::find($id);

    // Cek jika repository tidak ditemukan
    if (!$repository) {
      return redirect()->route('repository.edit', $id)->with('error', 'Repository tidak ditemukan.');
    }

    // Validasi data input
    $validatedData = $request->validate([
      'namaRepository' => 'required|string|max:255',
      'kriteria' => 'required|integer',
      'view' => 'required',
    ]);

    // Memperbarui data repository
    $repository->nama_repository = $validatedData['namaRepository'];
    $repository->kriteria = $validatedData['kriteria'];
    $repository->view = $validatedData['view'];
    $repository->save();

    // Redirect dengan pesan sukses
    return redirect()->route('repository.edit', $id)->with('success', 'Repository berhasil diperbarui.');
  }

  // Fungsi untuk menghapus data repository
  public function destroy($id)
  {
    // Kode untuk menghapus data berdasarkan id
    $repository = Repository::findOrFail($id);
    $repository->delete();

    return redirect()->back()->with('success', 'Matakuliah berhasil dihapus!');
  }

  // Menampilkan form untuk menambah repository
  public function formRepository()
  {

    return view('repository.form_repository');
  }

  // Menampilkan detail dari repository berdasarkan id
  public function show($id)
  {
    $id =  Crypt::decryptString($id);
    $repository = Repository::find($id);

    // Cek jika repository tidak ditemukan
    if (!$repository) {
      return redirect()->route('repository.semua')->with('error', 'Repository tidak ditemukan.');
    }

    // Mengambil semua dokumen yang terkait dengan repository ini
    $dokumen = Dokumen::where('repository_id', $id)->get();

    // Menambahkan dokumen ke view
    return view('repository.detail_repository', compact('repository', 'dokumen'));
  }
}
