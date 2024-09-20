@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Penilaian</h5>
    
    <div class="row" id="review-container">
       
    </div>


    <div class="card">
        <div class="card-body">
          <h5 id="title_lagu_wajib" class="card-title fw-semibold">LAGU WAJIB</h5>
            <p class ="mb-4" id="lagu-wajib-value"></p>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">INTONASI</label>
                  <input name="nama" type="number" class="form-control" id="intonasi_lagu_wajib" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">VOCAL</label>
                  <input name="username" type="number" class="form-control" id="vocal_lagu_wajib">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">PARTITUR</label>
                  <input name="password" type="number" class="form-control" id="partitur_lagu_wajib">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">KESAN ARTITISTIK</label>
                  <input name="password" type="number" class="form-control" id="kesan_artistik_lagu_wajib">
                </div>
              </div>
            </div>
           
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 id="title_lagu_pilihan" class="card-title fw-semibold">LAGU PILIHAN</h5>
          <p class="mb-4" id="lagu-pilihan-value"></p>
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">INTONASI</label>
                  <input type="number" class="form-control" id="intonasi_lagu_pilihan" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">VOCAL</label>
                  <input type="number" class="form-control" id="vocal_lagu_pilihan">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">PARTITUR</label>
                  <input name="password" type="number" class="form-control" id="partitur_lagu_pilihan">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">KESAN ARTITISTIK</label>
                  <input name="password" type="number" class="form-control" id="artitistik_lagu_pilihan">
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

