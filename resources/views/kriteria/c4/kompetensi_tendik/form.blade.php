@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria4/kompetensi_tendik">
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
            Pengembangan Kompetensi dan Karier Tendik
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
          
          <form action="{{isset($item->id) ?  route('kompetensi_tendik.update', ['id' => Crypt::encryptString($item->id)])  : route('kompetensi_tendik.store')}}" method="post">

            @if(isset($item->id))
              @method('PUT')
            @endif
            @csrf
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <tbody class="text-justify">
                  <tr>
  <td>Nama Tenaga Kependidikan</td>
  <td>
    <select name="id_tendik" id="id_tendik" class="form-control @error('id_tendik') is-invalid @enderror">
      @if(isset($item->id_tendik))
        <option value="{{$item->id_tendik}}">{{$item->id_tendik}} | {{$item->tendik->nama}}</option>
      @else
        <option value="" disabled>Pilih tendik</option>
        @foreach($tendiks as $tendik)
        <option value="{{$tendik->id_tendik}}">
          {{$tendik->nama}}
        </option>
        @endforeach
      @endif
    </select>
    @error('id_tendik')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Nama Kegiatan <br> Pengembangan Kompetensi</td>
  <td>
    <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" value="{{isset($item->nama_kegiatan) ? $item->nama_kegiatan : old('nama_kegiatan')}}" placeholder="ketik disini">
    @error('nama_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Waktu Mulai <br> Kegiatan</td>
  <td>
    <input type="date" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai" value="{{isset($item->waktu_mulai) ? $item->waktu_mulai : old('waktu_mulai')}}" placeholder="ketik disini">
    @error('waktu_mulai')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Waktu Berakhir Kegiatan</td>
  <td>
    <input type="date" class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai" value="{{isset($item->waktu_selesai) ? $item->waktu_selesai : old('waktu_selesai')}}" placeholder="ketik disini">
    @error('waktu_selesai')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Tempat Kegiatan</td>
  <td>
    <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{isset($item->tempat) ? $item->tempat : old('tempat')}}" placeholder="ketik disini">
    @error('tempat')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Bukti/Tautan</td>
  <td>
    <input type="text" class="form-control @error('tautan') is-invalid @enderror" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini">
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
