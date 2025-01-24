@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif LED</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.4 Sumber Daya Manusia</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Rasio DTPS terhadap Mahasiswa Reguler</h5>
          
          @if(session('info'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('info') }} Silakan <a href="/dashboard">klik disini.</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th rowspan="2"><a href="/kriteria4/dtps_bidang_Keahlian_sesuai_dengan_bidang_ps">Jumlah DTPS</a> </th>
                  <th rowspan="2"><a href="/kriteria3/mahasiswa_reguler">Jumlah Mahasiswa Reguler</a> </th>
                  <th colspan="2">Rasio Dosen:Mahasiswa</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>{{ $jumlah_dtps }}</td>
                  <td>{{ $Jumlah_mhs_reguler }}</td>
                  <td>{{ (($jumlah_dtps && $Jumlah_mhs_reguler) > 0) ? $Jumlah_mhs_reguler/$jumlah_dtps : '0' }}</td>
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
