@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria4/jumlah_bimbingan_ta">
  <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.4 Sumber Daya Manusia</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
            @if (Request::segment(3) === 'create')
            Tambah data
            @elseif (Request::segment(3) === 'edit')
            Edit data
            @endif

            Jumlah Bimbingan Tugas Akhir atau Skripsi, Tesis, dan Disertasi
          </h4>

            <p class="card-description">K.4 Sumber Daya Manusia</p>
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
            <form action="{{isset($item->id) ?  route('jumlah_bimbingan_ta.update', ['id' => Crypt::encryptString($item->id)])  : route('jumlah_bimbingan_ta.store')}}" method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif
              @csrf
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th rowspan="2">Nama Lengkap Dosen Tetap</th>
                      <th colspan="3">Jumlah Mahasiswa Bimbingan</th>
                      <th rowspan="2">Bukti/Tautan</th>
                    </tr>
                    <tr>
                      <th>TS-2</th>
                      <th>TS-1</th>
                      <th>TS</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                    <tr>
  <td>
    <select name="nidn_nidk" id="nidn_nidk" class="form-control @error('nidn_nidk') is-invalid @enderror">
      @if(isset($item->nidn_nidk))
        <option value="{{$item->nidn_nidk}}">{{$item->nidn_nidk}} | {{$item->dosen->nama}}</option>
      @else
        <option value="" selected>Pilih dosen</option>
        @foreach($dosens as $dosen)
        <option value="{{$dosen->nidn_nidk}}">
            {{$dosen->nama}}
        </option>
        @endforeach
      @endif
    </select>
    @error('nidn_nidk')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
  <td>
    <input type="text" class="form-control @error('ts_2') is-invalid @enderror" name="ts_2" value="{{ isset($item->ts_2) ? $item->ts_2 : old('ts_2') }}" placeholder="ketik disini">
    @error('ts_2')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
  <td>
    <input type="text" class="form-control @error('ts_1') is-invalid @enderror" name="ts_1" value="{{ isset($item->ts_1) ? $item->ts_1 : old('ts_1') }}" placeholder="ketik disini">
    @error('ts_1')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
  <td>
    <input type="text" class="form-control @error('ts') is-invalid @enderror" name="ts" value="{{ isset($item->ts) ? $item->ts : old('ts') }}" placeholder="ketik disini">
    @error('ts')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
  <td>
    <input type="text" class="form-control @error('tautan') is-invalid @enderror" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" placeholder="ketik disini">
    @error('tautan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>

                  </tbody>

                </table>
              </div>

                    @if (Request::segment(3) === 'create')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data</button>
                    @elseif (Request::segment(4) === 'edit')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Update data</button>
                    @endif

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- last row starts here -->

        </div>
        @endsection
