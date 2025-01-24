@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria3/program_layanan">
  <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.3 Mahasiswa</p>

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

            Program Layanan Dan Pembinaan Minat, Bakat, Penalaran, Kesejahteraan, Dan Keprofesian Mahasiswa
          </h4>

            <p class="card-description">Mahasiswa</p>
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
            <form
            action="{{isset($item->id) ?  route('program_layanan.update', ['id' => Crypt::encryptString($item->id)])  : route('program_layanan.store')}}"
            method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif
              @csrf
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th >Tahun Akademik</th>
                      <th >Minat</th>
                      <th >Bakat</th>
                      <th >Penalaran</th>
                      <th >Kesejahteraan</th>
                      <th >Keprofesian</th>
                      <th >Bukti/Tautan</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                    <tr>
                      <td><input type="number" class="form-control @error('tahun_akademik') is-invalid @enderror" name="tahun_akademik" value="{{isset($item->tahun_akademik) ? $item->tahun_akademik : old('tahun_akademik')}}" placeholder="ketik disini" autofocus>                      </td>
                      <td><input type="number" class="form-control @error('minat') is-invalid @enderror" name="minat" value="{{isset($item->minat) ? $item->minat : old('minat')}}" placeholder="ketik disini" autofocus>                      </td>
                      <td><input type="number" class="form-control @error('bakat') is-invalid @enderror" name="bakat" value="{{isset($item->bakat) ? $item->bakat : old('bakat')}}" placeholder="ketik disini">                      </td>
                      <td><input type="number" class="form-control @error('penalaran') is-invalid @enderror" name="penalaran" value="{{isset($item->penalaran) ? $item->penalaran : old('penalaran')}}" placeholder="ketik disini">                      </td>
                      <td><input type="number" class="form-control @error('kesejahteraan') is-invalid @enderror" name="kesejahteraan" value="{{isset($item->kesejahteraan) ? $item->kesejahteraan : old('kesejahteraan')}}" placeholder="ketik disini"></td>
                      <td><input type="number" class="form-control @error('keprofesian') is-invalid @enderror" name="keprofesian" value="{{isset($item->keprofesian) ? $item->keprofesian : old('keprofesian')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control " name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini"></td>
                    </tr>
                  </tbody>

                </table>
              </div>

                    @if (Request::segment(3) === 'create')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data  </button>
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
