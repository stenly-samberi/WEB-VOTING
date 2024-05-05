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

            <div class="horizontal">
              <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Nama Jemaat</label>
                <input name="nama" type="text" value="{{ $peserta[0]->nama_jemaat }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>
  
              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Kordinator</label>
                <input name="nama" type="text" value="{{ $peserta[0]->kordinator }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>

              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                <input name="nama" type="text" value="{{ $peserta[0]->phone }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>
            </div>

            <div class="horizontal">
              <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Lagu Wajib</label>
                <input name="nama" type="text" value="{{ $peserta[0]->lagu_wajib }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>
  
              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Lagu Pilihan</label>
                <input name="nama" type="text" value="{{ $peserta[0]->judul_lagu }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>

              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Kategori Lomba</label>
                <input name="nama" type="text" value="{{ $peserta[0]->kategori_lomba }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>
            </div>

            <div class="horizontal">
              <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">Tanggal Pendaftaran</label>
                <input disabled name="nama" type="text" value="{{ $peserta[0]->created_at }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>
  
              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Terakhir Updated</label>
                <input disabled name="nama" type="text" value="{{ $peserta[0]->updated_at }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>

              <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Status Pendaftaran</label>
                <input disabled name="nama" type="text" value="{{ $peserta[0]->status == 0 ? 'Belum Aktif' : ($peserta[0]->status == 1 ? 'Aktif' : '') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
              </div>

             
            </div>
           
            <button type="submit" class="btn btn-success">Data Verify</button>
          </form>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection



