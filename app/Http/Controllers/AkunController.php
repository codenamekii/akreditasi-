<?php

namespace App\Http\Controllers;

// controller untuk email
use App\Http\Controllers\MailController;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AkunCreated;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DataProgramStudiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    protected $prodiController;

      /**
      * Constructor for initializing the Type variable and DataProgramStudiController instance.
      *
      * @param Type $var The Type variable to initialize.
      * @param DataProgramStudiController $prodiController The DataProgramStudiController instance.
      */
    public function __construct() {
        $this->prodiController = new DataProgramStudiController();
    }


    /**
     * Displays the index page with a list of users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->role == 'fakultas') {
            $dataUser = User::where('id', '!=', 1)
            ->where('role', "!=", "asesor")
            ->where('role', '!=', 'root')
            ->whereHas('prodi', function ($query) {
                $query->where('fakultas_id', Auth::user()->prodi->fakultas_id);
            })
            ->get();
        } else {
            $dataUser = User::where('id', '!=', 1)
            ->where('prodi_id', auth()->user()->prodi->id)
            ->where('role', "!=", "fakultas")
            ->where('role', '!=', 'root')
            ->get();
        }

        if($dataUser->count() == 0) {
            return view('akun.manag_akun', compact('dataUser'))->with('info', 'Tidak ada data user.');
        }

        return view('akun.manag_akun', compact('dataUser'));
    }

    public function get_session_prodi_by_fakultas(){
        $session_prodi = null;
        if(!empty(session::has('prodi'))){
            return $session_prodi = session::get('prodi')['prodi']->id;
        }


        session()->flash('info', "Anda belum memilih prodi.");

        return $session_prodi;
    }

/**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $prodi = $this->prodiController->getSemuaProdi();
        return view('akun.form_akun', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
      // proses validasi data yang di input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin prodi,asesor',
            'prodi_id' => 'required',
        ]);

        // proses insert
        $akun = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'role' => $request->role,
                'prodi_id' => $request->prodi_id,
                ]);

        // proses mengirimkan email
        $subject = "Akun SIAKSI";
        $title = "Berhasil membuat akun baru SIAKSI";
        $body = "email = ".$validatedData['email'].' password: '.$validatedData['password'].' otorisasi: '.$validatedData['role'];
        $email = $request->email;

        $emailController = new MailController();
        $emailController->send_mail($subject,$title,$body,$email);

        // redirect
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $prodi = $this->prodiController->getSemuaProdi();
        $user = User::findOrFail($id);
        return view('akun.form_akun', compact(['user','prodi']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the account by ID
        $akun = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin prodi,asesor',
            'prodi_id' => 'required',
        ]);

        $akun->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'prodi_id' => $request->prodi_id,
        ]);


        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('akun.index')->with('success', 'Data pengguna berhasil dihapus');
        } else {
            return redirect()->route('akun.index')->with('error', 'Pengguna tidak ditemukan');
        }
    }

    public function show($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            return view('akun.detail', compact('user'));
        } else {
            return redirect()->route('dashboard.index')->with('error', 'Data pengguna tidak ditemukan');
        }
    }

    public function profil()
    {
         // Mengambil ID pengguna yang sedang login
        $id = Auth::id();

        // Mencari pengguna berdasarkan ID atau gagal jika tidak ditemukan
        $user = User::findOrFail($id);

        return view('akun.edit_profil', compact('user'));
    }

    public function profilUpdate(Request $request)
    {
          // Mengambil ID pengguna yang sedang login
        $id = Auth::id();
        // Find the account by ID
        $akun = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
        ]);

        $akun->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        return redirect()->route('akun.profil')->with('success', 'Akun berhasil diperbarui');
    }





}
