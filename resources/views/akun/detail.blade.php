@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <!-- <button class="btn btn-primary mb-2 mb-md-0 mr-2"> Tambah data </button> -->
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Akun</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Detail Akun</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Detail data</h5>
          <table class="table">
            <tbody>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td>s</td>
              </tr>
              <tr>
                <td>NIDN/NUPTK</td>
                <td>:</td>
                <td>s</td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>s</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Detail status</h5>
          <table class="table">
            <tbody>
              <tr>
                <td>Username</td>
                <td>:</td>
                <td>s</td>
              </tr>
              <tr>
                <td>Password</td>
                <td>:</td>
                <td>s</td>
              </tr>
              <tr>
                <td>Level</td>
                <td>:</td>
                <td>s</td>
              </tr>
            </tbody>
          </table>
          <a href="#" class="btn btn-primary">Edit</a>
        </div>
      </div>
    </div>

  </div>
  <!-- last row starts here -->

</div>
@endsection
