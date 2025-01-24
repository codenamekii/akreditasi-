@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria5/pemerolehan_dana">
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
      <form class="card forms-sample" action="{{isset($item->id) ?  route('pemerolehan_dana.update', ['id' => Crypt::encryptString($item->id)])  : route('pemerolehan_dana.store')}}" method="post">
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

            Pemerolehan Dana
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
    <label class="col-sm-3 col-form-label">Sumber Dana</label>
    <div class="col-sm-9">
        <select class="form-control @error('sumber_dana') is-invalid @enderror" name="sumber_dana">
            <option value="">Pilih</option>
            <option value="Perguruan tinggi sendiri" @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Perguruan tinggi sendiri") selected @endif>Perguruan tinggi sendiri</option>
            <option value="Yayasan" @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Yayasan") selected @endif>Yayasan</option>
            <option value="Kementerian" @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Kementerian") selected @endif>Kementerian</option>
            <option value="Lembaga tertentu DN/LN" @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Lembaga tertentu DN/LN") selected @endif>Lembaga tertentu DN/LN</option>
            <option value="Sumber lain" @if(old('sumber_dana', isset($item->sumber_dana) ? $item->sumber_dana : '') == "Sumber lain") selected @endif>Sumber lain</option>
        </select>
        @error('sumber_dana')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Jenis Dana</label>
    <div class="col-sm-9">
        <input type="text" name="jenis_dana" value="{{ isset($item->jenis_dana) ? $item->jenis_dana : old('jenis_dana') }}" class="form-control @error('jenis_dana') is-invalid @enderror" placeholder="Ketik disini">
        @error('jenis_dana')
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
