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
                  <th scope="col">NO</th>
                  <th scope="col">JEMAAT</th>
                  <th scope="col">KATEGORI</th>
                  <th scope="col">LAGU WAJIB</th>
                  <th scope="col">LAGU PILIHAN</th>
                  {{-- <th scope="col">Kordinator</th>
                  <th scope="col">Phone</th> --}}
                  {{-- <th scope="col">Tanggal Daftar</th> --}}
                  <th scope="col">MORE ACTION</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($peserta as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->data_jemaat->nama }}</td>
                    <td>{{ $user->kategori_lomba->kategori_lomba }}</td>
                    <td>{{ $user->lagu_wajib }}</td>
                    <td>{{ $user->data_lagu->judul }}</td>
                    {{-- <td>{{ $user->kordinator }}</td>
                    <td>{{ $user->phone }}</td> --}}
                    {{-- <td>{{ $user->created_at->format('d M Y') }}</td> --}}
                    {{-- <td>{{ $user->status }}</td>
                    <td>{{ $user->file }}</td> --}}
                  
                    <td class="d-flex">
                        <form action="{{ route('peserta.destroy', $user->id_register) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>

                        <form action="{{ route('peserta.detail') }}" method="POST">
                            @csrf
                            <input name="idP" value="{{ $user->id_register }}" type="text" hidden>
                            <button type="submit" class="btn btn-success search-button">
                                <i class="ti ti-search"></i>
                            </button>
                        </form>

                        
                    </td>

                    
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data</td>
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