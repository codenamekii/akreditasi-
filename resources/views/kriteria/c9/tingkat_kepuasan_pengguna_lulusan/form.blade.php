@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
        <div class="header-left">
            <a href="{{route('tingkat_kepuasan_pengguna_lulusan.index')}}">
                <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
            </a>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Data Kuantitatif</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">K.9 Tingkat Kepuasan Pengguna Lulusan</p>
                </a>
            </div>
        </div>
    </div>
    <!-- first row starts here -->
    <div class="row">
        <div class="col grid-margin stretch-card">
            <form class="card forms-sample" action="{{isset($item->id) ?  route('tingkat_kepuasan_pengguna_lulusan.update', ['id' => $item->id])  : route('tingkat_kepuasan_pengguna_lulusan.store')}}" method="post">
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
                        Tingkat Kepuasan Pengguna Lulusan
                    </h4>
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
                      <label class="col-sm-3 col-form-label">Jenis Kemampuan</label>
                      <div class="col-sm-9">
                          <select name="jenis_kemampuan" class="form-control @error('jenis_kemampuan') is-invalid @enderror" @if(isset($item->jenis_kemampuan)) disabled @endif>
                              <option value="">Pilih Jenis Kemampuan</option>
                              @foreach($item_kemampuan as $kemampuan)
                                  <option value="{{ $kemampuan }}" @if(isset($item->jenis_kemampuan) && $item->jenis_kemampuan == $kemampuan) selected @endif>{{ $kemampuan }}</option>
                              @endforeach
                          </select>
                          @error('jenis_kemampuan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sangat Baik</label>
                        <div class="col-sm-9">
                            <input type="text" name="sangat_baik" value="{{ isset($item->sangat_baik) ? $item->sangat_baik : old('sangat_baik') }}" class="form-control @error('sangat_baik') is-invalid @enderror" placeholder="Ketik disini">
                            @error('sangat_baik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Baik</label>
                        <div class="col-sm-9">
                            <input type="text" name="baik" value="{{ isset($item->baik) ? $item->baik : old('baik') }}" class="form-control @error('baik') is-invalid @enderror" placeholder="Ketik disini">
                            @error('baik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Cukup</label>
                        <div class="col-sm-9">
                            <input type="text" name="cukup" value="{{ isset($item->cukup) ? $item->cukup : old('cukup') }}" class="form-control @error('cukup') is-invalid @enderror" placeholder="Ketik disini">
                            @error('cukup')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kurang</label>
                        <div class="col-sm-9">
                            <input type="text" name="kurang" value="{{ isset($item->kurang) ? $item->kurang : old('kurang') }}" class="form-control @error('kurang') is-invalid @enderror" placeholder="Ketik disini">
                            @error('kurang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tindak Lanjut</label>
                        <div class="col-sm-9">
                            <textarea name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror" placeholder="Ketik disini">{{ isset($item->tindak_lanjut) ? $item->tindak_lanjut : old('tindak_lanjut') }}</textarea>
                            @error('tindak_lanjut')
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


@section('js')
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
