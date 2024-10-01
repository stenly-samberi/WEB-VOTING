@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Dash Setting</h5>
    <div class="card mb-0">
      <div class="card-body">
        
        <!-- <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Judul</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lomba as $key => $lagu)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $lagu->kategori_lomba }}</td>
                <td>
                    <form action="{{ route('dash.dash_updated', $lagu->id_kategori_lomba) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                          <i class="ti ti-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
          @empty
              <tr>
                  <td colspan="5" class="text-center">Tidak ada data</td>
              </tr>
          @endforelse
          </tbody>
        </table> -->

        <div class="row" id="category-container">
      
        </div>
       
      </div>
     
    </div>
  </div>
</div>
@endsection

