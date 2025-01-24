@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria4/kegiatan_mengajar_dosen_tetap">
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

            Kegiatan Mengajar DTPS
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
          <form action="{{isset($item->id) ?  route('kegiatan_mengajar_dosen_tetap.update', ['id' => Crypt::encryptString($item->id)])  : route('kegiatan_mengajar_dosen_tetap.store')}}" method="post">
            @if(isset($item->id))
              @method('PUT')
            @endif
            @csrf

            <table class="table">
              <tr>
    <td><label class="col-form-label">Semester</label></td>
    <td>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="semester" value="Gasal"  @if(isset($item->semester) && $item->semester == 'Gasal') checked @endif> Gasal <i class="input-helper"></i>
            </label>
        </div>
        @error('semester')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="semester" value="Genap" @if(isset($item->semester) && $item->semester == 'Genap') checked @endif> Genap <i class="input-helper"></i>
            </label>
        </div>
        @error('semester')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Nama Lengkap</label></td>
    <td colspan="2">
        <select class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk">
            <option value="">Pilih</option>
            @foreach($dosens as $dosen)
                <option value="{{ $dosen->nidn_nidk }}"
                    @if(old('nidn_nidk', isset($item->nidn_nidk) ? $item->nidn_nidk : '') == $dosen->nidn_nidk) selected @endif>
                    {{ $dosen->nidn_nidk }} | {{ $dosen->nama }}</option>
            @endforeach
        </select>
        @error('nidn_nidk')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Jumlah Kelas</label></td>
    <td colspan="2">
        <input type="text" name="jumlah_kelas" value="{{ old('jumlah_kelas', isset($item->jumlah_kelas) ? $item->jumlah_kelas : '') }}" class="form-control @error('jumlah_kelas') is-invalid @enderror" placeholder="Belum di isi">
        @error('jumlah_kelas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Mata Kuliah</label></td>
    <td colspan="2">
        <select name="kode_mk" id="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror">
            @if(isset($item->kode_mk))
                <option value="{{ $item->kode_mk }}">{{ $item->kode_mk }} | {{ $item->matakuliah->nama }}</option>
            @else
                <option value="" disabled>Pilih Mata Kuliah</option>
                @foreach($matakuliah as $mk)
                    <option value="{{ $mk->kode_mk }}">
                        {{ $mk->kode_mk }} | {{ $mk->nama }} | {{ $mk->sks }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('kode_mk')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Jumlah Pertemuan yang Direncanakan</label></td>
    <td colspan="2">
        <input type="text" name="jum_pertemuan_rencana" value="{{ old('jum_pertemuan_rencana', isset($item->jum_pertemuan_rencana) ? $item->jum_pertemuan_rencana : '') }}" class="form-control @error('jum_pertemuan_rencana') is-invalid @enderror" placeholder="Belum di isi">
        @error('jum_pertemuan_rencana')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Jumlah Pertemuan yang Dilaksanakan</label></td>
    <td colspan="2">
        <input type="text" name="jum_pertemuan_terlaksana" value="{{ old('jum_pertemuan_terlaksana', isset($item->jum_pertemuan_terlaksana) ? $item->jum_pertemuan_terlaksana : '') }}" class="form-control @error('jum_pertemuan_terlaksana') is-invalid @enderror" placeholder="Belum di isi">
        @error('jum_pertemuan_terlaksana')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>
<tr>
    <td><label class="col-form-label">Bukti/Tautan</label></td>
    <td colspan="2">
        <input type="text" name="tautan" value="{{ old('tautan', isset($item->tautan) ? $item->tautan : '') }}" class="form-control @error('tautan') is-invalid @enderror" placeholder="Belum di isi">
        @error('tautan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </td>
</tr>

            </table>
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
