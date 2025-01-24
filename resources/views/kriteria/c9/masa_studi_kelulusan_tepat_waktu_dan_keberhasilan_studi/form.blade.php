@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 Tabel Masa Studi, Kelulusan Tepat Waktu, Dan Keberhasilan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.update', ['id' => $item->id])  : route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.store')}}" method="post">
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

            Tabel Masa Studi, Kelulusan Tepat Waktu, Dan Keberhasilan</h4>

          @if ($errors->any())
            <div class="alert alert-danger">
              <p>Periksa kembali data yang diinput</p>
            </div>
            @endif

             @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

          @if(session('info'))
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
             {{ session('info') }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
       @endif

          <hr>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tahun Masuk</label>
            <div class="col-sm-9">
              <select name="tahun_masuk" class="form-control {{ $errors->has('tahun_masuk') ? 'is-invalid' : '' }}" {{isset($item->tahun_masuk) ? 'disabled' : ''}}>
                <option value="" >Pilih Ts</option>
                <option value="ts_6" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_6') ? 'selected' : '' }}>TS-6</option>
                <option value="ts_5" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_5') ? 'selected' : '' }}>TS-5</option>
                <option value="ts_4" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_4') ? 'selected' : '' }}>TS-4</option>
                <option value="ts_3" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_3') ? 'selected' : '' }}>TS-3</option>
                <option value="ts_2" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_2') ? 'selected' : '' }}>TS-2</option>
                <option value="ts_1" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts_1') ? 'selected' : '' }}>TS-1</option>
                <option value="ts" {{ (old('tahun_masuk', $item->tahun_masuk ?? '') == 'ts') ? 'selected' : '' }}>TS</option>

              </select>
              @if ($errors->has('tahun_masuk'))
                  <div class="invalid-feedback">
                      {{ $errors->first('tahun_masuk') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Diterima</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_diterima" value="{{ isset($item->jumlah_diterima) ? $item->jumlah_diterima : old('jumlah_diterima') }}" class="form-control {{ $errors->has('jumlah_diterima') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_diterima'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_diterima') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-6</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_6" value="{{ isset($item->jumlah_lulus_ts_6) ? $item->jumlah_lulus_ts_6 : old('jumlah_lulus_ts_6') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_6') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_6'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_6') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-5</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_5" value="{{ isset($item->jumlah_lulus_ts_5) ? $item->jumlah_lulus_ts_5 : old('jumlah_lulus_ts_5') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_5') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_5'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_5') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-4</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_4" value="{{ isset($item->jumlah_lulus_ts_4) ? $item->jumlah_lulus_ts_4 : old('jumlah_lulus_ts_4') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_4') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_4'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_4') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-3</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_3" value="{{ isset($item->jumlah_lulus_ts_3) ? $item->jumlah_lulus_ts_3 : old('jumlah_lulus_ts_3') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_3') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_3'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_3') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-2</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_2" value="{{ isset($item->jumlah_lulus_ts_2) ? $item->jumlah_lulus_ts_2 : old('jumlah_lulus_ts_2') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_2') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_2'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_2') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS-1</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts_1" value="{{ isset($item->jumlah_lulus_ts_1) ? $item->jumlah_lulus_ts_1 : old('jumlah_lulus_ts_1') }}" class="form-control {{ $errors->has('jumlah_lulus_ts_1') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts_1'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts_1') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulus TS</label>
            <div class="col-sm-9">
              <input type="number" name="jumlah_lulus_ts" value="{{ isset($item->jumlah_lulus_ts) ? $item->jumlah_lulus_ts : old('jumlah_lulus_ts') }}" class="form-control {{ $errors->has('jumlah_lulus_ts') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('jumlah_lulus_ts'))
                  <div class="invalid-feedback">
                      {{ $errors->first('jumlah_lulus_ts') }}
                  </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan</label>
            <div class="col-sm-9">
              <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control {{ $errors->has('tautan') ? 'is-invalid' : '' }}" placeholder="Ketik disini">
              @if ($errors->has('tautan'))
                  <div class="invalid-feedback">
                      {{ $errors->first('tautan') }}
                  </div>
              @endif
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
