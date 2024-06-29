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
                <h5 class="card-title fw-semibold mb-4">Top 10 Ranking</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th><h6 class="fw-semibold mb-0">No Tampil</h6></th>
                                <th><h6 class="fw-semibold mb-0">Peserta</h6></th>
                                <th><h6 class="fw-semibold mb-0">Lagu</h6></th>
                                <th><h6 class="fw-semibold mb-0">Medali</h6></th>
                                <th><h6 class="fw-semibold mb-0">Nilai</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h6 class="fw-semibold mb-0">1</h6></td>
                                <td>
                                    <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                    <span class="fw-normal">Web Designer</span>
                                </td>
                                <td><p class="mb-0 fw-normal">Elite Admin</p></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Gold</span>
                                    </div>
                                </td>
                                <td><h6 class="fw-semibold mb-0 fs-4">95</h6></td>
                            </tr>
                            <tr>
                                <td><h6 class="fw-semibold mb-0">2</h6></td>
                                <td>
                                    <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td><p class="mb-0 fw-normal">Real Homes WP Theme</p></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary rounded-3 fw-semibold">Silver</span>
                                    </div>
                                </td>
                                <td><h6 class="fw-semibold mb-0 fs-4">90</h6></td>
                            </tr>
                            <tr>
                                <td><h6 class="fw-semibold mb-0">3</h6></td>
                                <td>
                                    <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td><p class="mb-0 fw-normal">MedicalPro WP Theme</p></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-3 fw-semibold">Browns</span>
                                    </div>
                                </td>
                                <td><h6 class="fw-semibold mb-0 fs-4">12.8</h6></td>
                            </tr>
                            <tr>
                                <td><h6 class="fw-semibold mb-0">4</h6></td>
                                <td>
                                    <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                                    <span class="fw-normal">Frontend Engineer</span>
                                </td>
                                <td><p class="mb-0 fw-normal">Hosting Press HTML</p></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success rounded-3 fw-semibold">Browns</span>
                                    </div>
                                </td>
                                <td><h6 class="fw-semibold mb-0 fs-4">2.4</h6></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
