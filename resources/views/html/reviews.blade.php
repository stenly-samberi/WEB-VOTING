@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Penilaian</h5>
    
    

    <div class="row">
        @forelse ($peserta as $p)
            <div class="col-md-4 mb-1">
                <div class="card card-click" id="card-{{ $loop->iteration }}">
                    <div class="card-body">
                        <label id="id_register" for="">{{ $p->id_register }}</label>
                        <h3 class="card-title text-center">{{ $p->data_jemaat->nama }}</h3>
                        <h6 class="text-center" for="">{{ $p->kategori_lomba->kategori_lomba }}</h6> 
                        <h1 class="card-text text-center">{{ $p->no_tampil }}</h1>
                        <input id="lagu_wajib" type="text" value="{{ $p->lagu_wajib }}" hidden>
                        <input id="lagu_pilihan" type="text" value="{{ $p->data_lagu->judul }}" hidden>
                     
                       
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    Daftar peserta tidak tersedia.
                </div>
            </div>
        @endforelse
    </div>


    <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold">LAGU WAJIB</h5>
            <p class ="mb-4" id="lagu-wajib-value"></p>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">INTONASI</label>
                  <input name="nama" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">VOCAL</label>
                  <input name="username" type="number" class="form-control" id="username">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">PARTITUR</label>
                  <input name="password" type="number" class="form-control" id="password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">KESAN ARTITISTIK</label>
                  <input name="password" type="number" class="form-control" id="password">
                </div>
              </div>
            </div>
           
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold">LAGU PILIHAN</h5>
          <p class="mb-4" id="lagu-pilihan-value"></p>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">INTONASI</label>
                  <input type="number" class="form-control" id="intonasi_pilihan" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">VOCAL</label>
                  <input type="number" class="form-control" id="vocal_pilihan">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">PARTITUR</label>
                  <input name="password" type="number" class="form-control" id="password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">KESAN ARTITISTIK</label>
                  <input name="password" type="number" class="form-control" id="password">
                </div>
              </div>
            </div>
          
         
        </div>
      </div>


      <button id="btn-submit" class="btn btn-primary">SIMPAN</button>

    </div>
  </div>


</div>



@endsection

