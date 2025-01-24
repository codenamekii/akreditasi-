@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('dosen_tamu_dan_tenaga_ahli.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.6 Dosen Tamu Dan Tenaga Ahli</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('dosen_tamu_dan_tenaga_ahli.update', ['id' => Crypt::encryptString($item->id)])  : route('dosen_tamu_dan_tenaga_ahli.store')}}" method="post">
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

          Dosen Tamu Dan Tenaga Ahli</h4>

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
            <label class="col-sm-3 col-form-label">Dosen</label>
            <div class="col-sm-9">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', isset($item->nama) ? $item->nama : '') }}" placeholder="ketik disini" autofocus>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Lembaga</label>
              <div class="col-sm-9">
                <input type="text" name="nama_lembaga" value="{{ isset($item->nama_lembaga) ? $item->nama_lembaga : old('nama_lembaga') }}" class="form-control @error('nama_lembaga') is-invalid @enderror" placeholder="Ketik disini">
                @error('nama_lembaga')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kepakaran</label>
              <div class="col-sm-9">
                <input type="text" name="kepakaran" value="{{ isset($item->kepakaran) ? $item->kepakaran : old('kepakaran') }}" class="form-control @error('kepakaran') is-invalid @enderror" placeholder="Ketik disini">
                @error('kepakaran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Matakuliah</label>
              <div class="col-sm-9">
                <select class="form-control @error('mk_id') is-invalid @enderror" name="mk_id">
                  <option value="">Pilih</option>
                  @foreach($matakuliah as $mk)
                  <option value="{{ $mk->id }}"
                    @if(old('mk_id', isset($item->mk_id) ? $item->mk_id : '')  == $mk->id) selected @endif>
                    kode : {{$mk->kode_mk}}|matkul : {{ $mk->nama }}|sks : {{$mk->sks}}|Semester : {{$mk->semester}}</option>
                    @endforeach
                  </select>
                  @error('mk_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Waktu Kegiatan</label>
                <div class="col-sm-9">
                  <input type="date" name="waktu_kegiatan" value="{{ isset($item->waktu_kegiatan) ? $item->waktu_kegiatan : old('waktu_kegiatan') }}" class="form-control @error('waktu_kegiatan') is-invalid @enderror" placeholder="Ketik disini">
                  @error('waktu_kegiatan')
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
              <button class="btn btn-primary" type="submit" name="button">
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
