@extends('petugas.petugas_dashboard')
@section('petugas')


    <div class="page-content">
        <div class="card radius-8">
            <div class="card-header bg-transparent">
                <form method="GET" action="{{ route('petugas.master_peserta_didik') }}"
                    class="d-flex align-items-center justify-content-between flex-wrap row">

                    <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent">
                                <a href="{{(request('search') || request('filter')) ? url('/petugas/master-peserta-didik') : ''}}"
                                    style="color:inherit; {{(request('search') || request('filter')) ? '' : 'pointer-events:none;'}}"><i
                                        class="bx bx-{{(request('search') || request('filter')) ? 'refresh' : 'search'}}"></i></a>
                            </span>
                            <input type="text" class="form-control" placeholder="Search" name="search">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 my-2 d-flex justify-content-end order-1 order-md-2">
                        <button type="button" class="btn btn-primary px-4 ms-2" data-bs-toggle="modal"
                            data-bs-target="#tambahPendaftarModal">
                            <i class="bx bx-user-plus"></i> Tambah Pendaftar
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
                                <th>Action</th>
                                <th>Edit Status</th>
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

                                    <td style="white-space: nowrap; width: 1%;">
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalLihatData-{{$pendaftaran->id}}">
                                                <i class="bx bx-receipt"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEditData-{{$pendaftaran->id}}">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusData-{{$pendaftaran->id}}">
                                                <i class="bx bx-trash"></i>
                                            </button>

                                            <button class="btn btn-sm btn-success"
                                                onclick="window.location='{{ route('petugas.download.formulir', $pendaftaran->id) }}'">
                                                <i class="bx bx-download"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td style="white-space: nowrap; width: 1%;">

                                        <select class="form-select form-select-sm w-auto"
                                            onchange="updateStatus({{ $pendaftaran->id }}, this.value)">
                                            <option disabled selected>Ubah Status</option>
                                            <option value="valid" {{ $pendaftaran->status_pendaftaran == 'valid' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="tidak_valid" {{ $pendaftaran->status_pendaftaran == 'tidak_valid' ? 'selected' : '' }}>Verifikasi Ditolak</option>
                                            <option value="pending" {{ $pendaftaran->status_pendaftaran == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        </select>

                                    </td>
                                </tr>

                                <!-- Modal Lihat Data -->

                                <div class="modal fade" id="modalLihatData-{{$pendaftaran->id}}" tabindex="-1"
                                    aria-labelledby="modalLihatData-{{$pendaftaran->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLihatData-{{$pendaftaran->id}}Label">Lihat Data
                                                    Pendaftaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap:</label>
                                                    <p><strong>{{ $pendaftaran->nama_lengkap ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">NISN:</label>
                                                    <p><strong>{{ $pendaftaran->nisn ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">NIK:</label>
                                                    <p><strong>{{ $pendaftaran->nik ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Kartu Keluarga:</label>
                                                    <p><strong>{{ $pendaftaran->nomor_kk ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin:</label>
                                                    <p><strong>{{ $pendaftaran->jenis_kelamin ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tempat Lahir:</label>
                                                    <p><strong>{{ $pendaftaran->tempat_lahir ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir:</label>
                                                    <p><strong>{{ $pendaftaran->tanggal_lahir ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Agama:</label>
                                                    <p><strong>{{ $pendaftaran->agama ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status Keluarga:</label>
                                                    <p><strong>{{ $pendaftaran->status_keluarga ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Anak Keberapa:</label>
                                                    <p><strong>{{ $pendaftaran->anak_ke ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Berat Badan (kg):</label>
                                                    <p><strong>{{ $pendaftaran->berat_badan ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tinggi Badan (cm):</label>
                                                    <p><strong>{{ $pendaftaran->tinggi_badan ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat Tempat Tinggal:</label>
                                                    <p><strong>{{ $pendaftaran->alamat ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bertempat Tinggal Pada:</label>
                                                    <p><strong>{{ $pendaftaran->bertempat_tinggal_pada ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor HP:</label>
                                                    <p><strong>{{ $pendaftaran->telepon ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <!-- Keterangan Pendidikan Sebelumnya -->
                                                <h5>Keterangan Pendidikan Sebelumnya</h5>
                                                <div class="mb-3">
                                                    <label class="form-label">Asal Sekolah:</label>
                                                    <p><strong>{{ $pendaftaran->asal_sekolah ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal/No Ijazah:</label>
                                                    <p><strong>{{ $pendaftaran->tgl_ijazah ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Lama Belajar:</label>
                                                    <p><strong>{{ $pendaftaran->lama_belajar ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Diterima:</label>
                                                    <p><strong>{{ $pendaftaran->tanggal_diterima ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kelas Diterima:</label>
                                                    <p><strong>{{ $pendaftaran->kelas_diterima ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <!-- Keterangan Orang Tua  -->
                                                <h5>Keterangan Orang Tua </h5>
                                                <div class="mb-3">
                                                    <label class="form-label">NIK Ayah:</label>
                                                    <p><strong>{{ $pendaftaran->nik_ayah ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">NIK ibu:</label>
                                                    <p><strong>{{ $pendaftaran->nik_ibu ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status ibu:</label>
                                                    <p><strong>{{ $pendaftaran->status_ayah ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status ibu:</label>
                                                    <p><strong>{{ $pendaftaran->status_ibu ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Ayah:</label>
                                                    <p><strong>{{ $pendaftaran->nama_ayah ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Ibu:</label>
                                                    <p><strong>{{ $pendaftaran->nama_ibu ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pendidikan Ayah:</label>
                                                    <p><strong>{{ $pendaftaran->pendidikan_ayah ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pendidikan Ibu:</label>
                                                    <p><strong>{{ $pendaftaran->pendidikan_ibu ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pekerjaan Ayah:</label>
                                                    <p><strong>{{ $pendaftaran->pekerjaan_ayah ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pekerjaan Ibu:</label>
                                                    <p><strong>{{ $pendaftaran->pekerjaan_ibu ?? 'Belum ada data' }}</strong>
                                                    </p>
                                                </div>
                                                <!-- Keterangan Wali  -->
                                                <div class="wali-section">
                                                    <h5>Keterangan Wali </h5>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Wali Murid:</label>
                                                        <p><strong>{{ $pendaftaran->nama_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Hubungan Wali:</label>
                                                        <p><strong>{{ $pendaftaran->hubungan_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Pekerjaan Wali:</label>
                                                        <p><strong>{{ $pendaftaran->pekerjaan_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">pendidikan Wali:</label>
                                                        <p><strong>{{ $pendaftaran->pendidikan_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat Wali:</label>
                                                        <p><strong>{{ $pendaftaran->alamat_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kewarganegaraan:</label>
                                                        <p><strong>{{ $pendaftaran->kewarganegaraan ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor HP Wali:</label>
                                                        <p><strong>{{ $pendaftaran->telepon_wali ?? 'Belum ada data' }}</strong>
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Kartu yang Dimiliki -->
                                                <h5>Kartu yang Dimiliki</h5>
                                                <div class="mb-3">
                                                    <label class="form-label">No KIP:</label>
                                                    <p><strong>{{ $pendaftaran->KIP ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">No KKS:</label>
                                                    <p><strong>{{ $pendaftaran->KKS ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">No KIS:</label>
                                                    <p><strong>{{ $pendaftaran->KIS ?? 'Belum ada data' }}</strong></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Delete Pendaftaran -->
                                <div class="modal fade" id="modalHapusData-{{$pendaftaran->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-light" id="exampleModalLabel">Hapus Pendaftaran</h5>
                                            </div>
                                            <form action="{{ route('petugas.hapus.pendaftaran')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pendaftaran->id }}">


                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus pendaftaran ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit Pendaftaran -->
                                <div class="modal fade" id="modalEditData-{{$pendaftaran->id}}" tabindex="-1"
                                    aria-labelledby="modalEditData-{{$pendaftaran->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditData-{{$pendaftaran->id}}Label">Edit
                                                    Pendaftaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('petugas.update.pendaftaran', $pendaftaran->id) }}">
                                                    @csrf
                                                    <!-- 1. Keterangan Anak -->
                                                    <h5 class="mt-4">Keterangan Anak</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                                                placeholder="Nama Lengkap"
                                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                                value="{{ old('nama_lengkap', optional($pendaftaran)->nama_lengkap) }}">
                                                            @error('nama_lengkap')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nisn" class="form-label">NISN</label>
                                                            <input type="number" name="nisn" id="nisn" placeholder="Nomor Nisn"
                                                                class="form-control @error('nisn') is-invalid @enderror"
                                                                value="{{ old('nisn', optional($pendaftaran)->nisn) }}">
                                                            @error('nisn')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nik" class="form-label">Nomor NIK</label>
                                                            <input type="number" name="nik" id="nik" placeholder="Nomor nik"
                                                                class="form-control @error('nik') is-invalid @enderror"
                                                                value="{{ old('nik', optional($pendaftaran)->nik) }}">
                                                            @error('nik')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nomor_kk" class="form-label">Nomor Kartu
                                                                Keluarga</label>
                                                            <input type="number" name="nomor_kk" id="nomor_kk"
                                                                placeholder="Nomor nomor_kk"
                                                                class="form-control @error('nomor_kk') is-invalid @enderror"
                                                                value="{{ old('nomor_kk', optional($pendaftaran)->nomor_kk) }}">
                                                            @error('nomor_kk')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                <option value="Laki-laki" {{ old('jenis_kelamin', optional($pendaftaran)->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                                </option>
                                                                <option value="Perempuan" {{ old('jenis_kelamin', optional($pendaftaran)->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                                </option>
                                                            </select>
                                                            @error('jenis_kelamin')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tempat_lahir" class="form-label">Kota Kelahiran</label>
                                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                                placeholder="Jakarta, Bandung"
                                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                                placeholder="Contoh: Jakarta"
                                                                value="{{ old('tempat_lahir', optional($pendaftaran)->tempat_lahir) }}">
                                                            @error('tempat_lahir')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                                placeholder="Tanggal Lahir"
                                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                                value="{{ old('tanggal_lahir', optional($pendaftaran)->tanggal_lahir) }}">
                                                            @error('tanggal_lahir')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="agama" class="form-label">Agama</label>
                                                            <input type="text" name="agama" id="agama" placeholder="Islam"
                                                                class="form-control @error('agama') is-invalid @enderror"
                                                                value="{{ old('agama', optional($pendaftaran)->agama) }}">
                                                            @error('agama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="status_keluarga" class="form-label">Status
                                                                Keluarga</label>
                                                            <input type="text" name="status_keluarga" id="status_keluarga"
                                                                placeholder="Anak Kandung"
                                                                class="form-control @error('status_keluarga') is-invalid @enderror"
                                                                value="{{ old('status_keluarga', optional($pendaftaran)->status_keluarga) }}">
                                                            @error('status_keluarga')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="anak_ke" class="form-label">Anak Keberapa</label>
                                                            <input type="number" name="anak_ke" id="anak_ke" placeholder="1,2,3"
                                                                class="form-control @error('anak_ke') is-invalid @enderror"
                                                                value="{{ old('anak_ke', optional($pendaftaran)->anak_ke) }}">
                                                            @error('anak_ke')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                                            <input type="number" name="berat_badan" id="berat_badan"
                                                                class="form-control @error('berat_badan') is-invalid @enderror"
                                                                value="{{ old('berat_badan', optional($pendaftaran)->berat_badan) }}">
                                                            @error('berat_badan')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="tinggi_badan" class="form-label">Tinggi Badan
                                                                (cm)</label>
                                                            <input type="number" name="tinggi_badan" id="tinggi_badan"
                                                                class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                                value="{{ old('tinggi_badan', optional($pendaftaran)->tinggi_badan) }}">
                                                            @error('tinggi_badan')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                                            <textarea name="alamat" id="alamat"
                                                                placeholder="Jl. Padat Karya Kampung Kandang, Mekarwangi, KEC. CISAUK."
                                                                class="form-control @error('alamat') is-invalid @enderror"
                                                                rows="2">{{ old('alamat', optional($pendaftaran)->alamat) }}</textarea>
                                                            @error('alamat')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="bertempat_tinggal_pada" class="form-label">Bertempat
                                                                Tinggal Pada</label>
                                                            <input type="text" name="bertempat_tinggal_pada"
                                                                id="bertempat_tinggal_pada"
                                                                class="form-control @error('bertempat_tinggal_pada') is-invalid @enderror"
                                                                value="{{ old('bertempat_tinggal_pada', optional($pendaftaran)->bertempat_tinggal_pada) }}">
                                                            @error('bertempat_tinggal_pada')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="telepon" class="form-label">Nomor HP</label>
                                                            <input type="number" name="telepon" id="telepon"
                                                                class="form-control @error('telepon') is-invalid @enderror"
                                                                value="{{ old('telepon', optional($pendaftaran)->telepon) }}">
                                                            @error('telepon')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- 2. Keterangan Pendidikan Sebelumnya Kosongkan jika Tidak ada-->
                                                    <h5 class="mt-4">Keterangan Pendidikan Sebelumnya</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                                            <input type="text" name="asal_sekolah" id="asal_sekolah"
                                                                class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                                placeholder="SD / RA"
                                                                value="{{ old('asal_sekolah', optional($pendaftaran)->asal_sekolah) }}">
                                                            @error('asal_sekolah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tgl_ijazah" class="form-label">Tanggal/No Ijazah</label>
                                                            <input type="text" name="tgl_ijazah" id="tgl_ijazah"
                                                                class="form-control @error('tgl_ijazah') is-invalid @enderror"
                                                                value="{{ old('tgl_ijazah', optional($pendaftaran)->tgl_ijazah) }}">
                                                            @error('tgl_ijazah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="lama_belajar" class="form-label">Lama Belajar</label>
                                                            <input type="text" name="lama_belajar" id="lama_belajar"
                                                                class="form-control @error('lama_belajar') is-invalid @enderror"
                                                                value="{{ old('lama_belajar', optional($pendaftaran)->lama_belajar) }}">
                                                            @error('lama_belajar')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tanggal_diterima" class="form-label">Tanggal
                                                                Diterima</label>
                                                            <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                                                class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                                                value="{{ old('tanggal_diterima', optional($pendaftaran)->tanggal_diterima) }}">
                                                            @error('tanggal_diterima')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="kelas_diterima" class="form-label">Kelas
                                                                Diterima</label>
                                                            <input type="text" name="kelas_diterima" id="kelas_diterima"
                                                                class="form-control @error('kelas_diterima') is-invalid @enderror"
                                                                value="{{ old('kelas_diterima', optional($pendaftaran)->kelas_diterima) }}">
                                                            @error('kelas_diterima')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- 3. Keterangan Orang Tua -->
                                                    <h5 class="mt-4">Keterangan Orang Tua</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                                            <input type="text" name="nama_ayah" id="nama_ayah"
                                                                placeholder="Nama Lengkap Ayah"
                                                                class="form-control @error('nama_ayah') is-invalid @enderror"
                                                                value="{{ old('nama_ayah', optional($pendaftaran)->nama_ayah) }}">
                                                            @error('nama_ayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                                            <input type="text" name="nama_ibu" id="nama_ibu"
                                                                placeholder="Nama Lengkap Ibu"
                                                                class="form-control @error('nama_ibu') is-invalid @enderror"
                                                                value="{{ old('nama_ibu', optional($pendaftaran)->nama_ibu) }}">
                                                            @error('nama_ibu')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="nik_ibu" class="form-label">Nomor NIK Ibu</label>
                                                            <input type="number" name="nik_ibu" id="nik_ibu"
                                                                placeholder="Nomor nik_ibu"
                                                                class="form-control @error('nik_ibu') is-invalid @enderror"
                                                                value="{{ old('nik_ibu', optional($pendaftaran)->nik_ibu) }}">
                                                            @error('nik_ibu')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="nik_ayah" class="form-label">Nomor NIK Ayah</label>
                                                            <input type="number" name="nik_ayah" id="nik_ayah"
                                                                placeholder="Nomor nik_ayah"
                                                                class="form-control @error('nik_ayah') is-invalid @enderror"
                                                                value="{{ old('nik_ayah', optional($pendaftaran)->nik_ayah) }}">
                                                            @error('nik_ayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="pendidikan_ayah" class="form-label">Pendidikan
                                                                Ayah</label>
                                                            <input type="text" name="pendidikan_ayah" id="pendidikan_ayah"
                                                                placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                                                class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                                                value="{{ old('pendidikan_ayah', optional($pendaftaran)->pendidikan_ayah) }}">
                                                            @error('pendidikan_ayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="pendidikan_ibu" class="form-label">Pendidikan
                                                                Ibu</label>
                                                            <input type="text" name="pendidikan_ibu" id="pendidikan_ibu"
                                                                placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                                                class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                                                value="{{ old('pendidikan_ibu', optional($pendaftaran)->pendidikan_ibu) }}">
                                                            @error('pendidikan_ibu')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan
                                                                Ayah</label>
                                                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                                                placeholder="Buruh, Karyawan Swasta, Pns, Petani, Tni"
                                                                class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                                                value="{{ old('pekerjaan_ayah', optional($pendaftaran)->pekerjaan_ayah) }}">
                                                            @error('pekerjaan_ayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                                                placeholder="Buruh, Karyawan Swasta, Pns, Petani, Ibu Rumah Tangga"
                                                                class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                                value="{{ old('pekerjaan_ibu', optional($pendaftaran)->pekerjaan_ibu) }}">
                                                            @error('pekerjaan_ibu')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="status_ayah" class="form-label">Status hidup
                                                                ayah</label>
                                                            <select name="status_ayah" id="status_ayah"
                                                                class="form-control @error('status_ayah') is-invalid @enderror">
                                                                <option value="" disabled selected>Status hidup ayah</option>
                                                                <option value="masih_hidup" {{ old('status_ayah', optional($pendaftaran)->status_ayah) == 'masih_hidup' ? 'selected' : '' }}>Masih Hidup
                                                                </option>
                                                                <option value="sudah_tiada" {{ old('status_ayah', optional($pendaftaran)->status_ayah) == 'sudah_tiada' ? 'selected' : '' }}>Sudah Tiada
                                                                </option>
                                                            </select>
                                                            @error('status_ayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="status_ibu" class="form-label">Status hidup ibu</label>
                                                            <select name="status_ibu" id="status_ibu"
                                                                class="form-control @error('status_ibu') is-invalid @enderror">
                                                                <option value="" disabled selected>Status hidup ibu</option>
                                                                <option value="masih_hidup" {{ old('status_ibu', optional($pendaftaran)->status_ibu) == 'masih_hidup' ? 'selected' : '' }}>Masih Hidup
                                                                </option>
                                                                <option value="sudah_tiada" {{ old('status_ibu', optional($pendaftaran)->status_ibu) == 'sudah_tiada' ? 'selected' : '' }}>Sudah Tiada
                                                                </option>
                                                            </select>
                                                            @error('status_ibu')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- 4. Keterangan Wali Murid -->
                                                    <div id="section-wali"
                                                        class="{{ (old('status_ayah', optional($pendaftaran)->status_ayah) === 'sudah_tiada' && old('status_ibu', optional($pendaftaran)->status_ibu) === 'sudah_tiada') ? '' : 'd-none' }}">
                                                        <h5 class="mt-4">Keterangan Wali Murid(Wajib Diisi Jika Kedua OrangTua
                                                            Sudah Tiada )</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="nama_wali" class="form-label">Nama Wali
                                                                    Murid</label>
                                                                <input type="text" name="nama_wali" id="nama_wali"
                                                                    class="form-control @error('nama_wali') is-invalid @enderror"
                                                                    value="{{ old('nama_wali', optional($pendaftaran)->nama_wali) }}">
                                                                @error('nama_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="hubungan_wali" class="form-label">hubungan
                                                                    Wali</label>
                                                                <input type="text" name="hubungan_wali" id="hubungan_wali"
                                                                    class="form-control @error('hubungan_wali') is-invalid @enderror"
                                                                    value="{{ old('hubungan_wali', optional($pendaftaran)->hubungan_wali) }}">
                                                                @error('hubungan_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="pekerjaan_wali" class="form-label">Pekerjaan
                                                                    Wali</label>
                                                                <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                                                                    class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                                                    value="{{ old('pekerjaan_wali', optional($pendaftaran)->pekerjaan_wali) }}">
                                                                @error('pekerjaan_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                                                <input type="text" name="alamat_wali" id="alamat_wali"
                                                                    class="form-control @error('alamat_wali') is-invalid @enderror"
                                                                    value="{{ old('alamat_wali', optional($pendaftaran)->alamat_wali) }}">
                                                                @error('alamat_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="pendidikan_wali" class="form-label">pendidikan
                                                                    wali</label>
                                                                <input type="text" name="pendidikan_wali" id="pendidikan_wali"
                                                                    class="form-control @error('pendidikan_wali') is-invalid @enderror"
                                                                    value="{{ old('pendidikan_wali', optional($pendaftaran)->pendidikan_wali) }}">
                                                                @error('pendidikan_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="telepon_wali"
                                                                    class="form-label">telepon_wali</label>
                                                                <input type="number" name="telepon_wali" id="telepon_wali"
                                                                    class="form-control @error('telepon_wali') is-invalid @enderror"
                                                                    value="{{ old('telepon_wali', optional($pendaftaran)->telepon_wali) }}">
                                                                @error('telepon_wali')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="kewarganegaraan"
                                                                class="form-label">kewarganegaraan</label>
                                                            <input type="text" name="kewarganegaraan" id="kewarganegaraan"
                                                                class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                                                value="{{ old('kewarganegaraan', optional($pendaftaran)->kewarganegaraan) }}">
                                                            @error('kewarganegaraan')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- 5. Keterangan KIP/KIS/KKS jika Tidak ada-->
                                                    <h5 class="mt-4">Keterangan Kartu Pendukung</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="KIP" class="form-label">Nomor KIP</label>
                                                            <input type="number" name="KIP" id="KIP"
                                                                class="form-control @error('KIP') is-invalid @enderror"
                                                                value="{{ old('KIP', optional($pendaftaran)->KIP) }}">
                                                            @error('KIP')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="KIS" class="form-label">Nomor KIS</label>
                                                            <input type="number" name="KIS" id="KIS"
                                                                class="form-control @error('KIS') is-invalid @enderror"
                                                                value="{{ old('KIS', optional($pendaftaran)->KIS) }}">
                                                            @error('KIS')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="KKS" class="form-label">Nomor KKS</label>
                                                            <input type="number" name="KKS" id="KKS"
                                                                class="form-control @error('KKS') is-invalid @enderror"
                                                                value="{{ old('KKS', optional($pendaftaran)->KKS) }}">
                                                            @error('KKS')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pendaftar -->

    <div class="modal fade" id="tambahPendaftarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pendaftar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('petugas.store.pendaftaran') }}">
                        @csrf
                        <!-- 1. Keterangan Anak -->
                        <h5 class="mt-4">Keterangan Anak</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" name="nisn" id="nisn" placeholder="Nomor Nisn"
                                    class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nik" class="form-label">nik</label>
                                <input type="number" name="nik" id="nik" placeholder="Nomor nik"
                                    class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nomor_kk" class="form-label">Nomor Kartu Keluarga</label>
                                <input type="number" name="nomor_kk" id="nomor_kk" placeholder="Nomor Kartu Keluarga"
                                    class="form-control @error('nomor_kk') is-invalid @enderror"
                                    value="{{ old('nomor_kk') }}">
                                @error('nomor_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Kota Kelahiran</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Jakarta, Bandung"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="Contoh: Jakarta" value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" name="agama" id="agama" placeholder="Islam"
                                    class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}">
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status_keluarga" class="form-label">Status Keluarga</label>
                                <input type="text" name="status_keluarga" id="status_keluarga" placeholder="Anak Kandung"
                                    class="form-control @error('status_keluarga') is-invalid @enderror"
                                    value="{{ old('status_keluarga') }}">
                                @error('status_keluarga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="anak_ke" class="form-label">Anak Keberapa</label>
                                <input type="number" name="anak_ke" id="anak_ke" placeholder="1,2,3"
                                    class="form-control @error('anak_ke') is-invalid @enderror"
                                    value="{{ old('anak_ke') }}">
                                @error('anak_ke')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" id="berat_badan"
                                    class="form-control @error('berat_badan') is-invalid @enderror"
                                    value="{{ old('berat_badan') }}">
                                @error('berat_badan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" id="tinggi_badan"
                                    class="form-control @error('tinggi_badan') is-invalid @enderror"
                                    value="{{ old('tinggi_badan') }}">
                                @error('tinggi_badan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                <textarea name="alamat" id="alamat"
                                    placeholder="Jl. Padat Karya Kampung Kandang, Mekarwangi, KEC. CISAUK."
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    rows="2">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="bertempat_tinggal_pada" class="form-label">Bertempat Tinggal Pada</label>
                                <input type="text" name="bertempat_tinggal_pada" id="bertempat_tinggal_pada"
                                    class="form-control @error('bertempat_tinggal_pada') is-invalid @enderror"
                                    placeholder="Orang Tua / Bibi / Wali" value="{{ old('bertempat_tinggal_pada') }}">
                                @error('bertempat_tinggal_pada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Nomor HP</label>
                                <input type="number" name="telepon" id="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old('telepon') }}">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- 2. Keterangan Pendidikan Sebelumnya Kosongkan jika Tidak ada-->
                        <h5 class="mt-4">Keterangan Pendidikan Sebelumnya (Opsional)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah"
                                    class="form-control @error('asal_sekolah') is-invalid @enderror" placeholder="SD / RA"
                                    value="{{ old('asal_sekolah') }}">
                                @error('asal_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_ijazah" class="form-label">Tanggal/No Ijazah</label>
                                <input type="date" name="tgl_ijazah" id="tgl_ijazah"
                                    class="form-control @error('tgl_ijazah') is-invalid @enderror"
                                    value="{{ old('tgl_ijazah') }}">
                                @error('tgl_ijazah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lama_belajar" class="form-label">Lama Belajar</label>
                                <input type="text" name="lama_belajar" id="lama_belajar"
                                    class="form-control @error('lama_belajar') is-invalid @enderror"
                                    value="{{ old('lama_belajar') }}">
                                @error('lama_belajar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                                <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                    class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                    value="{{ old('tanggal_diterima') }}">
                                @error('tanggal_diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kelas_diterima" class="form-label">Kelas Diterima</label>
                                <input type="text" name="kelas_diterima" id="kelas_diterima"
                                    class="form-control @error('kelas_diterima') is-invalid @enderror"
                                    value="{{ old('kelas_diterima') }}">
                                @error('kelas_diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- 3. Keterangan Orang Tua -->
                        <h5 class="mt-4">Keterangan Orang Tua</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_ayah_tambah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah_tambah" placeholder="Nama Lengkap Ayah"
                                    class="form-control @error('nama_ayah') is-invalid @enderror"
                                    value="{{ old('nama_ayah') }}">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nama_ibu_tambah" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu_tambah" placeholder="Nama Lengkap Ibu"
                                    class="form-control @error('nama_ibu') is-invalid @enderror"
                                    value="{{ old('nama_ibu') }}">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pendidikan_ayah" class="form-label">Pendidikan Ayah</label>
                                <input type="text" name="pendidikan_ayah" id="pendidikan_ayah"
                                    placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                    class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                    value="{{ old('pendidikan_ayah') }}">
                                @error('pendidikan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pendidikan_ibu" class="form-label">Pendidikan Ibu</label>
                                <input type="text" name="pendidikan_ibu" id="pendidikan_ibu"
                                    placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                    class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                    value="{{ old('pendidikan_ibu') }}">
                                @error('pendidikan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                    placeholder="Buruh, Karyawan Swasta, Pns, Petani, Tni"
                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                    value="{{ old('pekerjaan_ayah') }}">
                                @error('pekerjaan_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                    placeholder="Buruh, Karyawan Swasta, Pns, Petani, Ibu Rumah Tangga"
                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                    value="{{ old('pekerjaan_ibu') }}">
                                @error('pekerjaan_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nik_ibu" class="form-label">NIK Ibu</label>
                                <input type="number" name="nik_ibu" id="nik_ibu" placeholder="Nomor nik_ibu"
                                    class="form-control @error('nik_ibu') is-invalid @enderror"
                                    value="{{ old('nik_ibu') }}">
                                @error('nik_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nik_ayah" class="form-label">NIK Ayah</label>
                                <input type="number" name="nik_ayah" id="nik_ayah" placeholder="Nomor nik_ayah"
                                    class="form-control @error('nik_ayah') is-invalid @enderror"
                                    value="{{ old('nik_ayah') }}">
                                @error('nik_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status_ayah" class="form-label">Status ayah</label>
                                <select name="status_ayah" id="status_ayah"
                                    class="form-control @error('status_ayah') is-invalid @enderror">
                                    <option value="" disabled selected> Status hidup ayah</option>
                                    <option value="masih_hidup" {{ old('status_ayah') == 'masih_hidup' ? 'selected' : '' }}>
                                        Masih Hidup</option>
                                    <option value="sudah_tiada" {{ old('status_ayah') == 'sudah_tiada' ? 'selected' : '' }}>
                                        Sudah Tiada</option>
                                </select>
                                @error('status_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status_ibu" class="form-label">Status ibu</label>
                                <select name="status_ibu" id="status_ibu"
                                    class="form-control @error('status_ibu') is-invalid @enderror">
                                    <option value="" disabled selected> Status hidup ibu</option>
                                    <option value="masih_hidup" {{ old('status_ibu') == 'masih_hidup' ? 'selected' : '' }}>
                                        Masih Hidup</option>
                                    <option value="sudah_tiada" {{ old('status_ibu') == 'sudah_tiada' ? 'selected' : '' }}>
                                        Sudah Tiada</option>
                                </select>
                                @error('status_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- 4. Keterangan wali -->
                        <div id="section-wali_tambah">
                            <h5 class="mt-4" id="section-wali">Keterangan wali</h5>
                            <div class="row" id="section-wali">
                                <div class="col-md-6">
                                    <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                                    <input type="text" name="nama_wali" id="nama_wali"
                                        class="form-control @error('nama_wali') is-invalid @enderror"
                                        value="{{ old('nama_wali') }}">
                                    @error('nama_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="hubungan_wali" class="form-label">Hubungan terhadap Anak</label>
                                    <input type="text" name="hubungan_wali" id="hubungan_wali"
                                        class="form-control @error('hubungan_wali') is-invalid @enderror"
                                        value="{{ old('hubungan_wali') }}">
                                    @error('hubungan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                                        class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                        placeholder="Pegawai Swasta, Buruh, Pns" value="{{ old('pekerjaan_wali') }}">
                                    @error('pekerjaan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telepon_wali" class="form-label">telepon Wali</label>
                                    <input type="number" name="telepon_wali" id="telepon_wali"
                                        class="form-control @error('telepon_wali') is-invalid @enderror"
                                        value="{{ old('telepon_wali') }}">
                                    @error('telepon_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat_wali" class="form-label">alamat Wali</label>
                                    <input type="text" name="alamat_wali" id="alamat_wali"
                                        class="form-control @error('alamat_wali') is-invalid @enderror"
                                        value="{{ old('alamat_wali') }}">
                                    @error('alamat_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pendidikan_wali" class="form-label">pendidikan Wali</label>
                                    <input type="text" name="pendidikan_wali" id="pendidikan_wali"
                                        class="form-control @error('pendidikan_wali') is-invalid @enderror"
                                        placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                        value="{{ old('pendidikan_wali') }}">
                                    @error('pendidikan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control"
                                    value="Indonesia" readonly>
                            </div>
                        </div>
                        <!-- 5. Kartu yang Dimiliki -->
                        <h5 class="mt-4">Kartu yang Dimiliki (Optional)</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="KIP" class="form-label">No KIP</label>
                                <input type="nunmber" name="KIP" id="KIP"
                                    class="form-control @error('KIP') is-invalid @enderror" value="{{ old('KIP') }}">
                                @error('KIP')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="KKS" class="form-label">No KKS</label>
                                <input type="nunmber" name="KKS" id="KKS"
                                    class="form-control @error('KKS') is-invalid @enderror" value="{{ old('KKS') }}">
                                @error('KKS')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="KIS" class="form-label">No KIS</label>
                                <input type="nunmber" name="KIS" id="KIS"
                                    class="form-control @error('KIS') is-invalid @enderror" value="{{ old('KIS') }}">
                                @error('KIS')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="submit" class="btn btn-primary">Submit Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("tambahPendaftarModal");

        // Hanya cari elemen di dalam modal ini
        const statusAyah = modal.querySelector("#status_ayah");
        const statusIbu = modal.querySelector("#status_ibu");
        const sectionWali = modal.querySelector("#section-wali_tambah");

        function toggleSectionWali() {
            const ayah = statusAyah.value;
            const ibu = statusIbu.value;

            if (ayah === "sudah_tiada" && ibu === "sudah_tiada") {
                sectionWali.style.display = "block";
                sectionWali.querySelectorAll("input").forEach(input => {
                    input.required = true;
                });
            } else {
                sectionWali.style.display = "none";
                sectionWali.querySelectorAll("input").forEach(input => {
                    input.required = false;
                });
            }
        }

        // Jalankan saat form dibuka (atau halaman dimuat)
        toggleSectionWali();

        // Jalankan ulang ketika select berubah
        statusAyah.addEventListener("change", toggleSectionWali);
        statusIbu.addEventListener("change", toggleSectionWali);
    });
</script>



    <script>
        function toggleWaliSection() {
            const statusAyah = document.getElementById('status_ayah').value;
            const statusIbu = document.getElementById('status_ibu').value;
            const waliSection = document.getElementById('section-wali');

            if (statusAyah === 'sudah_tiada' && statusIbu === 'sudah_tiada') {
                waliSection.classList.remove('d-none');
            } else {
                waliSection.classList.add('d-none');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleWaliSection();
            document.getElementById('status_ayah').addEventListener('change', toggleWaliSection);
            document.getElementById('status_ibu').addEventListener('change', toggleWaliSection);
        });
    </script>





    <script>
        function updateStatus(id, value) {
            $.ajax({
                url: '/petugas/pendaftaran/update-status/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status_pendaftaran: value
                },
                success: function (response) {
                    const td = $('#status-' + id);

                    // Hapus semua class warna lama
                    td.removeClass('bg-success bg-danger bg-warning bg-secondary');

                    // Tentukan class baru berdasarkan value
                    let bgClass = 'bg-secondary';
                    if (value === 'valid') {
                        bgClass = 'bg-success';
                    } else if (value === 'tidak_valid') {
                        bgClass = 'bg-danger';
                    } else if (value === 'pending') {
                        bgClass = 'bg-warning';
                    }

                    // Update class dan teks
                    td.addClass(bgClass);
                    td.text(capitalize(value));
                },
                error: function () {
                    alert('Gagal memperbarui status.');
                }
            });
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).replace('_', ' ');
        }
    </script>







@endsection