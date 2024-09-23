@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Informasi Peserta</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
         
<form action="{{ route('peserta.updated_peserta', $peserta[0]->idr) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="horizontal">

        <input name="id_kategori_lomba" type="number" value="{{ $peserta[0]->idk }}" class="form-control">

        <div class="mb-3 col-6">
            <label for="exampleInputEmail1" class="form-label">Nama Jemaat</label>
            <input name="nama_jemaat" type="text" value="{{ $peserta[0]->nama_jemaat }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Kordinator</label>
            <input name="kordinator" type="text" value="{{ $peserta[0]->kordinator }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Phone</label>
            <input name="phone" type="text" value="{{ $peserta[0]->phone }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
    </div>

    <div class="horizontal">
        <div class="mb-3 col-6">
            <label for="exampleInputEmail1" class="form-label">Lagu Wajib</label>
            <input name="lagu_wajib" type="text" value="{{ $peserta[0]->lagu_wajib }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Lagu Pilihan</label>
            <input name="lagu_pilihan" type="text" value="{{ $peserta[0]->judul_lagu }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Kategori Lomba</label>
            <input name="kategori_lomba" type="text" value="{{ $peserta[0]->kategori_lomba }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
    </div>

    <div class="horizontal">
        <div class="mb-3 col-9">
            <label for="exampleInputEmail1" class="form-label">Tanggal Pendaftaran</label>
            <input disabled name="tgl_daftar" type="text" value="{{ $peserta[0]->created_at }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3 col-3">
            <label for="exampleInputEmail1" class="form-label">Nomor Tampil</label>
            <input name="nomor_tampil" type="number" value="{{$peserta[0]->no_tampil}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

        </div>
      </div>


    </div>
  </div>
</div>
@endsection



