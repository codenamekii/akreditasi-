@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria5/penggunaan_dana">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.5 Keuangan, Sarana, dan Prasarana</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('penggunaan_dana.update', ['id' => Crypt::encryptString($item->id)])  : route('penggunaan_dana.store')}}" method="post">
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

            Penggunaan Dana
          </h4>

          <p class="card-description">K.5 Investsi sarana pendidikan</p>
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
  <label class="col-sm-3 col-form-label">Jenis Penggunaan</label>
  <div class="col-sm-9">
    <select class="form-control @error('jenis_penggunaan') is-invalid @enderror" name="jenis_penggunaan">
      <option value="">Pilih</option>
      <option value="Biaya operasional pendidikan" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Biaya operasional pendidikan") selected @endif>
        Biaya operasional pendidikan</option>
      <option value="Biaya kegiatan penelitian" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "") selected @endif>
        Biaya kegiatan penelitian</option>
      <option value="Biaya kegiatan pengabdian kepada masyarakat" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Biaya kegiatan pengabdian kepada masyarakat") selected @endif>
        Biaya kegiatan pengabdian kepada masyarakat</option>
      <option value="Biaya kegiatan publikasi" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Biaya kegiatan publikasi") selected @endif>
        Biaya kegiatan publikasi</option>
      <option value="Biaya kegiatan kemahasiswaan" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Biaya kegiatan kemahasiswaan") selected @endif>
        Biaya kegiatan kemahasiswaan</option>
      <option value="Biaya investasi sumber daya manusia (SDM)" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Biaya investasi sumber daya manusia (SDM)") selected @endif>
        Biaya investasi sumber daya manusia (SDM)</option>
      <option value="Investasi prasarana pendidikan" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Investasi prasarana pendidikan") selected @endif>
        Investasi prasarana pendidikan</option>
      <option value="Investasi sarana pendidikan" 
        @if(old('jenis_penggunaan', isset($item->jenis_penggunaan) ? $item->jenis_penggunaan : '') == "Investasi sarana pendidikan") selected @endif>
        Investasi sarana pendidikan</option>
    </select>
    @error('jenis_penggunaan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS-2 ({{ date('Y') - 2 }})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_ts2" value="{{ isset($item->jumlah_ts2) ? $item->jumlah_ts2 : old('jumlah_ts2') }}" id="nilai2" class="form-control @error('jumlah_ts2') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_ts2')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS-1 ({{ date('Y') - 1 }})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_ts1" id="nilai1" value="{{ isset($item->jumlah_ts1) ? $item->jumlah_ts1 : old('jumlah_ts1') }}" class="form-control @error('jumlah_ts1') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_ts1')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS ({{ date('Y') }})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_ts" id="nilai" value="{{ isset($item->jumlah_ts) ? $item->jumlah_ts : old('jumlah_ts') }}" class="form-control @error('jumlah_ts') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_ts')
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
