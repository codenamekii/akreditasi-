<?php

namespace App\Http\Controllers;

use App\Models\dataProgramStudi;
use App\Models\TabelK2BidangPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
// use App\Http\Controllers\AkunController;

class DataProgramStudiController extends Controller
{


    // fungsi yang digunakan untuk mengambil data semua program studi
    public function getSemuaProdi(){
        $data_prodi = dataProgramStudi::where('id', '!=', 1)
        ->where('fakultas_id', '=', Auth::user()->prodi->fakultas_id)
        ->get();
        return $data_prodi;
    }

    /**
     * Set the session of the selected program studi
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sessionProdi($id)
    {
        // Find the program studi based on the given id
        $prodi = dataProgramStudi::find($id);

        // Set the session variable 'prodi' with the selected program studi
        Session::put('prodi', compact('prodi'));

        // Redirect back to the page where this function was called

        return redirect()->back()->with('pilihProdi','success');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->role != 'fakultas'){
            $data_prodi = dataProgramStudi::findorfail( Auth::user()->prodi->id);
            
        }else{        
            if(empty(session::get('prodi'))){
                // If session variable 'prodi' is empty, redirect to dashboard
                return redirect()->route('dashboard.index')->with('error', 'Anda harus memilih prodi terlebih dahulu');
            }

            $session_prodi = Session::get('prodi');
            $data_prodi = dataProgramStudi::findorfail($session_prodi['prodi']->id);
        }
        return view('kriteria.dataProdi.index', ['prodi' => $data_prodi]);
    }

    
    /**
     * Menampilkan semua data program studi
     *
     * @return \Illuminate\Http\Response
     */
    public function semua()
    {
        $data_prodi = dataProgramStudi::where('id', '!=', 1)->get();
        return view('kriteria.dataProdi.kelola', ['data_prodi' => $data_prodi]);
    }

    
    /**
     * Menampilkan data program studi berdasarkan id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editById($id)
    {
        $id = Crypt::decryptString($id);
        $data_prodi = dataProgramStudi::find($id);
        if ($data_prodi === null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('kriteria.dataProdi.create', ['dataProdi' => $data_prodi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kriteria.dataProdi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
        ]);

        dataProgramStudi::create([
            'id' => $request->id,
            'nama' => $request->nama,
        ]);
        return redirect(route('dataprodi.semua'))->with('success', 'program studi telah berhasil di buat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dataProgramStudi  $dataProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function show(dataProgramStudi $dataProgramStudi)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateByFakutlas(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $data = dataProgramStudi::find($id);
        $data->update([
            'nama' => $request->nama,
        ]);
        return redirect(route('dataprodi.semua'))->with('success', 'Data Program Studi berhasil diubah');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dataProgramStudi  $dataProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function edit(dataProgramStudi $dataProgramStudi)
    {
        $item =  dataProgramStudi::findorfail( Auth::user()->prodi->id);
        return view('kriteria.dataProdi.form', ['item'=>$item]);
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
        $idx =Crypt::decryptString($id);
        
        $data = dataProgramStudi::findOrFail($idx);

        // Validate input if needed
        $request->validate([
            'jenis' => 'required|max:255',
            'nama' => 'required',
            'status_peringkat' => 'required',
            'nomor_sk' => 'required|min:6',
            'tanggal_sk' => 'required|min:8',
            'tanggal_kadaluarsa' => 'required|min:8',
            'jumlah_mhs_ts' => 'required|integer',
            'jumlah_dtps_ts' => 'required|integer',
            'rerata_ipk' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'rerata_masa_studi' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        // Update data
        $data->update([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'status_peringkat' => $request->status_peringkat,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'jumlah_mhs_ts' => $request->jumlah_mhs_ts,
            'jumlah_dtps_ts' => $request->jumlah_dtps_ts,
            'rerata_ipk' => $request->rerata_ipk,
            'rerata_masa_studi' => $request->rerata_masa_studi
        ]);

        return redirect('/dataprodi')->with('success', 'Data Prodi updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dataProgramStudi  $dataProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decryptString($id);
        dataProgramStudi::destroy($id);
        return redirect(route('dataprodi.semua'))->with('success', 'Data program studi telah berhasil di hapus');
    }
}
