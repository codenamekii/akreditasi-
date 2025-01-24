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
          <p class="m-0 pr-3">Menu</p>
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
      <form class="card" action="{{ route('dataprodi.update', ['id' => Crypt::encryptString($item->id)]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
          <h4 class="card-title">Data Program Studi</h4>
          <!-- <p class="card-description"> Add class <code>.table</code> -->
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
        </p>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td style="font-weight:bold">Jenis program</td>
                <td>
                  <div class="form-group row" style="margin: 0px; padding:0px;">
                    <div class="col">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="jenis" id="jenis" value="S1" @if($item->jenis == 'S1') checked @endif > Sarjana <i class="input-helper"></i></label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis" id="jenis" value="S2" @if($item->jenis == 'S2') checked @endif> Magister <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jenis" id="jenis" value="S3" @if($item->jenis == 'S3') checked @endif> Doktor <i class="input-helper"></i></label>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Nama program studi</td>
                      <td>
                        <input type="text" name="nama" class="form-control" id="exampleInputUsername1" placeholder="Ketik Nama program studi" value="{{$item->nama}}">
                      </td>
                    </tr>
                    <tr>
                      <td style="font-weight:bold">Status/Peringkat</td>
                      <td>
                        <div class="form-group row" style="margin: 0px; padding:0px;">
                          <div class="col">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="C" @if($item->status_peringkat == 'C') checked @endif> C <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="B" @if($item->status_peringkat == 'B') checked @endif> B <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="A" @if($item->status_peringkat == 'A') checked @endif> A <i class="input-helper"></i></label>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="BAIK" @if($item->status_peringkat == 'BAIK') checked @endif> BAIK <i class="input-helper"></i></label>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="BAIK SEKALI" @if($item->status_peringkat == 'BAIK SEKALI') checked @endif> BAIK SEKALI <i class="input-helper"></i></label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="status_peringkat" id="status_peringkat" value="UNGGUL" @if($item->status_peringkat == 'UNGGUL') checked @endif> UNGGUL <i class="input-helper"></i></label>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Nomor SK</td>
                                  <td><input type="text" name="nomor_sk" class="form-control {{ $errors->has('nomor_sk') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Nomor SK" value="{{$item->nomor_sk}}"></td>
                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Tanggal SK</td>
                                  <td><input type="date" name="tanggal_sk" class="form-control {{ $errors->has('tanggal_sk') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Ketik Tanggal SK" value="{{$item->tanggal_sk}}"></td>
                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Tgl. Kadaluarsa</td>
                                  <td><input type="date" name="tanggal_kadaluarsa" class="form-control {{ $errors->has('tanggal_kadaluarsa') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Tanggal Kadaluarsa" value="{{$item->tanggal_kadaluarsa}}"></td>
                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Jumlah Mahasiswa saat TS</td>
                                  <td><input type="text" name="jumlah_mhs_ts" class="form-control {{$errors->has('jumlah_mhs_ts') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Jumlah Mahasiswa saat TS" value="{{$item->jumlah_mhs_ts}}"></td>
                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Jumlah DTPS saat TS</td>
                                  <td><input type="text" name="jumlah_dtps_ts" class="form-control {{$errors->has('jumlah_dtps_ts') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Jumlah DTPS saat TS" value="{{$item->jumlah_dtps_ts}}"></td>

                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Rerata IPK</td>
                                  <td><input type="text" name="rerata_ipk" class="form-control {{$errors->has('rerata_ipk') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Rerata IPK" value="{{$item->rerata_ipk}}"></td>

                                </tr>
                                <tr>
                                  <td style="font-weight:bold">Rerata masa studi</td>
                                  <td><input type="text" name="rerata_masa_studi" class="form-control {{$errors->has('rerata_masa_studi') ? 'is-invalid' : '' }}" id="exampleInputUsername1" placeholder="Ketik Rerata masa studi" value="{{$item->rerata_masa_studi}}"></td>
                                </tr>
                                @if(auth()->user()->role == 'admin prodi')
                                <tr>
                                  <td >
                                    <button type="submit" class="btn btn-primary mr-2"> Perbaharui </button>
                                  </td>
                                  <td>
                                    <a href="/dataprodi" class="btn btn-light">
                                      Cancel
                                    </a>
                                  </td>
                                </tr>
                                @endif
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
