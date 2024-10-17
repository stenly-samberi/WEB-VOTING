@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Created Number</h5>
    <div class="card">
      <div class="card-body">
      @include('alert.message')
        <div class="container">
          <div class="row justify-content-start">
         
          <div class="col-lg-2">
              <form action="{{ route('nomor_tampil.generateRandomOrder') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Generated</button>
              </form>
          </div>

          <div class="col-lg-2">
            <form action="{{ route('nomor_tampil.reset') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger">Reset</button>
            </form>
          </div>

        
          </div>
        </div>
      </div>
    </div>
    

    <div class="row" id="peserta-container">
      
    </div>
    
     
   
  </div>
</div>


@endsection



