@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Log</h5>

      <!-- Formulir Filter -->
      <div class="row mb-4">
        <div class="col-12 border border-1">
          <form class="border border-1"  method="GET" action="">

            <div class="row">
              <div class="col-md-2">
                <select class="form-control" id="kategori" name="kategori">
                  <option value="">Pilih Kategori</option>
                  <!-- Tambahkan opsi kategori di sini -->
                </select>
              </div>
              
              <div class="col-md-4">
                <select class="form-control" id="juri" name="juri">
                  <option value="">Pilih Juri</option>
                  <!-- Tambahkan opsi juri di sini -->
                </select>
              </div>
              <div class="col-md-4">
               
                <select class="form-control" id="jemaat" name="jemaat">
                  <option value="">Pilih Jemaat</option>
                  <!-- Tambahkan opsi jemaat di sini -->
                </select>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card mb-0">
        <div class="card-body">
          <div style="overflow-x: auto;">
            <table class="table table-striped fs-3">
              <thead>
                <tr class="text-uppercase">
                  <th scope="col">No Urut</th>
                  <th scope="col">Jemaat</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Medali</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
                  @foreach($data as $view)
                      <tr>
                          <td>{{ $view['nomor_tampil'] }}</td>
                          <td>{{ $view['jemaat'] }}</td>
                          <td>{{ $view['total_final'] }}</td>
                          <td>{{ $view['medali'] }}</td>
                          <td>
                              <a href="#"><i class="ti ti-download"></i></a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection
