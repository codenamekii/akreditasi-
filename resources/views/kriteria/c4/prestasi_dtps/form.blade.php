@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria4/prestasi_dtps">
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
            @elseif (Request::segment(4) === 'edit')
            Edit data
            @endif

            Prestasi DTPS
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
            <form action="{{isset($item->id) ?  route('prestasi_dtps.update', ['id' => Crypt::encryptString($item->id)])  : route('prestasi_dtps.store')}}" method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif
              @csrf
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th rowspan="2">Nama Lengkap Dosen Tetap</th>
                      <th rowspan="2">Prestasi yang Dicapai</th>
                      <th rowspan="2">Tahun Pencapaian</th>
                      <th colspan="3">Tingkat</th>
                      <th rowspan="2">Bukti/Tautan</th>
                    </tr>
                    <tr>
                      <th>Internasional</th>
                      <th>Nasional</th>
                      <th>Lokal</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                   <tr>
  <td>
    <div class="form-group">
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
    </div>
  </td>
  <td>
    <div class="form-group">
      <textarea class="form-control @error('prestasi') is-invalid @enderror" name="prestasi" rows="8" placeholder="ketik disini">{{ old('prestasi', $item->prestasi ?? '') }}</textarea>
      @error('prestasi')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </td>
  <td>
    <div class="form-group">
      <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun', $item->tahun ?? '') }}" placeholder="ketik disini">
      @error('tahun')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </td>
  <td>
    <div class="form-group">
      <div class="form-check">
        <input type="radio" class="form-check-input @error('tingkat') is-invalid @enderror" name="tingkat" id="tingkat1" value="Internasional" @if(isset($item->tingkat) && $item->tingkat == "Internasional") checked @endif>
        <!-- <label class="form-check-label" for="tingkat1">Internasional</label> -->
      </div>
      
      @error('tingkat')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </td>
  <td>
    <div class="form-check">
        <input type="radio" class="form-check-input @error('tingkat') is-invalid @enderror" name="tingkat" id="tingkat2" value="Nasional" @if(isset($item->tingkat) && $item->tingkat == "Nasional") checked @endif>
        <!-- <label class="form-check-label" for="tingkat2">Nasional</label> -->
      </div>
      
  </td>
  <td>
    <div class="form-check">
        <input type="radio" class="form-check-input @error('tingkat') is-invalid @enderror" name="tingkat" id="tingkat3" value="Lokal" @if(isset($item->tingkat) && $item->tingkat == "Lokal") checked @endif>
        <!-- <label class="form-check-label" for="tingkat3">Lokal</label> -->
      </div>
  </td>
  <td>
    <div class="form-group">
      <input type="text" class="form-control @error('tautan') is-invalid @enderror" name="tautan" value="{{ old('tautan', $item->tautan ?? '') }}" placeholder="ketik disini">
      @error('tautan')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
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
