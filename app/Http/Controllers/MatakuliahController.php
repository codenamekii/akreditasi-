<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{
    public function index()
    {
        $dataMatakuliah = Matakuliah::where('prodi_id',Auth::user()->prodi_id)->get();
        return view('matakuliah.index', compact('dataMatakuliah'));
    }

    public function create()
    {
        return view('matakuliah.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'jenis_matakuliah' => 'required',
            'unit_penyelenggara' => 'required',
            'kesesuaian_cpl' => 'required',
            'perangkat_pembelajaran' => 'required',
        ]);

        if (Matakuliah::where('kode_mk', $request->kode_mk)->exists()) {
            return redirect()->back()->withErrors([
                'kode_mk' => 'Kode MK telah digunakan, silakan gunakan kode yang lain.',
            ])->withInput();
        }

        $matakuliah = Matakuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'jenis_matakuliah' => $request->jenis_matakuliah,
            'unit_penyelenggara' => $request->unit_penyelenggara,
            'kesesuaian_cpl' => $request->kesesuaian_cpl,
            'perangkat_pembelajaran' => $request->perangkat_pembelajaran,
            'prodi_id' => Auth::user()->prodi_id,
        ]);

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan!');
    }

    public function show($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('matakuliah.form', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kode_mk' => 'required|unique:tabel_matakuliah,id,'.$id,
            'nama' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'jenis_matakuliah' => 'required',
            'unit_penyelenggara' => 'required',
            'kesesuaian_cpl' => 'required',
            'perangkat_pembelajaran' => 'required',
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update([
            'kode_mk' => $request->kode_mk,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'jenis_matakuliah' => $request->jenis_matakuliah,
            'unit_penyelenggara' => $request->unit_penyelenggara,
            'kesesuaian_cpl' => $request->kesesuaian_cpl,
            'perangkat_pembelajaran' => $request->perangkat_pembelajaran
        ]);
        

        return redirect()->route('matakuliah.edit', $id)->with('success', 'Matakuliah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus!');
    }

}

