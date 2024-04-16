@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Forms</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('data_jemaat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Jemaat</label>
              <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Kategori</label>
              <select class="form-control" name="kategori" id="kategori">
                  <option value="">Pilih Kategori</option>
                  @foreach($datakategori as $item)
                      <option value="{{ $item->id_kjemaat }}">{{ $item->kategori }}</option>
                  @endforeach
              </select>
            </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>



      <h5 class="card-title fw-semibold mb-4">Data Jemaat</h5>

      <div class="card mb-0">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Name Jemaat</th>
                <th scope="col">Ketegori</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($datajemaat as $key => $data)
              <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->kategori_jemaat->kategori }}</td>
                  <td>{{ $data->created_at }}</td>
                  <td>{{ $data->updated_at }}</td>
                  <td>
                      <form action="{{ route('data_jemaat.destroy', $data->id_kjemaat) }}" method="POST">
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
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
            </tbody>
          </table>
         
        </div>
       
      </div>
      
    </div>
  </div>
</div>
@endsection



