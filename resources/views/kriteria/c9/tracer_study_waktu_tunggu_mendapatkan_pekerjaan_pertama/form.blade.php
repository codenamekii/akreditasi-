@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 Tracer Study, Waktu Tunggu Mendapatkan Pekerjaan Pertama</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.update', ['id' => $item->id])  : route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.store')}}" method="post">
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

            Tracer Study, Waktu Tunggu Mendapatkan Pekerjaan Pertama</h4>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif

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
            <label class="col-sm-3 col-form-label">Tahun Lulus <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="tahun_lulus" value="{{ isset($item->tahun_lulus) ? $item->tahun_lulus : old('tahun_lulus') }}" class="form-control @error('tahun_lulus') is-invalid @enderror" placeholder="Ketik disini" @if(isset($item->id)) disabled @endif>
              @error('tahun_lulus')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_lulusan" value="{{ isset($item->jumlah_lulusan) ? $item->jumlah_lulusan : old('jumlah_lulusan') }}" class="form-control @error('jumlah_lulusan') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_lulusan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Yang Terlacak <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_terlacak" value="{{ isset($item->jumlah_terlacak) ? $item->jumlah_terlacak : old('jumlah_terlacak') }}" class="form-control @error('jumlah_terlacak') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_terlacak')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Terlacak Dengan Waktu Tunggu Mendapatkan Pekerjaan Pertama (WT < 3 Bulan) <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="waktu_tunggu_wt3" value="{{ isset($item->waktu_tunggu_wt3) ? $item->waktu_tunggu_wt3 : old('waktu_tunggu_wt3') }}" class="form-control @error('waktu_tunggu_wt3') is-invalid @enderror" placeholder="Ketik disini">
              @error('waktu_tunggu_wt3')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Terlacak Dengan Waktu Tunggu Mendapatkan Pekerjaan Pertama (3 ≤ WT < 6 Bulan) <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="waktu_tunggu_wt36" value="{{ isset($item->waktu_tunggu_wt36) ? $item->waktu_tunggu_wt36 : old('waktu_tunggu_wt36') }}" class="form-control @error('waktu_tunggu_wt36') is-invalid @enderror" placeholder="Ketik disini">
              @error('waktu_tunggu_wt36')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Terlacak Dengan Waktu Tunggu Mendapatkan Pekerjaan Pertama (6 ≤ WT < 12 Bulan) <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="waktu_tunggu_wt612" value="{{ isset($item->waktu_tunggu_wt612) ? $item->waktu_tunggu_wt612 : old('waktu_tunggu_wt612') }}" class="form-control @error('waktu_tunggu_wt612') is-invalid @enderror" placeholder="Ketik disini">
              @error('waktu_tunggu_wt612')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan Terlacak Dengan Waktu Tunggu Mendapatkan Pekerjaan Pertama (WT ≥ 12 Bulan) <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="waktu_tunggu_wt12" value="{{ isset($item->waktu_tunggu_wt12) ? $item->waktu_tunggu_wt12 : old('waktu_tunggu_wt12') }}" class="form-control @error('waktu_tunggu_wt12') is-invalid @enderror" placeholder="Ketik disini">
              @error('waktu_tunggu_wt12')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
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
