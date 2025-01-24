@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('tingkat_relevansi_pekerjaan.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 tingkat relevansi pekerjaan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('tingkat_relevansi_pekerjaan.update', ['id' => $item->id])  : route('tingkat_relevansi_pekerjaan.store')}}" method="post">
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

            tingkat relevansi pekerjaan</h4>

           @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Periksa kembali inputan anda
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif


          <hr>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tahun Lulus</label>
            <div class="col-sm-9">
              <input type="text" name="tahun_lulus" value="{{ isset($item->tahun_lulus) ? $item->tahun_lulus : old('tahun_lulus') }}" class="form-control @error('tahun_lulus') is-invalid @enderror" placeholder="Ketik disini" @if(isset($item)) disabled @endif>
              @error('tahun_lulus')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_lulusan" value="{{ isset($item->jumlah_lulusan) ? $item->jumlah_lulusan : old('jumlah_lulusan') }}" class="form-control @error('jumlah_lulusan') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_lulusan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Yang Terlacak</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_terlacak" value="{{ isset($item->jumlah_terlacak) ? $item->jumlah_terlacak : old('jumlah_terlacak') }}" class="form-control @error('jumlah_terlacak') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_terlacak')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Terlacak Dengan Tingkat Relevansi Bidang Kerja (Tinggi,	Sedang,	Rendah)</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" name="relevansi_tinggi" value="{{ isset($item->relevansi_tinggi) ? $item->relevansi_tinggi : old('relevansi_tinggi') }}" class="form-control @error('relevansi_tinggi') is-invalid @enderror" placeholder="Tinggi">
                <input type="text" name="relevansi_sedang" value="{{ isset($item->relevansi_sedang) ? $item->relevansi_sedang : old('relevansi_sedang') }}" class="form-control @error('relevansi_sedang') is-invalid @enderror" placeholder="Sedang">
                <input type="text" name="relevansi_rendah" value="{{ isset($item->relevansi_rendah) ? $item->relevansi_rendah : old('relevansi_rendah') }}" class="form-control @error('relevansi_rendah') is-invalid @enderror" placeholder="Rendah">
              </div>
              @error('relevansi_tinggi')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              @error('relevansi_sedang')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              @error('relevansi_rendah')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan</label>
            <div class="col-sm-9">
              <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control @error('tautan') is-invalid @enderror" placeholder="Ketik disini">
              @error('tautan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


          </div>

          <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="button" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">
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
    document.getElementById('nilai2').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
    document.getElementById('nilai1').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
    document.getElementById('nilai').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
</script>

  @endsection
