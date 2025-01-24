@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria5/dana_pkm">
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
      <form class="card forms-sample" action="{{isset($item->id) ?  route('dana_pkm.update', ['id' => Crypt::encryptString($item->id)])  : route('dana_pkm.store')}}" method="post">
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

            Dana PKM
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
  <label class="col-sm-3 col-form-label">Judul PKM</label>
  <div class="col-sm-9">
    <input type="text" name="judul_pkm" value="{{ isset($item->judul_pkm) ? $item->judul_pkm : old('judul_pkm') }}" class="form-control @error('judul_pkm') is-invalid @enderror" placeholder="Ketik disini">
    @error('judul_pkm')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">ketua Tim</label>
  <div class="col-sm-9">
    <select class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk">
      <option value="">Pilih</option>
      @foreach($dosens as $dosen)
        <option value="{{ $dosen->nidn_nidk }}"
          @if(old('nidn_nidk', isset($item->nidk_nidk) ? $item->nidn_nidk : '') == $dosen->nidn_nidk) selected @endif>
          {{ $dosen->nidn_nidk }} | {{ $dosen->nama }}</option>
      @endforeach
    </select>
    @error('nidn_nidk')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Sumber dan Jenis Dana</label>
  <div class="col-sm-9">
    <select class="form-control @error('sumber_dana') is-invalid @enderror" name="sumber_dana">
      <option value="">Pilih</option>
      <option value="PT/Mandiri"
        @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "PT/Mandiri") selected @endif>
        PT/Mandiri</option>
      <option value="Lembaga DN (diluar PT)"
        @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Lembaga DN (diluar PT)") selected @endif>
        Lembaga DN (diluar PT)</option>
      <option value="Lembaga LN"
        @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Lembaga LN") selected @endif>
        Lembaga LN</option>
    </select>
    @error('sumber_dana')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS-2 ({{date('Y') - 2}})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_dana_ts2" value="{{ isset($item->jumlah_dana_ts2) ? $item->jumlah_dana_ts2 : old('jumlah_dana_ts2') }}" id="nilai2" class="form-control @error('jumlah_dana_ts2') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_dana_ts2')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS-1 ({{date('Y') - 1}})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_dana_ts1" id="nilai1" value="{{ isset($item->jumlah_dana_ts1) ? $item->jumlah_dana_ts1 : old('jumlah_dana_ts1') }}" class="form-control @error('jumlah_dana_ts1') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_dana_ts1')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">TS ({{date('Y')}})</label>
  <div class="col-sm-9">
    <input type="text" name="jumlah_dana_ts" id="nilai" value="{{ isset($item->jumlah_dana_ts) ? $item->jumlah_dana_ts : old('jumlah_dana_ts') }}" class="form-control @error('jumlah_dana_ts') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_dana_ts')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bukti/Tautan</label>
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
