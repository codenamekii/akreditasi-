@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('ipk_lulusan.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 IPK Lulusan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('ipk_lulusan.update', ['id' => Crypt::encryptString($item->id)])  : route('ipk_lulusan.store')}}" method="post">
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

            IPK Lulusan</h4>

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
              <input type="number" step="0.01" name="tahun" value="{{ isset($item->tahun) ? $item->tahun : old('tahun') }}" class="form-control @error('tahun') is-invalid @enderror" placeholder="Ketik disini" @if(isset($item->id)) disabled @endif>
              @error('tahun')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah Lulusan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="number" step="0.01" name="jumlah_lulusan" value="{{ isset($item->jumlah_lulusan) ? $item->jumlah_lulusan : old('jumlah_lulusan') }}" class="form-control @error('jumlah_lulusan') is-invalid @enderror" placeholder="Ketik disini">
              @error('jumlah_lulusan')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Indeks Prestasi Kumulatif (IPK) <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-4">
                  <label class="col-form-label">Minimum <span class="text-danger">*</span></label>
                  <input type="number" step="0.01" name="minimum" value="{{ isset($item->minimum) ? $item->minimum : old('minimum') }}" class="form-control @error('minimum') is-invalid @enderror" placeholder="Ketik disini">
                  @error('minimum')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-sm-4">
                  <label class="col-form-label">Rata-Rata <span class="text-danger">*</span></label>
                  <input type="number" step="0.01" name="rata_rata" value="{{ isset($item->rata_rata) ? $item->rata_rata : old('rata_rata') }}" class="form-control @error('rata_rata') is-invalid @enderror" placeholder="Ketik disini">
                  @error('rata_rata')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-sm-4">
                  <label class="col-form-label">Maksimum <span class="text-danger">*</span></label>
                  <input type="number" step="0.01" name="maksimum" value="{{ isset($item->maksimum) ? $item->maksimum : old('maksimum') }}" class="form-control @error('maksimum') is-invalid @enderror" placeholder="Ketik disini">
                  @error('maksimum')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control @error('tautan') is-invalid @enderror" placeholder="Ketik disini">
              @error('tautan')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
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
