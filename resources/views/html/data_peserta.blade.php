@extends('main.layout')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    @include('alert.message')
                  
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_njemaat" class="form-label">Nama Jemaat</label>
                                <select class="form-control" required id="jemaat-select">
                                  <option value="">Pilihan</option>
                                </select>
                                <label style="color: red; display: none;" id="namaError" for="">Nama Jemaat</label>
                                
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kordinator" class="form-label">Kordinator</label>
                                <input type="text" placeholder="Ex. Stenly Samberi" name="kordinator" class="form-control" id="kordinator-input" required>
                                <label style="color: red; display: none;" id="kordinatorError" for="">Nama Jemaat</label>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" placeholder="Ex. 081224xxxxx" name="phone" class="form-control" id="phone-input" required>
                                <label style="color: red; display: none;" id="phoneError" for="">Nama Jemaat</label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-control" required name="#" id="kategori-select">
                                  <option value="">Pilihan</option>
                              </select>
                              <label style="color: red; display: none;" id="kategoriError" for="">Nama Jemaat</label>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="laguWajib" class="form-label">Lagu Wajib</label>
                                <input disabled type="text" name="laguWajib" class="form-control" id="lagu-wajib" required>
                                <label style="color: red; display: none;" id="wajibError" for="">Nama Jemaat</label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="laguPilihan" class="form-label">Lagu Pilihan</label>
                                <select class="form-control" required name="#" id="lagu-pilihan">
                                  <option value="">Pilihan</option>
                              </select>
                              <label style="color: red; display: none;" id="pilihanError" for="">Nama Jemaat</label>
                                
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary" id="btn-daftar">Daftar Sekarang</button>
                   
                </div>
            </div>

           
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

                                    <form action="{{ route('peserta.detail') }}" method="POST" class="ms-2">
                                        @csrf
                                        <input name="idP" value="{{ $user->id_register }}" type="hidden">
                                        <button type="submit" class="btn btn-success search-button">
                                            <i class="ti ti-edit"></i>
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
