@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria5/prasarana_pendidikan">
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
        <form class="card forms-sample" action="{{isset($item->id) ?  route('prasarana_pendidikan.update', ['id' => Crypt::encryptString($item->id)])  : route('prasarana_pendidikan.store')}}" method="post">
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

            Prasarana
          </h4>

          <p class="card-description">K.5 Tabel Data Prasarana Pendidikan</p>
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
  <label class="col-sm-3 col-form-label">Jenis Prasarana</label>
  <div class="col-sm-9">
    <input type="text" name="jenis_prasarana" value="{{ isset($item->jenis_prasarana) ? $item->jenis_prasarana : old('jenis_prasarana') }}" class="form-control @error('jenis_prasarana') is-invalid @enderror" placeholder="Ketik disini">
    @error('jenis_prasarana')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Jumlah Unit</label>
  <div class="col-sm-9">
    <input type="number" name="jumlah_unit" value="{{ isset($item->jumlah_unit) ? $item->jumlah_unit : old('jumlah_unit') }}" class="form-control @error('jumlah_unit') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_unit')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Luas</label>
  <div class="col-sm-9">
    <input type="number" name="luas" value="{{ isset($item->luas) ? $item->luas : old('luas') }}" class="form-control @error('luas') is-invalid @enderror" placeholder="Ketik disini">
    @error('luas')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Kepemilikan*</label>
  <div class="col-sm-9">
    <select class="form-control @error('kepemilikan') is-invalid @enderror" name="kepemilikan">
      <option value="">--Pilih--</option>
      <option value="SD" @if(old('kepemilikan', isset($item->kepemilikan) ? $item->kepemilikan : '') == "SD") selected @endif>SD (Milik sendiri)</option>
      <option value="SW" @if(old('kepemilikan', isset($item->kepemilikan) ? $item->kepemilikan : '') == "SW") selected @endif>SW (Sewa/Kontrak/Kerjasama)</option>
    </select>
    @error('kepemilikan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Kondisi</label>
  <div class="col-sm-9">
    <select class="form-control @error('kondisi') is-invalid @enderror" name="kondisi">
      <option value="">--Pilih--</option>
      <option value="terawat" @if(old('kondisi', isset($item->kondisi) ? $item->kondisi : '') == "terawat") selected @endif>Terawat</option>
      <option value="tidak terawat" @if(old('kondisi', isset($item->kondisi) ? $item->kondisi : '') == "tidak terawat") selected @endif>Tidak Terawat</option>
    </select>
    @error('kondisi')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Penggunaan (Jam/minggu)</label>
  <div class="col-sm-9">
    <input type="number" name="penggunaan" value="{{ isset($item->penggunaan) ? $item->penggunaan : old('penggunaan') }}" class="form-control @error('penggunaan') is-invalid @enderror" placeholder="Ketik disini">
    @error('penggunaan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Tautan</label>
  <div class="col-sm-9">
    <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control @error('tautan') is-invalid @enderror" placeholder="Ketik disini">
    @error('tautan')
      <div class="invalid-feedback">{{ $message }}</div>
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
@endsection
