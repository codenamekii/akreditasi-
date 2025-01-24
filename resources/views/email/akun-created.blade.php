<!-- resources/views/emails/akun-created.blade.php -->

<h1>Akun Anda Telah Dibuat</h1>

<p>Selamat, akun Anda telah berhasil dibuat!</p>

<p>Nama Akun: {{ $akun['name'] }}</p>
<p>Email: {{ $akun['email'] }}</p>

<p>Silakan login untuk mengakses akun Anda.</p>