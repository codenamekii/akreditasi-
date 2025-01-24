@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <!-- <button  type="button" class="btn btn-primary mb-2 mb-md-0 mr-2 ">Ubah data program studi </button> -->
      <!-- <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button> -->
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data kuantitatif LED</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Data program studi</p>
        </a>
      </div>
      <!-- <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
      <i class="mdi mdi-plus-circle"></i> Add Prodcut </button> -->
    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <form class="card" action="#" method="GET" >
        @csrf
        <div class="card-body">
          <h4 class="card-title">Data Program Studi</h4>
          <!-- <p class="card-description"> Add class <code>.table</code> -->
        </p>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td style="font-weight:bold">Nama Program Studi</td>
                <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
              </tr>
              <tr>
                <td style="font-weight:bold">Peringkat Akreditasi PS</td>
                <td>
                  <div class="form-group row" style="margin: 0px; padding:0px;">
                    <div class="col">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value="" > C <i class="input-helper"></i></label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value=""> B <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value=""> A <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value=""> BAIK <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value=""> BAIK SEKALI <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="peringkat" id="peringkat" value=""> UNGGUL <i class="input-helper"></i></label>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Nomor SK Akreditasi</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Tanggal Kadaluwarsa</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Nama Unit Pengelola</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Nama Perguruan Tinggi</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Alamat</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Nomor Telpon</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Email</td>
                            <td><input type="email" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Website</td>
                            <td><input type="url" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">TS *)
                              <br>
                              <small style="color:red;">*) TS = Tahun akademik penuh terakhir saat pengajuan usulan akreditasi
                              </small>
                            </td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Nama Pengusul</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td style="font-weight:bold">Tanggal</td>
                            <td><input type="text" class="form-control" id="exampleInputUsername1" placeholder="Belum di isi"></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Perbaharui </button>
                              <a href="/dashboard" class="btn btn-light">
                                Cancel
                              </a>
                            </td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- last row starts here -->

          </div>
          @endsection
