<?php

namespace App\Http\Controllers;

use App\Models\tabelC9;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\TabelK9IpkLulusan;
use App\Models\TabelK9MasaStudi;
use App\Models\TabelK9PrestasiMahasiswa;
use App\Models\TabelK9RelevansiPekerjaan;
use App\Models\TabelK9TracerStudi;
use App\Models\TabelK9Publikasi;
use App\Models\TabelK9ProdukHki;
use App\Models\TabelK9Produk;
use App\Models\TabelK9KepuasanPengguna;
use App\Models\TabelK9KaryaDisitasi;


class TabelC9Controller extends Controller
{

    public function __construct()
    {
        $this->akunController = new AkunController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('kriteria.c9.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $data = TabelK9IpkLulusan::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->orderBy('tahun', 'desc')->get();
        }else{
            $data = TabelK9IpkLulusan::where('prodi_id', Auth::user()->prodi->id)->orderBy('tahun', 'desc')->get();

        }

        return view('kriteria.c9.ipk_lulusan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_create()
    {
        //
        return view('kriteria.c9.ipk_lulusan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_store(Request $request)
    {
        //

        $request->validate([
            'tahun' => 'required',
            'jumlah_lulusan' => 'required',
            'tautan' => 'nullable',
            'minimum' => 'required|numeric|between:0,4.00',
            'rata_rata' => 'required|numeric|between:0,4.00',
            'maksimum' => 'required|numeric|between:0,4.00',
        ]);


        TabelK9IpkLulusan::create([
            'tahun' => $request->tahun,
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'minimum' => $request->minimum,
            'rata_rata' => $request->rata_rata,
            'maksimum' => $request->maksimum,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);


        return redirect()->route('ipk_lulusan.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_edit(tabelC9 $tabelC9,$id)
    {
        //
        $data = TabelK9IpkLulusan::findorfail($id);
        return view('kriteria.c9.ipk_lulusan.form', ['item' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_update(Request $request, TabelK9IpkLulusan $model,$id)
    {
        //

        $id = Crypt::decryptString($id);

         $request->validate([
            'jumlah_lulusan' => 'required',
            'minimum' => 'required|numeric|between:0,4.00',
            'rata_rata' => 'required|numeric|between:0,4.00',
            'maksimum' => 'required|numeric|between:0,4.00',
            'tautan' => 'nullable',
        ]);


        // TabelK9IpkLulusan::findorfail($id);
        TabelK9IpkLulusan::where('id', $id)->update([
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'minimum' => $request->minimum,
            'rata_rata' => $request->rata_rata,
            'maksimum' => $request->maksimum,
            'tautan' => $request->tautan,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function ipk_lulusan_destroy(tabelC9 $tabelC9,$id)
    {
        //
        TabelK9IpkLulusan::destroy($id);

        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $data = TabelK9PrestasiMahasiswa::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
            $data = TabelK9PrestasiMahasiswa::where('prodi_id', Auth::user()->prodi->id)->orderBy('waktu', 'desc')->get();

        }
        return view('kriteria.c9.prestasi_mahasiswa.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_create()
    {
        return view('kriteria.c9.prestasi_mahasiswa.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'prestasi' => 'required',
            'waktu' => 'required',
            'tingkat' => 'required',
            'tautan' => 'nullable',
        ]);

        TabelK9PrestasiMahasiswa::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'prestasi' => $request->prestasi,
            'waktu' => $request->waktu,
            'tingkat' => $request->tingkat,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);

        return redirect()->route('prestasi_mahasiswa.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_edit(tabelC9 $tabelC9, $id)
    {
        $data = TabelK9PrestasiMahasiswa::findorfail($id);

        return view('kriteria.c9.prestasi_mahasiswa.form', ['item' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_update(Request $request, tabelC9 $tabelC9, $id)
    {
         $request->validate([
            'nama_mahasiswa' => 'required',
            'prestasi' => 'required',
            'waktu' => 'required',
            'tingkat' => 'required',
            'tautan' => 'nullable',
        ]);


        // TabelK9IpkLulusan::findorfail($id);
        TabelK9PrestasiMahasiswa::where('id', $id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'prestasi' => $request->prestasi,
            'waktu' => $request->waktu,
            'tingkat' => $request->tingkat,
            'tautan' => $request->tautan,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function prestasi_mahasiswa_destroy(tabelC9 $tabelC9,$id)
    {
        TabelK9PrestasiMahasiswa::destroy($id);

        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_index()
    {
        if(Auth::user()->role == 'fakultas'){
            $data = tabelK9masaStudi::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
            $data = tabelK9masaStudi::where('prodi_id', Auth::user()->prodi->id)->orderBy('tahun_masuk', 'desc')->get();

        }

        return view('kriteria.c9.masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index', ['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_create()
    {
        return view('kriteria.c9.masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_store(Request $request)
    {

        $request->validate([
            'tahun_masuk' => 'required',
            'jumlah_diterima' => 'required|integer',
            'jumlah_lulus_ts_6' => 'required|integer',
            'jumlah_lulus_ts_5' => 'required|integer',
            'jumlah_lulus_ts_4' => 'required|integer',
            'jumlah_lulus_ts_3' => 'required|integer',
            'jumlah_lulus_ts_2' => 'required|integer',
            'jumlah_lulus_ts_1' => 'required|integer',
            'jumlah_lulus_ts' => 'required|integer',
            'tautan' => 'nullable',
        ]);

        $existingRecord = tabelK9masaStudi::where('tahun_masuk', $request->tahun_masuk)
            ->where('prodi_id', Auth::user()->prodi->id)
            ->exists();

        if ($existingRecord) {
            return redirect()->back()->with('info','Data untuk tahun masuk ini sudah ada.')->withInput();
        }


        tabelK9masaStudi::create([
            'tahun_masuk' => $request->tahun_masuk,
            'jumlah_diterima' => $request->jumlah_diterima,
            'jumlah_lulus_ts_6' => $request->jumlah_lulus_ts_6,
            'jumlah_lulus_ts_5' => $request->jumlah_lulus_ts_5,
            'jumlah_lulus_ts_4' => $request->jumlah_lulus_ts_4,
            'jumlah_lulus_ts_3' => $request->jumlah_lulus_ts_3,
            'jumlah_lulus_ts_2' => $request->jumlah_lulus_ts_2,
            'jumlah_lulus_ts_1' => $request->jumlah_lulus_ts_1,
            'jumlah_lulus_ts' => $request->jumlah_lulus_ts,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);


        return redirect()->route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_edit(tabelC9 $tabelC9, $id)
    {
       $item =  tabelK9masaStudi::findorfail($id);
        return view('kriteria.c9.masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.form', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_update(Request $request, tabelC9 $tabelC9, $id)
    {
      $request->validate([
          'jumlah_diterima' => 'required|integer',
          'jumlah_lulus_ts_6' => 'required|integer',
          'jumlah_lulus_ts_5' => 'required|integer',
          'jumlah_lulus_ts_4' => 'required|integer',
          'jumlah_lulus_ts_3' => 'required|integer',
          'jumlah_lulus_ts_2' => 'required|integer',
          'jumlah_lulus_ts_1' => 'required|integer',
          'jumlah_lulus_ts' => 'required|integer',
          'tautan' => 'nullable',
      ]);

      // Temukan record berdasarkan ID dan prodi_id dari user yang sedang login
 $record = tabelK9masaStudi::where('id', $id)
             ->where('prodi_id', Auth::user()->prodi->id)
             ->firstOrFail();

 // Update record dengan data dari request
 $record->update([
     'jumlah_diterima' => $request->jumlah_diterima,
     'jumlah_lulus_ts_6' => $request->jumlah_lulus_ts_6,
     'jumlah_lulus_ts_5' => $request->jumlah_lulus_ts_5,
     'jumlah_lulus_ts_4' => $request->jumlah_lulus_ts_4,
     'jumlah_lulus_ts_3' => $request->jumlah_lulus_ts_3,
     'jumlah_lulus_ts_2' => $request->jumlah_lulus_ts_2,
     'jumlah_lulus_ts_1' => $request->jumlah_lulus_ts_1,
     'jumlah_lulus_ts' => $request->jumlah_lulus_ts,
     'tautan' => $request->tautan,
 ]);

 // Redirect ke halaman index dengan pesan sukses
 return redirect()->route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi_destroy(tabelC9 $tabelC9, $id)
    {
      // Temukan record berdasarkan ID dan prodi_id dari user yang sedang login
      $record = tabelK9masaStudi::where('id', $id)
                  ->where('prodi_id', Auth::user()->prodi->id)
                  ->firstOrFail();

      // Hapus record
      $record->delete();

      // Redirect ke halaman index dengan pesan sukses
      return redirect()->route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index')->with('success', 'Data Berhasil Dihapus');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_index()
    {
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9TracerStudi::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9TracerStudi::where('prodi_id', Auth::user()->prodi->id)->orderBy('tahun_lulus', 'desc')->get();
        }

        return view('kriteria.c9.tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_create()
    {
        return view('kriteria.c9.tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_store(Request $request)
    {
        $request->validate([
            'tahun_lulus' => 'required|integer',
            'jumlah_lulusan' => 'required|integer',
            'jumlah_terlacak' => 'required|integer',
            'waktu_tunggu_wt3' => 'required|integer',
            'waktu_tunggu_wt36' => 'required|integer',
            'waktu_tunggu_wt612' => 'required|integer',
            'waktu_tunggu_wt12' => 'required|integer',
            'tautan' => 'nullable',
        ]);


        TabelK9TracerStudi::create([
            'tahun_lulus' => $request->tahun_lulus,
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'jumlah_terlacak' => $request->jumlah_terlacak,
            'waktu_tunggu_wt3' => $request->waktu_tunggu_wt3,
            'waktu_tunggu_wt36' => $request->waktu_tunggu_wt36,
            'waktu_tunggu_wt612' => $request->waktu_tunggu_wt612,
            'waktu_tunggu_wt12' => $request->waktu_tunggu_wt12,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);

        return redirect()->route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_edit(tabelC9 $tabelC9,$id)
    {
        $item = TabelK9TracerStudi::findorfail($id);
        return view('kriteria.c9.tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.form', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_update(Request $request, tabelC9 $tabelC9,$id)
    {

        $request->validate([
            'jumlah_lulusan' => 'required|integer',
            'jumlah_terlacak' => 'required|integer',
            'waktu_tunggu_wt3' => 'required|integer',
            'waktu_tunggu_wt36' => 'required|integer',
            'waktu_tunggu_wt612' => 'required|integer',
            'waktu_tunggu_wt12' => 'required|integer',
            'tautan' => 'nullable',
        ]);

        TabelK9TracerStudi::findorfail($id)->update([
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'jumlah_terlacak' => $request->jumlah_terlacak,
            'waktu_tunggu_wt3' => $request->waktu_tunggu_wt3,
            'waktu_tunggu_wt36' => $request->waktu_tunggu_wt36,
            'waktu_tunggu_wt612' => $request->waktu_tunggu_wt612,
            'waktu_tunggu_wt12' => $request->waktu_tunggu_wt12,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama_destroy(tabelC9 $tabelC9,$id)
    {
        TabelK9TracerStudi::findorfail($id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_index()
    {
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9RelevansiPekerjaan::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9RelevansiPekerjaan::where('prodi_id', Auth::user()->prodi->id)->get();
        }

        return view('kriteria.c9.tingkat_relevansi_pekerjaan.index', ['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_create()
    {
        return view('kriteria.c9.tingkat_relevansi_pekerjaan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_store(Request $request)
    {
        $request->validate([
            'tahun_lulus' => 'required|integer',
            'jumlah_lulusan' => 'required|integer',
            'jumlah_terlacak' => 'required|integer',
            'relevansi_tinggi' => 'required|integer',
            'relevansi_sedang' => 'required|integer',
            'relevansi_rendah' => 'required|integer',
            'tautan' => 'nullable',
        ]);


        $data = TabelK9RelevansiPekerjaan::create([
            'tahun_lulus' => $request->tahun_lulus,
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'jumlah_terlacak' => $request->jumlah_terlacak,
            'relevansi_tinggi' => $request->relevansi_tinggi,
            'relevansi_sedang' => $request->relevansi_sedang,
            'relevansi_rendah' => $request->relevansi_rendah,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);

        return redirect()->route('tingkat_relevansi_pekerjaan.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_edit(tabelC9 $tabelC9, $id)
    {
        $data = TabelK9RelevansiPekerjaan::findorfail($id);
        return view('kriteria.c9.tingkat_relevansi_pekerjaan.form', ['item' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_update(Request $request, tabelC9 $tabelC9, $id)
    {

        $request->validate([
            'jumlah_lulusan' => 'required|integer',
            'jumlah_terlacak' => 'required|integer',
            'relevansi_tinggi' => 'required|integer',
            'relevansi_sedang' => 'required|integer',
            'relevansi_rendah' => 'required|integer',
            'tautan' => 'nullable',
        ]);


        $data = TabelK9RelevansiPekerjaan::where('id', $id)->update([
            'jumlah_lulusan' => $request->jumlah_lulusan,
            'jumlah_terlacak' => $request->jumlah_terlacak,
            'relevansi_tinggi' => $request->relevansi_tinggi,
            'relevansi_sedang' => $request->relevansi_sedang,
            'relevansi_rendah' => $request->relevansi_rendah,
            'tautan' => $request->tautan,
        ]);


        return redirect()->route('tingkat_relevansi_pekerjaan.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_relevansi_pekerjaan_destroy(tabelC9 $tabelC9,$id)
    {
        TabelK9RelevansiPekerjaan::findorfail($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_index()
    {
        // $items = tabelC9::where('kriteria', 'Tingkat Kepuasan Pengguna Lulusan')->get();
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9KepuasanPengguna::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9KepuasanPengguna::where('prodi_id', Auth::user()->prodi->id)->get();
        }

        return view('kriteria.c9.tingkat_kepuasan_pengguna_lulusan.index',['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_create()
    {
        $item_kemampuan = [
            'Etika berperilaku',
            'Kinerja yang terkait dengan kompetensi utama',
            'Kemampuan bekerja dalam tim',
            'Kemampuan berkomunikasi',
            'Kemampuan berbahasa Inggris',
            'Upaya pengembangan diri',
        ];

        return view('kriteria.c9.tingkat_kepuasan_pengguna_lulusan.form',['item_kemampuan' => $item_kemampuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'jenis_kemampuan' => 'required',
            'sangat_baik' => 'required',
            'baik' => 'required',
            'cukup' => 'required',
            'kurang' => 'required',
            'tindak_lanjut' => 'required',
            'tautan' => 'nullable',
        ]);

        // Add 'prodi_id' to the validated data
        $validatedData['prodi_id'] = Auth::user()->prodi->id;

        // Create a new record using the validated data
        TabelK9KepuasanPengguna::create($validatedData);

        // Redirect to the index page after successful insertion
        return redirect()->route('tingkat_kepuasan_pengguna_lulusan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_edit(tabelC9 $tabelC9, $id)
    {
        $item_kemampuan = [
            'Etika berperilaku',
            'Kinerja yang terkait dengan kompetensi utama',
            'Kemampuan bekerja dalam tim',
            'Kemampuan berkomunikasi',
            'Kemampuan berbahasa Inggris',
            'Upaya pengembangan diri',
        ];

        $item = TabelK9KepuasanPengguna::findorfail($id);

        return view('kriteria.c9.tingkat_kepuasan_pengguna_lulusan.form', ['item' => $item,'item_kemampuan' => $item_kemampuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'jenis_kemampuan' => 'required',
            'sangat_baik' => 'required',
            'baik' => 'required',
            'cukup' => 'required',
            'kurang' => 'required',
            'tindak_lanjut' => 'required',
            'tautan' => 'nullable',
        ]);

        // Find the record based on the $id
        $tabelC9 = TabelK9KepuasanPengguna::find($id);

        if (!$tabelC9) {
            return redirect()->route('tingkat_kepuasan_pengguna_lulusan.index')->with('error', 'Data not found');
        }

        // Update the data based on the validated input
        $tabelC9->update($validatedData);

        // Redirect to the index page after updating
        return redirect()->route('tingkat_kepuasan_pengguna_lulusan.index')->with('success', 'Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function tingkat_kepuasan_pengguna_lulusan_destroy(TabelK9KepuasanPengguna $tabelC9, $id)
    {
        $tabelC9::findorfail($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_index()
    {

        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9Publikasi::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9Publikasi::where('prodi_id', Auth::user()->prodi->id)->get();
        }

        return view('kriteria.c9.publikasi_dtps_dan_mahasiswa.index',['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_create()
    {
        $jenis = [
           ' Artikel di jurnal nasional ber-ISSN',
            'Artikel di jurnal nasional terakreditasi Kemdikbud/Ristek-BRIN',
            'Artikel di jurnal internasional',
            'Artikel di jurnal internasional bereputasi',
            'Artikel dalam prosiding seminar lokal/perguruan tinggi',
            'Artikel dalam prosiding seminar nasional',
            'Artikel dalam prosiding seminar internasional',
            'Tulisan di media massa lokal atau wilayah',
            'Tulisan di media massa nasional',
            'Tulisan di media massa internasional',
            'Pameran/pagelaran tingkat lokal/wilayah/perguruan tinggi',
            'Pameran/pagelaran tingkat nasional',
            'Pameran/pagelaran tingkat nasional'
        ];

        return view('kriteria.c9.publikasi_dtps_dan_mahasiswa.form', ['jenis_publikasi' => $jenis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'jumlah_ts_2' => 'required|integer',
            'jumlah_ts_1' => 'required|integer',
            'jumlah_ts' => 'required|integer',
        ]);


        $cek_data = TabelK9Publikasi::where('prodi_id', Auth::user()->prodi->id)
                    ->where('jenis', $request->jenis)
                    ->exists();

        if ($cek_data) {
            return redirect()->back()->with('error', $request->jenis.' sudah ada')->withInput();
        }


        $data = new TabelK9Publikasi();
        $data->jenis = $request->jenis;
        $data->jumlah_ts_2 = $request->jumlah_ts_2;
        $data->jumlah_ts_1 = $request->jumlah_ts_1;
        $data->jumlah_ts = $request->jumlah_ts;
        $data->jumlah = $request->jumlah_ts_2 + $request->jumlah_ts_1 + $request->jumlah_ts;
        $data->tautan = $request->tautan;
        $data->prodi_id = Auth::user()->prodi->id;
        $data->save();


        return redirect()->route('publikasi_dtps_dan_mahasiswa.index')->with('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_edit(tabelK9Publikasi $modul, $id)
    {
        $jenis = [
           ' Artikel di jurnal nasional ber-ISSN',
            'Artikel di jurnal nasional terakreditasi Kemdikbud/Ristek-BRIN',
            'Artikel di jurnal internasional',
            'Artikel di jurnal internasional bereputasi',
            'Artikel dalam prosiding seminar lokal/perguruan tinggi',
            'Artikel dalam prosiding seminar nasional',
            'Artikel dalam prosiding seminar internasional',
            'Tulisan di media massa lokal atau wilayah',
            'Tulisan di media massa nasional',
            'Tulisan di media massa internasional',
            'Pameran/pagelaran tingkat lokal/wilayah/perguruan tinggi',
            'Pameran/pagelaran tingkat nasional',
            'Pameran/pagelaran tingkat nasional'
        ];

        $item = TabelK9Publikasi::findorfail($id);

        return view('kriteria.c9.publikasi_dtps_dan_mahasiswa.form',['jenis_publikasi' => $jenis, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_update(Request $request, tabelK9Publikasi $tabelC9, $id)
    {
        $request->validate([
            // 'jenis' => 'required',
            'jumlah_ts_2' => 'required|integer',
            'jumlah_ts_1' => 'required|integer',
            'jumlah_ts' => 'required|integer',
            'tautan' => 'nullable',
        ]);

        // dd($request->tautan);

        tabelK9Publikasi::findorfail($id)->update([
            // 'jenis' => $request->jenis,
            'jumlah_ts_2' => $request->jumlah_ts_2,
            'jumlah_ts_1' => $request->jumlah_ts_1,
            'jumlah_ts' => $request->jumlah_ts,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('publikasi_dtps_dan_mahasiswa.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function publikasi_dtps_dan_mahasiswa_destroy($id)
    {
        TabelK9Publikasi::findorfail($id)->delete();
        return redirect()->route('publikasi_dtps_dan_mahasiswa.index')->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_index()
    {
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9KaryaDisitasi::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9KaryaDisitasi::where('prodi_id', Auth::user()->prodi->id)->orderBy('tahun', 'desc')->get();
        }

        return view('kriteria.c9.karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_create()
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);
        return view('kriteria.c9.karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi.form', ['dosens' => $dataDosen]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_store(Request $request)
    {
        $request->validate([
            'penulis_dosen_id' => 'required',
            'penulis_mahasiswa' => 'required',
            'judul' => 'required',
            'tahun' => 'required|numeric',
            'nama_penerbit' => 'required',
            'nomor_halaman' => 'required',
            'jumlah_sitasi' => 'required|numeric',
            'tautan' => 'nullable',
        ]);

        TabelK9KaryaDisitasi::create([
            'penulis_dosen_id' => $request->penulis_dosen_id,
            'penulis_mahasiswa' => $request->penulis_mahasiswa,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'nama_penerbit' => $request->nama_penerbit,
            'nomor_halaman' => $request->nomor_halaman,
            'jumlah_sitasi' => $request->jumlah_sitasi,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);


        return redirect()->route('karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_edit(tabelC9 $tabelC9,$id)
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);

        $data_edit = TabelK9KaryaDisitasi::findorfail($id);

        return view('kriteria.c9.karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi.form', ['dosens' => $dataDosen, 'item' => $data_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_update(Request $request, tabelC9 $tabelC9,$id)
    {
        $request->validate([
            'penulis_dosen_id' => 'required',
            'penulis_mahasiswa' => 'required',
            'judul' => 'required',
            'tahun' => 'required|numeric',
            'nama_penerbit' => 'required',
            'nomor_halaman' => 'required',
            'jumlah_sitasi' => 'required|numeric',
            'tautan' => 'nullable',
        ]);

        // dd("berhasil");


        $data = TabelK9KaryaDisitasi::findorfail($id);
        $data->penulis_dosen_id = $request->penulis_dosen_id;
        $data->penulis_mahasiswa = $request->penulis_mahasiswa;
        $data->judul = $request->judul;
        $data->tahun = $request->tahun;
        $data->nama_penerbit = $request->nama_penerbit;
        $data->nomor_halaman = $request->nomor_halaman;
        $data->jumlah_sitasi = $request->jumlah_sitasi;
        $data->tautan = $request->tautan;
        $data->save();

        return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi_destroy(tabelC9 $tabelC9, $id)
    {
        TabelK9KaryaDisitasi::findorfail($id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_index()
    {
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9Produk::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9Produk::where('prodi_id', Auth::user()->prodi->id)->orderBy('dosen_id', 'asc')->get();
        }

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.index',['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_create()
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.form',['dosens' => $dataDosen]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:tabel_dosen,nidn_nidk',
            'nama_mahasiswa' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tautan' => 'nullable',
        ]);


        TabelK9Produk::create([
            'prodi_id' => Auth::user()->prodi->id,
            'dosen_id' => $request->dosen_id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_edit(tabelC9 $tabelC9, $id)
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);

        $dataEdit =  TabelK9Produk::findorfail($id);

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.form', ['dosens' => $dataDosen, 'item' => $dataEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_update(Request $request, tabelC9 $tabelC9, $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:tabel_dosen,nidn_nidk',
            'nama_mahasiswa' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tautan' => 'nullable',
        ]);


        TabelK9Produk::where('id', $id)->update([
            'dosen_id' => $request->dosen_id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat_destroy(tabelC9 $tabelC9, $id)
    {
        TabelK9Produk::where('id', $id)->delete();

        return redirect()->route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.index')->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_index()
    {
        if(Auth::user()->role == 'fakultas'){
        $data = TabelK9ProdukHki::where('prodi_id', $this->akunController->get_session_prodi_by_fakultas())->get();
        }else{
        $data = TabelK9ProdukHki::where('prodi_id', Auth::user()->prodi->id)->orderBy('tahun', 'desc')->get();
        }

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.index',['items' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_create()
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.form',['dosens' => $dataDosen]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required',
            'nama_mahasiswa' => 'required',
            'identitas_produk' => 'required',
            'tahun' => 'required|numeric',
            'tautan' => 'nullable',
        ]);

        TabelK9ProdukHki::create([
            'dosen_id' => $request->dosen_id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'identitas_produk' => $request->identitas_produk,
            'tahun' => $request->tahun,
            'tautan' => $request->tautan,
            'prodi_id' => Auth::user()->prodi->id,
        ]);



        return redirect()->route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_edit(tabelC9 $tabelC9,$id)
    {
        $dosenController = new DosenController();
        $dataDosen = $dosenController->getSemuaDosenProdi(Auth::user()->prodi->id);

        $dataEdit = TabelK9ProdukHki::findorfail($id);

        return view('kriteria.c9.produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.form', ['dosens' => $dataDosen, 'item' => $dataEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_update(Request $request, tabelC9 $tabelC9,$id)
    {
        $request->validate([
            'dosen_id' => 'required',
            'nama_mahasiswa' => 'required',
            'identitas_produk' => 'required',
            'tahun' => 'required|numeric',
            'tautan' => 'nullable',
        ]);

        TabelK9ProdukHki::where('id', $id)->update([
            'dosen_id' => $request->dosen_id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'identitas_produk' => $request->identitas_produk,
            'tahun' => $request->tahun,
            'tautan' => $request->tautan,
        ]);

        return redirect()->route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tabelC9  $tabelC9
     * @return \Illuminate\Http\Response
     */
    public function produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten_destroy(tabelC9 $tabelC9, $id)
    {
        TabelK9ProdukHki::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }

}
