@extends('main.layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Selamat Datang, {{ session('user_data.username') }}</h3>
                
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    {{-- <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title fw-semibold mb-0">Ranking</h5>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div> --}}

    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Top Ranking</h5>
                <div class="table-responsive">
                    <table id="data-table" class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th><h6 class="fw-semibold mb-0">NO</h6></th>
                                <th><h6 class="fw-semibold mb-0">NO TAMPIL</h6></th>
                                <th><h6 class="fw-semibold mb-0">KATEGORI</h6></th>
                                <th><h6 class="fw-semibold mb-0">PESERTA</h6></th>
                                <th><h6 class="fw-semibold mb-0">MEDALI</h6></th>
                                <th><h6 class="fw-semibold mb-0">NILAI</h6></th>
                            </tr>
                        </thead>
                        
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
