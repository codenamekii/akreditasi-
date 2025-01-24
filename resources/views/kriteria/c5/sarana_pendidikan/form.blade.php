@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria5/sarana_pendidikan">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.5 Sarana Pendidikan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
          
          <form action="{{isset($item->id) ?  route('sarana_pendidikan.update', ['id' => Crypt::encryptString($item->id)])  : route('sarana_pendidikan.store')}}" method="post">
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
            Sarana Pendidikan
          </h4>

          <p class="card-description">K.5 Sarana Pendidikan</p>
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
  <label class="col-sm-3 col-form-label">Jenis Sarana</label>
  <div class="col-sm-9">
    <input type="text" name="jenis_sarana" value="{{ isset($item->jenis_sarana) ? $item->jenis_sarana : old('jenis_sarana') }}" class="form-control @error('jenis_sarana') is-invalid @enderror" placeholder="Ketik disini">
    @error('jenis_sarana')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Jumlah Unit</label>
  <div class="col-sm-9">
    <input type="number" name="jumlah_unit" value="{{ isset($item->jumlah_unit) ? $item->jumlah_unit : old('jumlah_unit') }}" class="form-control @error('jumlah_unit') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_unit')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row" style="margin: 0px; padding:0px;">
  <label class="col-sm-3 col-form-label">Kualitas</label>
  <div class="col-sm-9">
    <div class="form-group @error('kualitas') is-invalid @enderror">
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" id="baik" name="kualitas" value="Baik" @if(isset($item->kualitas) && $item->kualitas == 'Baik') checked @endif>
          Baik<i class="input-helper"></i>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" id="kurang_baik" name="kualitas" value="Kurang Baik" @if(isset($item->kualitas) && $item->kualitas == 'Kurang Baik') checked @endif>
          Kurang Baik<i class="input-helper"></i>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" id="tidak_baik" name="kualitas" value="Tidak Baik" @if(isset($item->kualitas) && $item->kualitas == 'Tidak Baik') checked @endif>
          Tidak Baik
        </label>
      </div>
    </div>
    @error('kualitas')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Kondisi</label>
  <div class="col-sm-9">
    <select class="form-control @error('kondisi') is-invalid @enderror" name="kondisi">
      <option value="">--Pilih--</option>
      <option value="terawat" @if(isset($item->kondisi) && $item->kondisi == 'terawat') selected @endif>Terawat</option>
      <option value="tidak terawat" @if(isset($item->kondisi) && $item->kondisi == 'tidak terawat') selected @endif>Tidak Terawat</option>
    </select>
    @error('kondisi')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Unit Pengelola (PS, UPPS, PT)</label>
  <div class="col-sm-9">
    <select class="form-control @error('unit_pengelola') is-invalid @enderror" name="unit_pengelola">
      <option value="">--Pilih--</option>
      <option value="PS" @if(isset($item->unit_pengelola) && $item->unit_pengelola == 'PS') selected @endif>PS</option>
      <option value="UPPS" @if(isset($item->unit_pengelola) && $item->unit_pengelola == 'UPPS') selected @endif>UPPS</option>
      <option value="PT" @if(isset($item->unit_pengelola) && $item->unit_pengelola == 'PT') selected @endif>PT</option>
    </select>
    @error('unit_pengelola')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="Tautan di sini">
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
</div>
<!-- last row starts here -->

</div>
@endsection
