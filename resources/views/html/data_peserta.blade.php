@extends('main.layout')

@section('content')
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Data Peserta</h5>
        <div class="card mb-0">
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Jemaat</th>
                  <th scope="col">Lagu</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Kordinator</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Register</th>
                  <th scope="col">Status</th>
                  <th scope="col">Doc</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($peserta as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->data_jemaat->nama }}</td>
                    <td>{{ $user->data_lagu->judul }}</td>
                    <td>{{ $user->kategori_lomba->kategori_lomba }}</td>
                    <td>{{ $user->kordinator }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>{{ $user->status }}</td>
                    <td>{{ $user->file }}</td>
                  
                    <td>
                        <form action="{{ route('peserta.destroy', $user->id_register) }}" method="POST">
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