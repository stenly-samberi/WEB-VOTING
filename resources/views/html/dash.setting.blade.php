@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Dash Setting</h5>
    <div class="card">
      <div class="card-body">
        @include('alert.message')
        <form action="{{ route('nomor_tampil.generateRandomOrder') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Auto Generated</button>
        </form>
      </div>
    </div>
    

    <div class="row" id="peserta-container">
      
    </div>
    
     
   
  </div>
</div>


@endsection



