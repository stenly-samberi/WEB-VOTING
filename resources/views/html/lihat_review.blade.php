@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Hasil Perolehan</h5>

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
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($data as $key => $view)
                    <tr>
                        <td>{{ $view['nomor_tampil'] }}</td>
                        <td>{{ $view['jemaat'] }}</td>
                        <td>{{ $view['total_final'] }}</td>
                        <td>{{ $view['medali'] }}</td>

                        <td>

                                <a class ="primary btn btn-primary btn-sm" href="">Edit</a>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="primary btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
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
