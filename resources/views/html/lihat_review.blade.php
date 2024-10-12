@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Log</h5>

      <!-- Formulir Filter -->
      <div class="row mb-4">
        <div class="col-12">
          <method="GET" action="">

            <div class="row">
              <div class="col-md-4">
                <select class="form-control" id="kategori" name="kategori">
                  <option value="">Pilih Kategori</option>
                  <!-- Tambahkan opsi kategori di sini -->
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

              <div class="col-md-2">
                <button type="submit" class="btn btn-success">Download</button>
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
                  <th scope="col">Juri</th>
                  <th scope="col">genre</th>
                  <th scope="col">Jemaat</th>
                  <th scope="col">LAGU</th>
                  <th scope="col">Intonasi</th>
                  <th scope="col">Vocal</th>
                  <th scope="col">partitur</th>
                  <th scope="col">artitistik</th>
                  <th scope="col">nilai</th>
                  
                </tr>
              </thead>
              
              <tbody>
                  @foreach($data as $v)
                      <tr>
                          <td>{{ $v['user']['name'] }}</td>
                          <td>{{ $v['genre_lagu'] }}</td>
                          <td>{{ $v['jemaat']['nama'] }}</td>
                          <td>{{ $v['judul_lagu'] }}</td>
                          <td>{{ $v['intonasi'] }}</td>
                          <td>{{ $v['vocal'] }}</td>
                          <td>{{ $v['partitur'] }}</td>
                          <td>{{ $v['artitistik'] }}</td>
                          <td>{{ $v['nilai'] }}</td>
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
