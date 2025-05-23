@extends('user.user_dashboard')
@section('user')
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Kolom kiri atas -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-header">Persyaratan Berkas Pendaftaran</div>
                    <div class="card-body">
                        <ul>
                            <li>Usia anak 6 tahun</li>
                            <li>2 rangkap bukti formulir Pendaftaran</li>
                            <li>Fotokopi akta kelahiran</li>
                            <li>Fotokopi KK</li>
                            <li>Pas photo 3x4 (2 lembar)</li>
                        </ul>
                        <p>Jika Pendaftaran Dinyatakan valid anda, anda dapat print formulir(2 rangkap) dan membawa
                            Berkas lainya kesekolah</p>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan atas -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-header">Panitia PPDB </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="bx bxl-whatsapp"></i> 0859-3517-8208 | Panitia PPDB 1</li>
                            <li><i class="bx bxl-whatsapp"></i> 0815-2596-7778 | Panitia PPDB 2</li>
                            
                        </ul>
                        <!-- <hr>
                        <div class="text-center">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://www.youtube.com/watch?v=a3ICNMQW7Ok"
                                alt="QR Code" class="img-fluid">
                            <p class="mt-2">Scan QR untuk panduan Pendaftaran</p>
                        </div> -->
                    </div>
                </div>
            </div>


            <!-- Kolom kanan bawah -->
            <div class="col-md-5 mb-3">
                <div class="card h-100">
                    <div class="card-header">Panduan Pengisian Formulir</div>
                    <div class="card-body">
                        <ul>
                            <li>Isi nama lengkap</li>
                            <li>Isi data orang tua</li>
                            <li>Isi alamat sesuai KK</li>
                            <li>Bagi yang berasal dari PAUD,RA,TK, Atau Sekolah Pindahan dapat mengisi Keterangan pendidikan
                                Sebelumnya pada formulir.</li>
                            <li>Submit Pendaftaran</li>
                            <li>Cetak Formuir Dan Membawa Berkas Untuk Melanjutkan Proses Administrasi Selanjutnya </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom maps -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lokasi Sekolah</div>
                    <div class="card-body p-0">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3965.38114969776!2d106.59664727378184!3d-6.344661362071992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjAnNDAuOCJTIDEwNsKwMzUnNTcuMiJF!5e0!3m2!1sid!2sid!4v1746548791588!5m2!1sid!2sid"
                            width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection