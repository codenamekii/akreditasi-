<?php

namespace App\Http\Controllers;

use App\Models\autentikasi;
use App\Models\User;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AutentikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login');
    }


    public function logout()
    {
        Auth::logout();
        Session::forget('prodi');

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard.index');
        }

        return back()->withInput()->withErrors(['gagal' => 'Email atau password salah']);
    }



    public function forgot_form()
    {
      // code...
      return view('forgot_password');
    }


    public function sendResetPassword(Request $input)
    {
      // dd($input->email);

      $input->validate([
        'email' => 'required|email',
      ]);

      $password_reset = Str::random(10);

      $subject = "Reset password SIAKSI";
      $title = "Reset password akun SIAKSI";
      $body = "password baru anda : ".$password_reset;
      $email = $input->email;

      $cek_exists_email = User::where('email',$email)->first();
      if ($cek_exists_email) {
          User::where('email', $email)->update([
            'password' => bcrypt($password_reset)
          ]);

          $emailController = new MailController();
          $emailController->send_mail($subject,$title,$body,$email);
      }

      return redirect()->back()->with('info','Silahkan periksa kotak masuk email anda');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\autentikasi  $autentikasi
     * @return \Illuminate\Http\Response
     */
    public function show(autentikasi $autentikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\autentikasi  $autentikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(autentikasi $autentikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\autentikasi  $autentikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, autentikasi $autentikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\autentikasi  $autentikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(autentikasi $autentikasi)
    {
        //
    }
}
