@extends('main.layout')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Log</h5>
         
            <div class="row mb-4">
                <div class="col-12">
                    <form method="POST" action="{{route('log.filter'}}">
                    @csrf
                        <div class="row border border-1">
                            <div class="col-md-4">
                                <select class="form-control" id="categories" name="kategori"></select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="jemaat" name="jemaat"></select>
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
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr class="text-uppercase">
                                        <th scope="col">Juri</th>
                                        <th scope="col">Jemaat</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Lagu</th>
                                        <th scope="col">Intonasi</th>
                                        <th scope="col">Vocal</th>
                                        <th scope="col">Partitur</th>
                                        <th scope="col">Artitistik</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_logs as $key => $log)
                                        @foreach($log['reviews'] as $review)
                                            @foreach($review['data'] as $reviewData)
                                                <tr>
                                                    <td>{{ $reviewData['user']['name'] }}</td>
                                                    <td>{{ $reviewData['jemaat']['nama'] }}</td>
                                                    <td>{{ $reviewData['genre_lagu'] }}</td>
                                                    <td>{{ $reviewData['judul_lagu'] }}</td>
                                                    <td>{{ $reviewData['intonasi'] }}</td>
                                                    <td>{{ $reviewData['vocal'] }}</td>
                                                    <td>{{ $reviewData['partitur'] }}</td>
                                                    <td>{{ $reviewData['artitistik'] }}</td>
                                                    <td>{{ $reviewData['nilai'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <p>Medali: {{ $log['medali'] }}</p>
                                        <p>Nomor Tampil: {{ $log['nomor_tampil'] }}</p>
                                        <p>Total Final: {{ $log['total_final'] }}</p>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
