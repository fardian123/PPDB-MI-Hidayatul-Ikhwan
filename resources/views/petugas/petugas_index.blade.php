@extends('petugas.petugas_dashboard')

@section('petugas')
    <div class="page-content">

        <div class="row">
            <!-- Card: Pendaftar Terbaru -->


            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">🆕 Pendaftar Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftarTerbaru as $pendaftar)
                                    <tr>
                                        <td>{{ $pendaftar->nama_lengkap }}</td>
                                        <td>{{ $pendaftar->nisn }}</td>
                                        <td>
                                            <span class="badge 
                                                            @if($pendaftar->status_pendaftaran == 'valid') bg-success
                                                            @elseif($pendaftar->status_pendaftaran == 'tidak valid') bg-danger
                                                            @else bg-warning @endif">
                                                {{ ucfirst($pendaftar->status_pendaftaran) }}
                                            </span>
                                        </td>         
                                    </tr>
                                @endforeach
                                @if ($pendaftarTerbaru->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada pendaftar.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Card: Statistik Verifikasi -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">📊 Statistik Verifikasi ({{ $bulanLabel }})</h5>
                    </div>
                    <div class="card-body" style="height: 350px;">
                        <canvas id="pieChartVerifikasi" style="width:100%; height:100%;"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pieChartVerifikasi').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Valid', 'Tidak Valid', 'Pending'],
                datasets: [{
                    label: 'Status Verifikasi',
                    data: [{{ $valid }}, {{ $tidak_valid }}, {{ $pending }}],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush