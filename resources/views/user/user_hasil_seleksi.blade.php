@extends('user.user_dashboard') {{-- Sesuaikan dengan layout user kamu --}}

@section('user')



    @if($pendaftaran)
        <div class="page-content">
            <div class="container-fluid">

                <h4 class="mb-4">Seleksi Pendaftaran Saya</h4>


                @if($pendaftaran->status_pendaftaran == 'valid')
                    <div class="card mb-3 bg-success text-white">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bx bx-check" style="font-size: 2rem;"></i> <!-- Bootstrap Icons -->
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Selamat, pendaftaran Anda valid!</h5>
                                <p class="card-text mb-0">Data Anda telah berhasil diverifikasi.</p>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-12">
                                <h5 class="card-title">{{ $pendaftaran->nama_lengkap }}</h5>
                                <p class="card-text mb-1">NISN: {{ $pendaftaran->nisn }}</p>
                                <p class="card-text mb-1">Tanggal Lahir: {{ $pendaftaran->tanggal_lahir }}</p>
                                <p class="card-text mb-1">Jenis Kelamin: {{ $pendaftaran->jenis_kelamin }}</p>
                                <p class="card-text mb-2">No HP: {{ $pendaftaran->telepon }}</p>

                                <div class="d-flex flex-wrap gap-2">
                                    <a
                                        class="btn btn-sm  
                                                                                                                                                                                                                                                                            @if($pendaftaran->status_pendaftaran == 'pending') btn-warning disabled  
                                                                                                                                                                                                                                                                            @elseif($pendaftaran->status_pendaftaran == 'valid') btn-success disabled
                                                                                                                                                                                                                                                                                @else btn-danger disabled
                                                                                                                                                                                                                                                                            @endif">
                                        {{ ucfirst($pendaftaran->status_pendaftaran) }}
                                    </a>
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalEditData">Edit</a>
                                    <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalLihatData">Lihat</a>
                                    <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusData">Hapus</a>
                                </div>
                            </div>

                            @if($pendaftaran->status_pendaftaran == 'valid')
                                <div class="col-md-4 col-12 text-md-end mt-3 mt-md-0">
                                    <a href="{{route("user.formulir.download")}}" class="btn btn-success w-100">
                                        <i class="bi bi-download"></i> Download Formulir
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>








            </div>
        </div>
    @else
        <div class="page-content">
            <div class="container-fluid">
                <div class="card mb-3 bg-danger text-white">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bx bx-error" style="font-size: 2rem;"></i> <!-- Bootstrap Icons -->
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Anda Belum Melakukan Pendaftaranr</h5>
                            <p class="card-text mb-0">Silahkan Lakukan Pendaftaran Pada Halaman Pendaftaran</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    @endif

    <!-- Modal Lihat Data -->
    <div class="modal fade" id="modalLihatData" tabindex="-1" aria-labelledby="modalLihatDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLihatDataLabel">Lihat Data Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <label class="form-label">Tempat Lahir:</label>
                        <p><strong>{{ $pendaftaran->tempat_lahir ?? 'Belum ada data' }}</strong></p>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir:</label>
                        <p><strong>{{ $pendaftaran->tanggal_lahir ?? 'Belum ada data' }}</strong></p>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agama:</label>
                        <p><strong>{{ $pendaftaran->agama ?? 'Belum ada data' }}</strong></p>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Keluarga:</label>
                        <p><strong>{{ $pendaftaran->status_keluarga ?? 'Belum ada data' }}</strong></p>
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
                        <p><strong>{{ $pendaftaran->bertempat_tinggal_pada ?? 'Belum ada data' }}</strong></p>
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
                        <p><strong>{{ $pendaftaran->tanggal_diterima ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas Diterima:</label>
                        <p><strong>{{ $pendaftaran->kelas_diterima ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <!-- Keterangan Orang Tua  -->
                    <h5>Keterangan Orang Tua </h5>
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
                        <p><strong>{{ $pendaftaran->pendidikan_ayah ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pendidikan Ibu:</label>
                        <p><strong>{{ $pendaftaran->pendidikan_ibu ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Ayah:</label>
                        <p><strong>{{ $pendaftaran->pekerjaan_ayah ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Ibu:</label>
                        <p><strong>{{ $pendaftaran->pekerjaan_ibu ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <!-- Keterangan Wali  -->
                    <h5>Keterangan Wali </h5>

                    <div class="mb-3">
                        <label class="form-label">Nama Wali Murid:</label>
                        <p><strong>{{ $pendaftaran->nama_wali ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hubungan Wali:</label>
                        <p><strong>{{ $pendaftaran->hubungan_wali ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Wali:</label>
                        <p><strong>{{ $pendaftaran->pekerjaan_wali ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">pendidikan Wali:</label>
                        <p><strong>{{ $pendaftaran->pendidikan_wali ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Wali:</label>
                        <p><strong>{{ $pendaftaran->alamat_wali ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kewarganegaraan:</label>
                        <p><strong>{{ $pendaftaran->kewarganegaraan ?? 'Belum ada data' }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor HP Wali:</label>
                        <p><strong>{{ $pendaftaran->telepon_wali ?? 'Belum ada data' }}</strong></p>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pendaftaran -->
    <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditDataLabel">Edit Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.pendaftaran.update') }}">
                        @csrf


                        <!-- 1. Keterangan Anak -->
                        <h5 class="mt-4">Keterangan Anak</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap', optional($pendaftaran)->nama_lengkap) }}">
                                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" name="nisn" id="nisn" placeholder="Nomor Nisn"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn', optional($pendaftaran)->nisn) }}">
                                @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Kota Kelahiran</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Jakarta, Bandung"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="Contoh: Jakarta"
                                    value="{{ old('tempat_lahir', optional($pendaftaran)->tempat_lahir) }}">
                                @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir', optional($pendaftaran)->tanggal_lahir) }}">
                                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" name="agama" id="agama" placeholder="Islam"
                                    class="form-control @error('agama') is-invalid @enderror"
                                    value="{{ old('agama', optional($pendaftaran)->agama) }}">
                                @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status_keluarga" class="form-label">Status Keluarga</label>
                                <input type="text" name="status_keluarga" id="status_keluarga" placeholder="Anak Kandung"
                                    class="form-control @error('status_keluarga') is-invalid @enderror"
                                    value="{{ old('status_keluarga', optional($pendaftaran)->status_keluarga) }}">
                                @error('status_keluarga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="anak_ke" class="form-label">Anak Keberapa</label>
                                <input type="number" name="anak_ke" id="anak_ke" placeholder="1,2,3"
                                    class="form-control @error('anak_ke') is-invalid @enderror"
                                    value="{{ old('anak_ke', optional($pendaftaran)->anak_ke) }}">
                                @error('anak_ke') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" id="berat_badan"
                                    class="form-control @error('berat_badan') is-invalid @enderror"
                                    value="{{ old('berat_badan', optional($pendaftaran)->berat_badan) }}">
                                @error('berat_badan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" id="tinggi_badan"
                                    class="form-control @error('tinggi_badan') is-invalid @enderror"
                                    value="{{ old('tinggi_badan', optional($pendaftaran)->tinggi_badan) }}">
                                @error('tinggi_badan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                <textarea name="alamat" id="alamat"
                                    placeholder="Jl. Padat Karya Kampung Kandang, Mekarwangi, KEC. CISAUK."
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    rows="2">{{ old('alamat', optional($pendaftaran)->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="bertempat_tinggal_pada" class="form-label">Bertempat Tinggal Pada</label>
                                <input type="text" name="bertempat_tinggal_pada" id="bertempat_tinggal_pada"
                                    class="form-control @error('bertempat_tinggal_pada') is-invalid @enderror"
                                    value="{{ old('bertempat_tinggal_pada', optional($pendaftaran)->bertempat_tinggal_pada) }}">
                                @error('bertempat_tinggal_pada') <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Nomor HP</label>
                                <input type="number" name="telepon" id="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old('telepon', optional($pendaftaran)->telepon) }}">
                                @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- 2. Keterangan Pendidikan Sebelumnya Kosongkan jika Tidak ada-->
                        <h5 class="mt-4">Keterangan Pendidikan Sebelumnya</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" id="asal_sekolah"
                                    class="form-control @error('asal_sekolah') is-invalid @enderror" placeholder="SD / RA"
                                    value="{{ old('asal_sekolah', optional($pendaftaran)->asal_sekolah) }}">
                                @error('asal_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_ijazah" class="form-label">Tanggal/No Ijazah</label>
                                <input type="text" name="tgl_ijazah" id="tgl_ijazah"
                                    class="form-control @error('tgl_ijazah') is-invalid @enderror"
                                    value="{{ old('tgl_ijazah', optional($pendaftaran)->tgl_ijazah) }}">
                                @error('tgl_ijazah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="lama_belajar" class="form-label">Lama Belajar</label>
                                <input type="text" name="lama_belajar" id="lama_belajar"
                                    class="form-control @error('lama_belajar') is-invalid @enderror"
                                    value="{{ old('lama_belajar', optional($pendaftaran)->lama_belajar) }}">
                                @error('lama_belajar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                                <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                    class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                    value="{{ old('tanggal_diterima', optional($pendaftaran)->tanggal_diterima) }}">
                                @error('tanggal_diterima') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kelas_diterima" class="form-label">Kelas Diterima</label>
                                <input type="text" name="kelas_diterima" id="kelas_diterima"
                                    class="form-control @error('kelas_diterima') is-invalid @enderror"
                                    value="{{ old('kelas_diterima', optional($pendaftaran)->kelas_diterima) }}">
                                @error('kelas_diterima') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- 3. Keterangan Orang Tua -->
                        <h5 class="mt-4">Keterangan Orang Tua</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" placeholder="Nama Lengkap Ayah"
                                    class="form-control @error('nama_ayah') is-invalid @enderror"
                                    value="{{ old('nama_ayah', optional($pendaftaran)->nama_ayah) }}">
                                @error('nama_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" placeholder="Nama Lengkap Ibu"
                                    class="form-control @error('nama_ibu') is-invalid @enderror"
                                    value="{{ old('nama_ibu', optional($pendaftaran)->nama_ibu) }}">
                                @error('nama_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pendidikan_ayah" class="form-label">Pendidikan Ayah</label>
                                <input type="text" name="pendidikan_ayah" id="pendidikan_ayah"
                                    placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                    class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                    value="{{ old('pendidikan_ayah', optional($pendaftaran)->pendidikan_ayah) }}">
                                @error('pendidikan_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pendidikan_ibu" class="form-label">Pendidikan Ibu</label>
                                <input type="text" name="pendidikan_ibu" id="pendidikan_ibu"
                                    placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                    class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                    value="{{ old('pendidikan_ibu', optional($pendaftaran)->pendidikan_ibu) }}">
                                @error('pendidikan_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                    placeholder="Buruh, Karyawan Swasta, Pns, Petani, Tni"
                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                    value="{{ old('pekerjaan_ayah', optional($pendaftaran)->pekerjaan_ayah) }}">
                                @error('pekerjaan_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                    placeholder="Buruh, Karyawan Swasta, Pns, Petani, Ibu Rumah Tangga"
                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                    value="{{ old('pekerjaan_ibu', optional($pendaftaran)->pekerjaan_ibu) }}">
                                @error('pekerjaan_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- 4. Keterangan Wali Murid -->
                        <h5 class="mt-4">Keterangan Wali Murid</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                                <input type="text" name="nama_wali" id="nama_wali"
                                    class="form-control @error('nama_wali') is-invalid @enderror"
                                    value="{{ old('nama_wali', optional($pendaftaran)->nama_wali) }}">
                                @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="hubungan_wali" class="form-label">hubungan Wali</label>
                                <input type="text" name="hubungan_wali" id="hubungan_wali"
                                    class="form-control @error('hubungan_wali') is-invalid @enderror"
                                    value="{{ old('hubungan_wali', optional($pendaftaran)->hubungan_wali) }}">
                                @error('hubungan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                                    class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                    value="{{ old('pekerjaan_wali', optional($pendaftaran)->pekerjaan_wali) }}">
                                @error('pekerjaan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                <input type="text" name="alamat_wali" id="alamat_wali"
                                    class="form-control @error('alamat_wali') is-invalid @enderror"
                                    value="{{ old('alamat_wali', optional($pendaftaran)->alamat_wali) }}">
                                @error('alamat_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pendidikan_wali" class="form-label">pendidikan wali</label>
                                <input type="text" name="pendidikan_wali" id="pendidikan_wali"
                                    class="form-control @error('pendidikan_wali') is-invalid @enderror"
                                    value="{{ old('pendidikan_wali', optional($pendaftaran)->pendidikan_wali) }}">
                                @error('pendidikan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telepon_wali" class="form-label">telepon_wali</label>
                                <input type="number" name="telepon_wali" id="telepon_wali"
                                    class="form-control @error('telepon_wali') is-invalid @enderror"
                                    value="{{ old('telepon_wali', optional($pendaftaran)->telepon_wali) }}">
                                @error('telepon_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="kewarganegaraan" class="form-label">kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" id="kewarganegaraan"
                                    class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                    value="{{ old('kewarganegaraan', optional($pendaftaran)->kewarganegaraan) }}">
                                @error('kewarganegaraan') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                @error('KIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="KIS" class="form-label">Nomor KIS</label>
                                <input type="number" name="KIS" id="KIS"
                                    class="form-control @error('KIS') is-invalid @enderror"
                                    value="{{ old('KIS', optional($pendaftaran)->KIS) }}">
                                @error('KIS') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="KKS" class="form-label">Nomor KKS</label>
                                <input type="number" name="KKS" id="KKS"
                                    class="form-control @error('KKS') is-invalid @enderror"
                                    value="{{ old('KKS', optional($pendaftaran)->KKS) }}">
                                @error('KKS') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Delete Pendaftaran -->
    <div class="modal fade" id="modalHapusData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Hapus Pendaftaran</h5>
                </div>
                <form action="{{ route('user.pendaftaran.delete') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus pendaftaran ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if(session('modal') == 'modalEditData')
                    var myModal = new bootstrap.Modal(document.getElementById('modalEditData'));
                    myModal.show();
                });
            @endif
    </script>

@endsection