@extends('petugas.petugas_dashboard')
@section('petugas')
    <div class="page-content">
        <div class="card radius-8">
            <div class="card-header bg-transparent">
                <form method="GET" action="{{ route('petugas.laporan') }}"
                    class="d-flex align-items-center justify-content-between flex-wrap row">

                    <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent">
                                <a href="{{(request('search') || request('filter')) ? url('/petugas/laporan') : ''}}"
                                    style="color:inherit; {{(request('search') || request('filter')) ? '' : 'pointer-events:none;'}}"><i
                                        class="bx bx-{{(request('search') || request('filter')) ? 'refresh' : 'search'}}"></i></a>
                            </span>
                            <input type="text" class="form-control" placeholder="Search" name="search">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 my-2 d-flex justify-content-end order-1 order-md-2">
                        <button type="button" class="btn btn-primary px-4 ms-2" data-bs-toggle="modal"
                            data-bs-target="#downloadRekapModal">
                            <i class="bx bx-user-plus"></i> Download Rekap
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>

                                <td>Id</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>No Telphone</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Download</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftarans as $pendaftaran)
                                <tr>

                                    <td style="white-space: nowrap; width: 1%;">{{$pendaftaran->id}}</td>
                                    <td>{{$pendaftaran->nama_lengkap}}</td>
                                    <td>{{$pendaftaran->nisn}}</td>
                                    <td>{{$pendaftaran->telepon}}</td>
                                    <td>{{$pendaftaran->created_at->format('d-m-Y')}}</td>
                                    <td id="status-{{ $pendaftaran->id }}"
                                        class="text-white
                                                                                                                                                        @if ($pendaftaran->status_pendaftaran == 'valid') bg-success
                                                                                                                                                        @elseif ($pendaftaran->status_pendaftaran == 'tidak_valid') bg-danger
                                                                                                                                                        @elseif ($pendaftaran->status_pendaftaran == 'pending') bg-warning
                                                                                                                                                            @else bg-secondary
                                                                                                                                                        @endif">
                                        @switch($pendaftaran->status_pendaftaran)
        @case('valid')
            Terverifikasi
            @break
        @case('tidak_valid')
            Tidak Terverifikasi
            @break
        @case('pending')
            Menunggu Verifikasi
            @break
        @default
            Belum Diatur
    @endswitch
                                    </td>
                                    <td>
                                        <div class="d-flex">

                                            <button class="btn btn-sm btn-success"
                                                onclick="window.location='{{ route('petugas.download.formulir', $pendaftaran->id) }}'">
                                                <i class="bx bx-download"></i>
                                            </button>
                                        </div>
                                    </td>




                                </tr>



                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Download Rekap -->
    <div class="modal fade" id="downloadRekapModal" tabindex="-1" aria-labelledby="rekapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" action="{{ route('petugas.download.rekap') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rekapModalLabel">Download Rekap Pendaftaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Download CSV</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection