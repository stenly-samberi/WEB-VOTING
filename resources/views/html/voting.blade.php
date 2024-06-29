@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Penilaian</h5>
    {{-- <div class="card">
      <div class="card-body">
        @include('alert.message')
        <form action="{{ route('nomor_tampil.generateRandomOrder') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Auto Generated</button>
        </form>
      </div>
    </div> --}}
    

    <div class="row">
        @forelse ($peserta as $p)
            <div class="col-md-4 mb-1">
                <div class="card card-click" id="card-{{ $loop->iteration }}">
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $p->data_jemaat->nama }}</h3>
                        <h1 class="card-text text-center">{{ $p->no_tampil }}</h1>
                        {{-- <label class=" card-text text-center" for="">{{ $p->data_lagu->judul }}</label> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    Belum ada nomor urut yang terdaftar.
                </div>
            </div>
        @endforelse
    </div>

    <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input name="username" type="text" class="form-control" id="username">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input name="password" type="password" class="form-control" id="password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option value="admin">Admin</option>
                    <option value="juri">Juri</option>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    
    
     
   
  </div>
</div>


@endsection

