@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Informasi Peserta</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('data_jemaat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Jemaat</label>
              <input name="nama" type="text" value="{{ $peserta[0]->nama_jemaat }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Kategori</label>
              {{-- <select class="form-control" name="kategori" id="kategori">
                  <option value="">Pilih Kategori</option>
                  @foreach($datakategori as $item)
                      <option value="{{ $item->id_kjemaat }}">{{ $item->kategori }}</option>
                  @endforeach
              </select> --}}
            </div>
           
            <button type="submit" class="btn btn-success btn-lg">Data Verify</button>
          </form>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection



