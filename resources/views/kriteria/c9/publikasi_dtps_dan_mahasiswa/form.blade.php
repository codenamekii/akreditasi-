@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('publikasi_dtps_dan_mahasiswa.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 Publikasi DTPS Dan Mahasiswa</p>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('publikasi_dtps_dan_mahasiswa.update', ['id' => $item->id])  : route('publikasi_dtps_dan_mahasiswa.store')}}" method="post">
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
            Publikasi DTPS Dan Mahasiswa
          </h4>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          <hr>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis</label>
            <div class="col-sm-9">
              <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" @if(isset($item->id)) disabled @endif>
                <option value="{{old('jenis') ? old('jenis') : ''}} ">{{old('jenis') ? old('jenis') : 'Pilih'}} </option>
                @foreach($jenis_publikasi as $jenis)
                  <option value="{{ $jenis }}" @if(isset($item->jenis) && $item->jenis == $jenis) selected @endif>{{ $jenis }}</option>
                @endforeach
              </select>
              @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah TS 2</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_ts_2" value="{{ isset($item->jumlah_ts_2) ? $item->jumlah_ts_2 : old('jumlah_ts_2') }}" class="form-control @error('jumlah_ts_2') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_ts_2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah TS 1</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_ts_1" value="{{ isset($item->jumlah_ts_1) ? $item->jumlah_ts_1 : old('jumlah_ts_1') }}" class="form-control @error('jumlah_ts_1') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_ts_1')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah TS</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_ts" value="{{ isset($item->jumlah_ts) ? $item->jumlah_ts : old('jumlah_ts') }}" class="form-control @error('jumlah_ts') is-invalid @enderror" placeholder="Ketik disini">
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
  <script>
    const formatInput = (input) => {
      let value = input.value;
      value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      input.value = value;
    };

    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        formatInput(input);
      });
    });
  </script>
@endsection
