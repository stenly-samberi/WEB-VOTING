@extends('main.layout')
@section('content')

<style>
    .text-right {
        text-align: right;
    }
</style>


<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Log</h5>
                    <form method="POST" action="{{ route('log.filter') }}">
                    @csrf
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <select class="form-control" id="categories" name="kategori"></select>
                            </div>

                            <div class="col-lg-6">
                                <select class="form-control" id="jemaat" name="jemaat"></select>
                            </div>

                            <div class="col-lg-1">
                                <button type="submit" class="btn btn-success m-0">Filter</button>
                            </div>

                            <div class="col-lg-2">
                                <button class="btn btn-danger" id="btnCetak">Cetak Data</button>
                            </div>
                        </div>
                    </form>

                    

            <div class="card mb-0" id="cetakTabel">
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class=" fs-4">
                                    <tr class="text-uppercase">
                                        <th scope="col">No</th>
                                        <th scope="col">Juri</th>
                                        <th scope="col">Lagu / jenis</th>
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
                                                    <td>{{ $reviewData['judul_lagu'] }}</td>
                                                    <td>{{ $reviewData['intonasi'] }}</td>
                                                    <td>{{ $reviewData['vocal'] }}</td>
                                                    <td>{{ $reviewData['partitur'] }}</td>
                                                    <td>{{ $reviewData['artitistik'] }}</td>
                                                    <td>{{ $reviewData['nilai'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach

                                        <tr>
                                            <td colspan="2"><b>Peserta</b></td>
                                            <td>{{ $log['peserta'] }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><b>Kategori</b></td>
                                            <td>{{ $log['kategori'] }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><b>Medali</b></td>
                                            <td>{{ $log['medali'] }}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><b>Total Keseluruhan</b></td>
                                            <td>{{ $log['total_final'] }}</td>
                                        </tr>
                                        
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
