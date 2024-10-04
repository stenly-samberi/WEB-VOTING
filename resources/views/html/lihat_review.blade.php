@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Log</h5>

      <!-- Formulir Filter -->
      <form method="GET" action="">
        <div class="row mb-4">

          <div class="col-lg-3">
            <select class="form-select" id="kategori" name="kategori">
              <option value="">Pilih Kategori</option>
              <option value="">PAM</option>
              <option value="">PAR</option>
            </select>
          </div>

          <div class="col-lg-3">
            <select class="form-select" id="juri" name="juri">
              <option value="">Pilih Juri</option>
              <option value="">Stenly</option>
              <option value="">Matias</option>
            </select>
          </div>

          <div class="col-lg-3">
            <select class="form-select" id="jemaat" name="jemaat">
              <option value="">Pilih Jemaat</option>
              <option value="">Kalvari Tembagapura</option>
              <option value="">Viadolorosa</option>
            </select>
          </div>

          <div class="col-lg-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
          </div>

        </div>
      </form>

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
              @foreach($data as $key1 => $view)
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
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection
