<?php

namespace App\Http\Controllers;

use App\Mail\AkunCreated;
use App\Models\TabelC1;
use Illuminate\Http\Request;

class TabelC1Controller extends Controller
{

    public function index()
    {

        $user_login_prodi = auth()->user()->prodi->nama;

        $table_c1 = TabelC1::where('prodi', $user_login_prodi)->first();

        // dd($table_c1);

        return view('kriteria.c1.index', compact('table_c1'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // Validasi input
        $this->validate($request, [
            'visi_misi' => 'required', // Validasi file
            'prodi' => 'required|string|max:255', // Validasi prodi
        ]);

        // Proses upload file
        if ($request->hasFile('visi_misi')) {
            $file = $request->file('visi_misi');
            $timestamp = time(); // Mendapatkan timestamp saat ini
            $fileName = 'visi_misi_' . $timestamp . '.' . $file->getClientOriginalExtension();

            // Simpan file ke direktori public/documents
            $file->move(public_path('documents'), $fileName);

            // Cari data berdasarkan prodi
            $existingData = TabelC1::where('prodi', $request->prodi)->first();

            if ($existingData) {
                // Jika data sudah ada, hapus file lama
                $oldFile = public_path('documents/' . $existingData->visi_misi);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                // Update data di database
                $existingData->update([
                    'visi_misi' => $fileName,
                    'prodi' => $request->prodi,
                ]);
            } else {
                // Jika data belum ada, buat data baru
                TabelC1::create([
                    'visi_misi' => $fileName,
                    'prodi' => $request->prodi,
                ]);
            }
        }

        return redirect()->route('kriteria1.index')->with('success', 'Data berhasil disimpan');
    }
}
