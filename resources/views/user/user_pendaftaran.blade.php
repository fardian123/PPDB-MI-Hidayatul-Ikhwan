@extends('user.user_dashboard')
@section('user')

    <div class="page-content">
        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="card mb-4">
                <h5 class="card-header">Formulir Pendaftaran Siswa Baru</h5>
                <div class="card-body">
                    @if (auth()->user()->pendaftaran)
                        <div class="card mb-3 bg-danger text-white">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bx bx-error" style="font-size: 2rem;"></i> <!-- Bootstrap Icons -->
                                </div>
                                <div>
                                    <h5 class="card-title mb-1">Anda Sudah Melakukan Pendaftaran</h5>
                                    <p class="card-text mb-0">Edit Data Anda Pada Halaman hasil seleksi jika terdapat data yang perlu diubah</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form method="POST" action="{{ route('user.pendaftaran.store') }}">
                            @csrf

                            <!-- 1. Keterangan Anak -->
                            <h5 class="mt-4">Keterangan Anak</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        value="{{ old('nama_lengkap') }}">
                                    @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="number" name="nisn" id="nisn" placeholder="Nomor Nisn"
                                        class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}">
                                    @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tempat_lahir" class="form-label">Kota Kelahiran</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Jakarta, Bandung"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        placeholder="Contoh: Jakarta" value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" name="agama" id="agama" placeholder="Islam"
                                        class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama') }}">
                                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="status_keluarga" class="form-label">Status Keluarga</label>
                                    <input type="text" name="status_keluarga" id="status_keluarga" placeholder="Anak Kandung"
                                        class="form-control @error('status_keluarga') is-invalid @enderror"
                                        value="{{ old('status_keluarga') }}">
                                    @error('status_keluarga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="anak_ke" class="form-label">Anak Keberapa</label>
                                    <input type="number" name="anak_ke" id="anak_ke" placeholder="1,2,3"
                                        class="form-control @error('anak_ke') is-invalid @enderror"
                                        value="{{ old('anak_ke') }}">
                                    @error('anak_ke') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                    <input type="number" name="berat_badan" id="berat_badan"
                                        class="form-control @error('berat_badan') is-invalid @enderror"
                                        value="{{ old('berat_badan') }}">
                                    @error('berat_badan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan" id="tinggi_badan"
                                        class="form-control @error('tinggi_badan') is-invalid @enderror"
                                        value="{{ old('tinggi_badan') }}">
                                    @error('tinggi_badan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                    <textarea name="alamat" id="alamat"
                                        placeholder="Jl. Padat Karya Kampung Kandang, Mekarwangi, KEC. CISAUK."
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        rows="2">{{ old('alamat') }}</textarea>
                                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="bertempat_tinggal_pada" class="form-label">Bertempat Tinggal Pada</label>
                                    <input type="text" name="bertempat_tinggal_pada" id="bertempat_tinggal_pada"
                                        class="form-control @error('bertempat_tinggal_pada') is-invalid @enderror"
                                        placeholder="Orang Tua / Bibi / Wali" value="{{ old('bertempat_tinggal_pada') }}">
                                    @error('bertempat_tinggal_pada') <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Nomor HP</label>
                                    <input type="number" name="telepon" id="telepon"
                                        class="form-control @error('telepon') is-invalid @enderror"
                                        value="{{ old('telepon') }}">
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
                                        value="{{ old('asal_sekolah') }}">
                                    @error('asal_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tgl_ijazah" class="form-label">Tanggal/No Ijazah</label>
                                    <input type="date" name="tgl_ijazah" id="tgl_ijazah"
                                        class="form-control @error('tgl_ijazah') is-invalid @enderror"
                                        value="{{ old('tgl_ijazah') }}">
                                    @error('tgl_ijazah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lama_belajar" class="form-label">Lama Belajar</label>
                                    <input type="text" name="lama_belajar" id="lama_belajar"
                                        class="form-control @error('lama_belajar') is-invalid @enderror"
                                        value="{{ old('lama_belajar') }}">
                                    @error('lama_belajar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                                    <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                        class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                        value="{{ old('tanggal_diterima') }}">
                                    @error('tanggal_diterima') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kelas_diterima" class="form-label">Kelas Diterima</label>
                                    <input type="text" name="kelas_diterima" id="kelas_diterima"
                                        class="form-control @error('kelas_diterima') is-invalid @enderror"
                                        value="{{ old('kelas_diterima') }}">
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
                                        value="{{ old('nama_ayah') }}">
                                    @error('nama_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu" placeholder="Nama Lengkap Ibu"
                                        class="form-control @error('nama_ibu') is-invalid @enderror"
                                        value="{{ old('nama_ibu') }}">
                                    @error('nama_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pendidikan_ayah" class="form-label">Pendidikan Ayah</label>
                                    <input type="text" name="pendidikan_ayah" id="pendidikan_ayah"
                                        placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                        class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                        value="{{ old('pendidikan_ayah') }}">
                                    @error('pendidikan_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pendidikan_ibu" class="form-label">Pendidikan Ibu</label>
                                    <input type="text" name="pendidikan_ibu" id="pendidikan_ibu"
                                        placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                        class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                        value="{{ old('pendidikan_ibu') }}">
                                    @error('pendidikan_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                        placeholder="Buruh, Karyawan Swasta, Pns, Petani, Tni"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                        value="{{ old('pekerjaan_ayah') }}">
                                    @error('pekerjaan_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                        placeholder="Buruh, Karyawan Swasta, Pns, Petani, Ibu Rumah Tangga"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                        value="{{ old('pekerjaan_ibu') }}">
                                    @error('pekerjaan_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- 4. Keterangan wali -->
                            <h5 class="mt-4">Keterangan wali</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                                    <input type="text" name="nama_wali" id="nama_wali"
                                        class="form-control @error('nama_wali') is-invalid @enderror"
                                        value="{{ old('nama_wali') }}">
                                    @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="hubungan_wali" class="form-label">Hubungan terhadap Anak</label>
                                    <input type="text" name="hubungan_wali" id="hubungan_wali"
                                        class="form-control @error('hubungan_wali') is-invalid @enderror"
                                        value="{{ old('hubungan_wali') }}">
                                    @error('hubungan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                                        class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                        placeholder="Pegawai Swasta, Buruh, Pns"
                                        value="{{ old('pekerjaan_wali') }}">
                                        
                                    @error('pekerjaan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control"
                                        value="Indonesia" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="telepon_wali" class="form-label">telepon Wali</label>
                                    <input type="number" name="telepon_wali" id="telepon_wali"
                                        class="form-control @error('telepon_wali') is-invalid @enderror"
                                        value="{{ old('telepon_wali') }}">
                                    @error('telepon_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="alamat_wali" class="form-label">alamat Wali</label>
                                    <input type="text" name="alamat_wali" id="alamat_wali"
                                        class="form-control @error('alamat_wali') is-invalid @enderror"
                                        value="{{ old('alamat_wali') }}">
                                    @error('alamat_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                               
                                <div class="col-md-6">
                                    <label for="pendidikan_wali" class="form-label">pendidikan Wali</label>
                                    <input type="text" name="pendidikan_wali" id="pendidikan_wali"
                                        class="form-control @error('pendidikan_wali') is-invalid @enderror"
                                        placeholder="SD/Sederajat, SMP/Sederajat, SMA/Sederajat, S1"
                                        value="{{ old('pendidikan_wali') }}">
                                    @error('pendidikan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                
                               
                               

                            </div>
    

                            <!-- 4. Kartu yang Dimiliki -->
                            <h5 class="mt-4">Kartu yang Dimiliki</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="KIP" class="form-label">No KIP</label>
                                    <input type="nunmber" name="KIP" id="KIP"
                                        class="form-control @error('KIP') is-invalid @enderror" value="{{ old('KIP') }}">
                                    @error('KIP') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="KKS" class="form-label">No KKS</label>
                                    <input type="nunmber" name="KKS" id="KKS"
                                        class="form-control @error('KKS') is-invalid @enderror" value="{{ old('KKS') }}">
                                    @error('KKS') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="KIS" class="form-label">No KIS</label>
                                    <input type="nunmber" name="KIS" id="KIS"
                                        class="form-control @error('KIS') is-invalid @enderror" value="{{ old('KIS') }}">
                                    @error('KIS') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary">Submit Pendaftaran</button>
                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>




@endsection