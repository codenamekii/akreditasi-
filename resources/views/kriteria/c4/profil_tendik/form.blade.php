@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria4/profil_tendik">
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
             Profil Tendik
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
            <form action="{{isset($item->id) ?  route('profil_tendik.update', ['id' => Crypt::encryptString($item->id)])  : route('profil_tendik.store')}}" method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif
              @csrf
              <div class="table-responsive">

              </div>

                  <table class="table table-striped table-bordered">
                  <tbody class="text-justify">
                   <tr>
  <td>ID Tendik</td>
  <td>
    <input type="text" class="form-control @error('id_tendik') is-invalid @enderror" name="id_tendik" id="id_tendik" value="{{isset($item->id_tendik) ? $item->id_tendik : old('id_tendik')}}" placeholder="ketik disini" @if(isset($item->id_tendik)) readonly @endif>
    @error('id_tendik')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Nama Lengkap</td>
  <td>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{isset($item->nama) ? $item->nama : old('nama')}}" placeholder="ketik disini">
    @error('nama')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Status</td>
  <td>
    <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{isset($item->status) ? $item->status : old('status')}}" placeholder="ketik disini">
    @error('status')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Bidang Keahlian</td>
  <td>
    <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror" name="bidang_keahlian" value="{{isset($item->bidang_keahlian) ? $item->bidang_keahlian : old('bidang_keahlian')}}" placeholder="ketik disini">
    @error('bidang_keahlian')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Pendidikan</td>
  <td>
    <div class="form-group row" style="margin: 0px; padding:0px;">
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('pendidikan') is-invalid @enderror" name="pendidikan" id="slta" value="SLTA" @if(isset($item->pendidikan) && $item->pendidikan == 'SLTA') checked @endif> SLTA <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('pendidikan') is-invalid @enderror" name="pendidikan" id="diploma" value="Diploma" @if(isset($item->pendidikan) && $item->pendidikan == 'Diploma') checked @endif> Diploma <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('pendidikan') is-invalid @enderror" name="pendidikan" id="s1" value="S1" @if(isset($item->pendidikan) && $item->pendidikan == 'S1') checked @endif> S1 <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('pendidikan') is-invalid @enderror" name="pendidikan" id="s2" value="S2" @if(isset($item->pendidikan) && $item->pendidikan == 'S2') checked @endif> S2 <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('pendidikan') is-invalid @enderror" name="pendidikan" id="s3" value="S3" @if(isset($item->pendidikan) && $item->pendidikan == 'S3') checked @endif> S3 <i class="input-helper"></i>
          </label>
        </div>
      </div>
    </div>
    @error('pendidikan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>
<tr>
  <td>Unit Kerja</td>
  <td>
    <div class="form-group row" style="margin: 0px; padding:0px;">
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('unit_kerja') is-invalid @enderror" name="unit_kerja" id="PS" value="PS" @if(isset($item->unit_kerja) && $item->unit_kerja == 'PS') checked @endif> PS <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('unit_kerja') is-invalid @enderror" name="unit_kerja" id="UPPS" value="UPPS" @if(isset($item->unit_kerja) && $item->unit_kerja == 'UPPS') checked @endif> UPPS <i class="input-helper"></i>
          </label>
        </div>
      </div>
      <div class="col">
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input @error('unit_kerja') is-invalid @enderror" name="unit_kerja" id="PT" value="PT" @if(isset($item->unit_kerja) && $item->unit_kerja == 'PT') checked @endif> PT <i class="input-helper"></i>
          </label>
        </div>
      </div>
    </div>
    @error('unit_kerja')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </td>
</tr>


                    <tr>
                      <td >Bukti/Tautan</td>

                      <td><input type="text" class="form-control" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini"></td>
                    </tr>
                    <tr>
                      <td>
                        @if (Request::segment(3) === 'create')
                          <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data</button>
                        @elseif (Request::segment(4) === 'edit')
                          <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Update data</button>
                        @endif
                      </td>
                    </tr>

                  </tbody>

                </table>

            </form>
          </div>
              </div>
            </div>
          </div>
          <!-- last row starts here -->

        </div>
        @endsection
