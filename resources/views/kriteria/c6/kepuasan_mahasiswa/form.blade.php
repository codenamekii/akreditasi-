@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('kepuasan_mahasiswa.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.6 Kepuasan Mahasiswa</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('kepuasan_mahasiswa.update', ['id' => Crypt::encryptString($item->id)])  : route('kepuasan_mahasiswa.store')}}" method="post">
        @if(isset($item->id))
          @method('PUT')
        @endif  
        @csrf
        <div class="card-body">
          <h4 class="card-title">
            @if (Request::segment(3) === 'create')
            Tambah data
            @elseif (Request::segment(4) === 'edit')
            Edit data
            @endif

            Kepuasan Mahasiswa</h4>

          @if ($errors->any())
              <div>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li style="color: red;">{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
          <hr>

          <div class="form-group row">
  <label class="col-sm-3 col-form-label">Aspek Pengukuran Kepuasan</label>
  <div class="col-sm-9">
    <input type="text" name="aspek" value="{{ isset($item->aspek) ? $item->aspek : old('aspek') }}" class="form-control @error('aspek') is-invalid @enderror" placeholder="Ketik disini">
    @error('aspek')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Objek Kepuasan Mahasiswa</label>
  <div class="col-sm-9">
    <div class="row">
      <div class="col">
        <label for="kinerja_mengajar">Kinerja Mengajar PS</label>
        <input type="number" step="0.01" id="kinerja_mengajar" name="kinerja_mengajar" value="{{ isset($item->kinerja_mengajar) ? $item->kinerja_mengajar : old('jumlah_ps_lain_ts2') }}" class="form-control @error('kinerja_mengajar') is-invalid @enderror" placeholder="Ketik disini">
        @error('kinerja_mengajar')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="layanan_administrasi_ps">Layanan Administrasi Akademik</label>
        <input type="number" step="0.01" id="layanan_administrasi_ps" name="layanan_administrasi_ps" value="{{ isset($item->layanan_administrasi_ps) ? $item->layanan_administrasi_ps : old('jumlah_ps_lain_ts1') }}" class="form-control @error('layanan_administrasi_ps') is-invalid @enderror" placeholder="Ketik disini">
        @error('layanan_administrasi_ps')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="sarana_prasarana_ps">Sarana Prasarana PS</label>
        <input type="number" step="0.01" id="sarana_prasarana_ps" name="sarana_prasarana_ps" value="{{ isset($item->sarana_prasarana_ps) ? $item->sarana_prasarana_ps : old('jumlah_ps_sendiri_ts') }}" class="form-control @error('sarana_prasarana_ps') is-invalid @enderror" placeholder="Ketik disini">
        @error('sarana_prasarana_ps')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Tindak Lanjut</label>
  <div class="col-sm-9">
    <input type="text" name="tindak_lanjut" value="{{ isset($item->tindak_lanjut) ? $item->tindak_lanjut : old('tindak_lanjut') }}" class="form-control @error('tindak_lanjut') is-invalid @enderror" placeholder="Ketik disini">
    @error('tindak_lanjut')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan</label>
            <div class="col-sm-9">
              <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control" placeholder="Ketik disini">
            </div>
          </div>


          </div>

          <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="button">
              @if (Request::segment(3) === 'create')
              Tambah data
              @elseif (Request::segment(4) === 'edit')
              Update data
              @endif
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- last row starts here -->

  </div>
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const inputs = document.querySelectorAll('input[type="number"]');
        inputs.forEach(input => {
            input.addEventListener('input', (e) => {
                if (!/^\d*\.?\d*$/.test(e.target.value)) {
                    e.target.value = e.target.value.slice(0, -1);
                }
            });
        });
    });
  </script>


  @endsection

