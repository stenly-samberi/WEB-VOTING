@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Log</h5>

      <div class="card mb-0">
        <div class="card-body">
          <!-- Tambahkan div dengan overflow-x: auto -->
          <div style="overflow-x: auto;">
            <table class="table table-striped fs-3">
              <thead>
                <tr class="text-uppercase">
                  <th scope="col">No Urut</th>
                  <th scope="col">Jemaat</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Medali</th>
                </tr>
              </thead>
              <tbody>
              @foreach($data as $key => $view)
                    <tr>
                        <td>{{ $view['nomor_tampil'] }}</td>
                        <td>{{ $view['jemaat'] }}</td>
                        <td>{{ $view['total_final'] }}</td>
                        <td>{{ $view['medali'] }}</td>
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
