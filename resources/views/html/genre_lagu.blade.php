@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Daftar Lagu</h5>
    <div class="card">
      <div class="card-body">
        @include('alert.message')
        <form action="{{ route('genre_lagu.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Genre</label>
            <select class="form-control" name="genre" id="kategori">
              <option value="">Pilih Genre</option>
              <option value="pilihan">Pilihan</option>
              <option value="wajib">Wajib</option>
              
          </select>
            {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
          </div>
         
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
    <h5 class="card-title fw-semibold mb-4">Disabled forms</h5>
    <div class="card mb-0">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">Judul</th>
              <th scope="col">Genre</th>
              <th scope="col">Created at</th>
              <th scope="col">Updated at</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($genre as $key => $lagu)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $lagu->judul }}</td>
                <td>{{ $lagu->genre }}</td>
                <td>{{ $lagu->created_at }}</td>
                <td>{{ $lagu->updated_at }}</td>
                <td>
                    <form action="{{ route('genre_lagu.destroy',$lagu->id_lagu) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
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
           {{-- {{ $genre->links() }} --}}
        </table>
       
      </div>
     
    </div>
  </div>
</div>
@endsection

