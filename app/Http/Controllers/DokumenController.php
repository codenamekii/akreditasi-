<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Repository; // Menambahkan model Repository
use Illuminate\Support\Facades\Storage; // Menambahkan use statement untuk menggunakan kelas Storage
use Illuminate\Support\Facades\Auth;


class DokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen.
     */
    public function index(Request $request)
    {
        $kriteria = $request->input('kriteria', 2);

        $repository = Repository::where('kriteria', $kriteria)
        ->where('prodi_id', Auth::user()->prodi->id)
        ->with('documents')
        ->get();

        if ($repository->isEmpty()) {
            return view('dokumen.semua_dokumen', compact('repository'))->with('error', 'Data dokumen tidak tersedia.');
        }

        return view('dokumen.semua_dokumen', compact('repository'));
    }

    /**
     * Menampilkan form untuk membuat dokumen baru.
     */
    public function create()
    {
        return view('dokumen.form_dokumen');
    }


    /**
     * Menyimpan dokumen baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'document' => 'required|file|mimes:pdf|max:2048', // Hanya file PDF dan maksimal 2MB
        'documentName' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'repository_id' => 'required|integer' // Menambahkan validasi untuk repository_id
    ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('documents'); // Menggunakan public path

        // Memastikan direktori ada atau membuatnya jika tidak ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Memindahkan file ke direktori public/documents
        $file->move($destinationPath, $filename);

        // Menyimpan path yang relatif terhadap public path
        $path = 'documents/' . $filename;

        $dokumen = new Dokumen();
        $dokumen->nama_dokumen = $validatedData['documentName'];
        $dokumen->keterangan = $validatedData['description'];
        $dokumen->path = $path; // Menyesuaikan path yang disimpan di database
        $dokumen->repository_id = $validatedData['repository_id']; // Menetapkan repository_id dari data yang divalidasi
        $dokumen->save();

        return back()->with('success', 'Dokumen berhasil disimpan.');
    } else {
        return back()->with('error', 'Gagal mengupload dokumen.');
    }
}


    /**
     * Menghapus dokumen berdasarkan ID.
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            return back()->with('error', 'Dokumen tidak ditemukan.');
        }

        Storage::delete('public/documents/' . basename($dokumen->path));
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }


    /**
     * Menampilkan dokumen tertentu.
     */
    public function show($id)
    {
        // Kode untuk menampilkan dokumen tertentu
    }

    /**
     * Menampilkan form untuk mengedit dokumen.
     */
    public function edit($id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            return back()->with('error', 'Dokumen tidak ditemukan.');
        }

        return view('dokumen.form_dokumen', compact('dokumen'));
    }

    /**
     * Mengupdate dokumen berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'dokumen' => 'file|mimes:pdf|max:2048', // Validasi untuk file dokumen
        'namaDokumen' => 'required|string|max:255',
        'keterangan' => 'required|string|max:1000',
    ]);

        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            return back()->with('error', 'Dokumen tidak ditemukan.');
        }

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('documents'); // Menggunakan public path

        // Memastikan direktori ada atau membuatnya jika tidak ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Hapus file dokumen sebelumnya jika ada
        $oldFilePath = public_path($dokumen->path);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        // Memindahkan file ke direktori public/documents
        $file->move($destinationPath, $filename);

        // Update path dokumen di database
        $dokumen->path = 'documents/' . $filename;
    }

    $dokumen->nama_dokumen = $validatedData['namaDokumen'];
    $dokumen->keterangan = $validatedData['keterangan'];
    $dokumen->save();

    return back()->with('success', 'Dokumen berhasil diperbarui.');
}

}
