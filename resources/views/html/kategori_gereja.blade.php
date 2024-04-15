@extends('main.layout')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Forms</h5>
    <div class="card">
      <div class="card-body">
        @include('alert.message')
        <form action="{{ route('kategori_jemaat.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
              <th scope="col">Kategori</th>
              <th scope="col">Created at</th>
              <th scope="col">Updated at</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($kategoriJemaat as $key => $kategori)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $kategori->kategori }}</td>
                <td>{{ $kategori->created_at }}</td>
                <td>{{ $kategori->updated_at }}</td>
                <td>
                    <form action="{{ route('kategori_jemaat.destroy', $kategori->id_kjemaat) }}" method="POST">
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
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

