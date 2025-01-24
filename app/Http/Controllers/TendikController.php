<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tendik;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan semua data tendik yang ada di database
        $tendiks = Tendik::all();
        return view('tendik.index', compact('tendiks'));
    }

    /**
     * Show the create form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan data tendik baru
        return view('tendik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi inputan dari form
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'foto' => 'required',
        ]);

        // Menambahkan data tendik baru ke database
        Tendik::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'hp' => $request->hp,
            'foto' => $request->foto,
        ]);

        // Redirect ke halaman list tendik dengan pesan success
        return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Menampilkan detail data tendik berdasarkan id
        $tendik = Tendik::findOrFail($id);
        return view('tendik.show', compact('tendik'));
    }

    /**
     * Show the edit form for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Menampilkan form edit data tendik berdasarkan id
        $tendik = Tendik::findOrFail($id);
        return view('tendik.edit', compact('tendik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi inputan dari form
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'foto' => 'required',
        ]);

        // Update data tendik berdasarkan id
        $tendik = Tendik::findOrFail($id);
        $tendik->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'hp' => $request->hp,
            'foto' => $request->foto,
        ]);

        // Redirect ke halaman list tendik dengan pesan success
        return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus data tendik berdasarkan id
        $tendik = Tendik::findOrFail($id);
        $tendik->delete();

        // Redirect ke halaman list tendik dengan pesan success
        return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil dihapus');
    
    }
}
