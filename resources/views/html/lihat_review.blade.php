@extends('main.layout')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Log</h5>
                    <form method="POST" action="{{ route('log.filter') }}">
                    @csrf
                        <div class="row mb-4">
                            <div class="col-lg-5">
                                <select class="form-control" id="categories" name="kategori"></select>
                            </div>

                            <div class="col-lg-5">
                                <select class="form-control" id="jemaat" name="jemaat"></select>
                            </div>

                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">Cari Data</button>
                            </div>
                        </div>
                    </form>
              
            <div class="card mb-0">
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap mb-0 align-middle">
                                <thead class=" fs-4">
                                    <tr class="text-uppercase">
                                        <th scope="col">No</th>
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
                                    @php
                                        $rowNumber = 1;
                                    @endphp
                                    @forelse($data_logs as $key => $log)
                                        @foreach($log['reviews'] as $review)
                                            @foreach($review['data'] as $reviewData)
                                                <tr>
                                                    <td>{{ $rowNumber++ }}</td>
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
                                        <!-- <p>Medali: {{ $log['medali'] }}</p>
                                        <p>Nomor Tampil: {{ $log['nomor_tampil'] }}</p>
                                        <p>Total Final: {{ $log['total_final'] }}</p> -->
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No data available</td>
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
