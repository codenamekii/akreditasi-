@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 Produk Atau Jasa DTPS Dan/Atau Mahasiswa Yang Ber-HKI Atau Paten</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.update', ['id' => $item->id])  : route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.store')}}" method="post">
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

            Produk Atau Jasa DTPS Dan/Atau Mahasiswa Yang Ber-HKI Atau Paten</h4>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Periksa kembali inputan anda
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif


          <hr>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Dosen</label>
            <div class="col-sm-9">
              <select class="form-control @error('dosen_id') is-invalid @enderror" name="dosen_id">
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                  <option value="{{ $dosen->nidn_nidk }}" {{ (isset($item) && $item->dosen_id  == $dosen->nidn_nidk) ? 'selected' : '' }}>{{ $dosen->nidn_nidk }} | {{ $dosen->nama }}</option>
                @endforeach
              </select>
              @error('dosen_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-9">
              <input type="text" name="nama_mahasiswa" value="{{ isset($item->nama_mahasiswa) ? $item->nama_mahasiswa : old('nama_mahasiswa') }}" class="form-control @error('nama_mahasiswa') is-invalid @enderror" placeholder="Ketik disini">
              @error('nama_mahasiswa')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Identitas Produk/Jasa</label>
            <div class="col-sm-9">
              <input type="text" name="identitas_produk" value="{{ isset($item->identitas_produk) ? $item->identitas_produk : old('identitas_produk') }}" class="form-control @error('identitas_produk') is-invalid @enderror" placeholder="Ketik disini">
              @error('identitas_produk')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tahun (YYYY)</label>
            <div class="col-sm-9">
              <input type="number" name="tahun" value="{{ isset($item->tahun) ? $item->tahun : old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror" placeholder="Ketik disini">
              @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
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
