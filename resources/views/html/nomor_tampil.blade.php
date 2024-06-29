@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Created Number</h5>
    <div class="card">
      <div class="card-body">
        @include('alert.message')
        <form action="{{ route('nomor_tampil.generateRandomOrder') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Auto Generated</button>
        </form>
      </div>
    </div>
    

    <div class="row">
        @forelse ($peserta as $p)
            <div class="col-md-4 mb-1">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $p->data_jemaat->nama }}</h3>
                        {{-- <p class="card-text">Jemaat: {{ $p->jemaat }}</p> --}}
                        <h1 class="card-text text-center">{{ $p->no_tampil }}</h1>
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
    
     
   
  </div>
</div>
@endsection

