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
          <p class="m-0">Data Keuangan</p>
        </a>
      </div>
      <!-- <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
      <i class="mdi mdi-plus-circle"></i> Add Prodcut </button> -->
    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">

        <form class="card" action="{{isset($item->id) ?  route('datakeuangan.update', ['id' => Crypt::encryptString($item->id)])  : route('datakeuangan.store')}}" method="post">
          @if(isset($item->id))
          @method('PUT')
          @endif

        <div class="card-body">
          <h4 class="card-title">
            @if (Request::segment(2) === 'create')
            Tambah data
            @elseif (Request::segment(2) === 'edit')
            Edit data
            @endif
            - Kuantitatif Di Unit Pengelola Program Studi (UPPS) - Keuangan</h4>
          <!-- <p class="card-description"> Add class <code>.table</code> -->
          @csrf

          @if ($errors->any())
            <div>
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
            <thead>
              <tr >
                <th style="font-weight:bold">Item</th>
                <th style="font-weight:bold">Data</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight:bold">Tahun akademik</td>
                <td >
                  <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun akademik" @if(isset($item->id)) value="{{$item->tahun}}" @else value="{{old('tahun')}}" @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">Pendidikan/mahasiswa/tahun</td>
                <td>
                  <input type="number" class="form-control" name="pendidikan_per_mahasiswa" id="" placeholder="Pendidikan/mahasiswa/tahun" @if(isset($item->id)) value="{{$item->pendidikan_per_mahasiswa}}" @else value="{{old('pendidikan_per_mahasiswa')}}"  @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">Penelitian/dosen/tahun</td>
                <td>
                  <input type="number" class="form-control" name="penelitian_per_dosen" id="" placeholder="Ketik Penelitian/dosen/tahun" @if(isset($item->id)) value="{{$item->penelitian_per_dosen}}" @else value="{{old('penelitian_per_dosen')}}"  @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">PKM/dosen/tahun</td>
                <td>
                  <input type="number" class="form-control" name="pkm_per_dosen" id="" placeholder="Ketik PKM/dosen/tahun" @if(isset($item->id)) value="{{$item->pkm_per_dosen}}" @else value="{{old('pkm_per_dosen')}}"  @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">Publikasi/dosen/tahun</td>
                <td>
                  <input type="number" class="form-control" name="publikasi_per_dosen" id="" placeholder="Ketik Publikasi/dosen/tahun" @if(isset($item->id)) value="{{$item->publikasi_per_dosen}}" @else value="{{old('pkm_per_dosen')}}" @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">Investasi/tahun</td>
                <td>
                  <input type="text" class="form-control" id="rupiahAmount" name="investasi" placeholder="Masukkan jumlah investasi" oninput="formatRupiah(this)"  @if(isset($item->id)) value="{{number_format($item->investasi)}}" @else value="{{old('investasi')}}" @endif>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold">Bukti/Tautan</td>
                <td>
                  <input type="text" class="form-control" name="tautan" id="" placeholder="Belum di isi" @if(isset($item->id)) value="{{$item->tautan}}" @else value="{{old('tautan')}}" @endif>
                </td>
              </tr>
              <tr>
                <td >
                  <button type="submit" class="btn btn-primary mr-2"> Submit</button>
                </td>
                <td>
                  <a href="/datakeuangan" class="btn btn-light">
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

<script>
    function formatRupiah(input) {
        // Hapus karakter selain angka
        var value = input.value.replace(/\D/g, '');

        // Tambahkan titik sebagai pemisah ribuan
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Tampilkan hasil format di dalam input
        input.value = value;
    }
</script>
@endsection
