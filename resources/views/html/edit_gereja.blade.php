@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Updated</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('data_jemaat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Jemaat</label>
              <input value="{{ $datajemaat->nama }}" name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">Pastikan nama yang Anda masukan sesuai.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Kategori</label>
              <select class="form-control" name="kategori" id="kategori">
                  <option value="">Pilih Kategori</option>
                  @foreach($datakategori as $item)
                      <option value="{{ $item->id_kjemaat }}">{{ $item->kategori }}</option>
                  @endforeach
              </select>
            </div>

            <form action="{{ route('data_jemaat.updated') }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary btn-lg">Save</button>
            </form>
           
          </form>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection



