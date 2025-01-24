@extends('template')

@section('content-wrapper')
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-left">
        <!-- <button class="btn btn-primary mb-2 mb-md-0 mr-2"> Tambah data </button> -->
      </div>
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="/kriteria2">
            <p class="m-0 pr-3">Visi Misi</p>
          </a>
          <a class="pl-3 mr-4" href="/kriteria2">
            <p class="m-0">C.1 Visi Misi</p>
          </a>
        </div>

      </div>
    </div>
    <!-- first row starts here -->
    <div class="">
      <h1>K1 Visi Misi</h1>

      <div class="row mb-3">
        <div class="col-8">
          <form action="{{ route('kriteria1.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="mb-1">
              <label for="visi_misi" class="form-label">Upload Dokumen Visi Misi</label>
              <input class="form-control" type="file" id="visi_misi" name="visi_misi" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

          </form>
        </div>
      </div>

      @if ($table_c1)
        <div class="mt-6">
          <iframe frameborder="0" scrolling="no" width="740" height="480"
            src="{{ asset('documents/' . $table_c1->visi_misi) }}">
          </iframe>
        </div>
      @endif
    </div>
    <!-- last row starts here -->

  </div>
@endsection
