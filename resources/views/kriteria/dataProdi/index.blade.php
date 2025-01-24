@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/dataprodi/edit">
        @if(auth()->user()->role == 'admin prodi')
          <button  type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-2 ">Ubah Data Program Studi</button>
        @endif
      </a>
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
        <div class="card">
          <div class="card-body">
            @if(session('success'))
            @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                
              </div>
            @endif
            @endif
            <h4 class="card-title">Data Program Studi</h4>
            <!-- <p class="card-description"> Add class <code>.table</code> -->
            </p>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="font-weight:bold">Jenis program</td>
                    <td {{!empty($prodi->jenis) ? '' : 'style=color:red;'}}>{{empty($prodi->jenis) ? 'data belum di isi' : $prodi->jenis }}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Nama program studi</td>
                    <td {{!empty($prodi->nama) ? '' : 'style=color:red;'}}>{{empty($prodi->nama) ? 'data belum di isi' : $prodi->nama}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Status/Peringkat</td>
                    <td {{!empty($prodi->status_peringkat) ? '' : 'style=color:red;'}}>{{empty($prodi->status_peringkat) ? 'data belum di isi' : $prodi->status_peringkat}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Nomor SK</td>
                    <td {{!empty($prodi->nomor_sk) ? '' : 'style=color:red;'}}>{{empty($prodi->nomor_sk) ? 'data belum di isi' : $prodi->nomor_sk}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Tanggal SK</td>
                    <td {{!empty($prodi->tanggal_sk) ? '' : 'style=color:red;'}}>{{empty($prodi->tanggal_sk) ? 'data belum di isi' : $prodi->tanggal_sk}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Tgl. Kadaluarsa</td>
                    <td {{!empty($prodi->tanggal_kadaluarsa) ? '' : 'style=color:red;'}}>{{empty($prodi->tanggal_kadaluarsa) ? 'data belum di isi' : $prodi->tanggal_kadaluarsa}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Jumlah Mahasiswa saat TS</td>
                    <td {{!empty($prodi->jumlah_mhs_ts) ? '' : 'style=color:red;'}}>{{empty($prodi->jumlah_mhs_ts) ? 'data belum di isi' : $prodi->jumlah_mhs_ts}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Jumlah DTPS saat TS</td>
                    <td {{!empty($prodi->jumlah_dtps_ts) ? '' : 'style=color:red;'}}>{{empty($prodi->jumlah_dtps_ts) ? 'data belum di isi' : $prodi->jumlah_dtps_ts}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Rerata IPK</td>
                    <td {{!empty($prodi->rerata_ipk) ? '' : 'style=color:red;'}}>{{empty($prodi->rerata_ipk) ? 'data belum di isi' : $prodi->rerata_ipk}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold">Rerata masa studi</td>
                    <td {{!empty($prodi->rerata_masa_studi) ? '' : 'style=color:red;'}}>{{empty($prodi->rerata_masa_studi) ? 'data belum di isi' : $prodi->rerata_masa_studi}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- last row starts here -->

  </div>
  @endsection
