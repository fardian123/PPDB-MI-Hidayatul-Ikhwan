<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('backend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('backend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/header-colors.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/images/ico/favicon-32x32.png') }}">



    <!-- toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title>MI Hidayatul Ikhwan</title>

    <style>
        /* font */
        .cabin-sketch-regular {
            font-family: "Cabin Sketch", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .nunito {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .concert-one-regular {
            font-family: "Concert One", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 1.2rem;
            /* Ukuran font lebih besar */

            /* Warna putih */
        }

        /* navbar */


        .navbar-nav .nav-link {
            margin: 0 10px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: 500;
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            background-color: #d1ecf1;
            color: #007b8a;
        }

        /* carousel */
        .carousel-inner img {
            max-height: 530px;
            object-fit: cover;
            width: 100%;
        }

        /* Tombol slider */
        .carousel-control-prev,
        .carousel-control-next {
            z-index: 20;
            /* pastikan di atas overlay dan caption */
            filter: brightness(200%);
            width: 5%;

        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {

            border-radius: 50%;

        }

        /* Overlay transparan */
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 48, 87, 0.5);
            z-index: 5;
            /* di bawah caption dan tombol */
            pointer-events: none;
            /* tidak menutupi klik */
        }

        .carousel-item-fixed-height img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .carousel-item-fixed-height {
            height: 530px;
            /* 60% dari tinggi viewport */
            min-height: 300px;
            max-height: 700px;
        }

        /* Caption di atas overlay */
        .carousel-caption-custom {
            position: absolute;
            bottom: 20px;
            left: 40px;
            color: white;
            z-index: 10;
            text-align: left;
        }

        /* Responsive text */
        .carousel-caption-custom h2 {
            font-size: 2rem;
            color: #ff9800;
        }

        .carousel-caption-custom p {
            font-size: 1.1rem;
        }

        /* Responsive for tablets and phones */
        @media (max-width: 768px) {
            .carousel-caption-custom {
                left: 20px;
                bottom: 15px;
            }

            .carousel-caption-custom h2 {
                font-size: 1.4rem;
            }

            .carousel-caption-custom p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .carousel-caption-custom {
                left: 15px;
                bottom: 10px;
            }

            .carousel-caption-custom h2 {
                font-size: 1.1rem;
            }

            .carousel-caption-custom p {
                font-size: 0.8rem;
            }
        }

        /* GENERAL SECTION STYLING */
        .fasilitas-section {
            background-color: #fff;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding-bottom: 40px;
        }

        .fasilitas-header {
            background-color: #183B4E;
            padding: 40px 20px 20px;
            position: relative;
            color: white;
        }

        .fasilitas-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .arrow-down {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid #27548A;
            margin: 0 auto;
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* GRID LAYOUT */
        .fasilitas-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 60px 20px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .fasilitas-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #333;
        }

        .fasilitas-item i {
            font-size: 32px;
            color: #00b5e2;
            margin-bottom: 10px;
        }

        .fasilitas-item h3 {
            font-size: 18px;
            margin: 10px 0 8px;
        }

        .fasilitas-item h3.highlight {
            color: #00b5e2;
        }

        .fasilitas-item span {
            font-size: 14px;
            vertical-align: super;
        }

        .fasilitas-item p {
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            max-width: 280px;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            .fasilitas-header h2 {
                font-size: 20px;
            }

            .fasilitas-item i {
                font-size: 28px;
            }
        }

        .sambutan-section {
            background-color: #fff;
        }

        /* footer */
        .social-icon {
            color: white;
            transition: color 0.3s ease;
            margin-right: 10px;
        }

        .social-icon:hover {
            color: #d1d1d1;
        }

        .responsive-map {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }

        .responsive-map iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #27548A;">
        <div class="container-fluid">
            <!-- Brand di kiri -->
            <a class="navbar-brand d-flex align-items-center" href="#hero">
                <img src="{{asset('backend/assets/images/1746432754279.png')}}" alt="Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                <span class="ms-2 concert-one-regular" style="color:white;">MI Hidayatul Ikhwan</span>
            </a>

            <!-- Tombol toggle untuk perangkat kecil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu di kanan -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link concert-one-regular" style="color:white;"
                            href="{{ route('login') }}">PPDB</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link concert-one-regular" style="color:white;" href="#kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link concert-one-regular" style="color:white;" href="#visi-misi">Visi Misi</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link concert-one-regular" style="color:white;" href="#fasilitas">Fasilitas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- carousel -->
    <section id="hero">
        <div class="carousel-container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>

                </div>

                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="carousel-item active carousel-item-fixed-height">
                        <img src="{{asset('backend/assets/images/foto_madrasah/foto sekolah.jpg')}}"
                            class="d-block w-100" alt="...">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-caption-custom">
                            <h2>Membangun Generasi Unggul dari Lingkungan Madrasah</h2>
                            <p>Lingkungan belajar yang nyaman dan inspiratif untuk mencetak generasi cerdas dan berakhlak.</p>
                        </div>
                    </div>
                    <div class="carousel-item carousel-item-fixed-height">
                        <img src="{{asset('backend/assets/images/foto_madrasah/upacara (4).jpeg')}}"
                            class="d-block w-100" alt="...">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-caption-custom">
                            <h2>Menanamkan Nilai Disiplin dan Cinta Tanah Air</h2>
                            <p>Upacara rutin sebagai wujud pembinaan karakter dan nasionalisme peserta didik.</p>
                        </div>
                    </div>

                    <div class="carousel-item carousel-item-fixed-height">
                        <img src="{{asset('backend/assets/images/foto_madrasah/pengajian.jpeg')}}" class="d-block w-100"
                            alt="...">
                        <div class="carousel-overlay"></div>
                        <div class="carousel-caption-custom">
                            <h2>Menumbuhkan Keimanan Melalui Pembinaan Rohani</h2>
                            <p>Kegiatan pengajian sebagai bagian dari pembentukan karakter islami yang kuat.</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol navigasi -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>

    <!-- fasilitas online -->
    <section class="fasilitas-section" id="fasilitas">
        <!-- Full-width Header -->
        <div class="w-100 text-center py-4" style="background-color:#27548A; position: relative;">
            <h2 class="concert-one-regular text-white mb-0">FASILITAS ONLINE</h2>
            <!-- Arrow Down -->
            <div class="arrow-down" style="
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid #27548A;
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
        "></div>
        </div>

        <!-- Container Content -->
        <div class="container py-5">
            <div class="row">
                <!-- Fasilitas 1 -->
                <div class="col-md-4 mb-4">
                    <div class="text-center p-4 h-100 bg-white shadow rounded">
                        <i class="bx bx-group display-4 mb-3 text-primary"></i>
                        <h3 class="nunito" style="font-weight:bold;">Media Sosial</h3>
                        <p class="nunito">Madrasah Hidayatul Ikhwan hadir di berbagai platform media sosial untuk
                            menyampaikan informasi dan dokumentasi kegiatan secara cepat dan mudah diakses oleh
                            masyarakat.</p>
                    </div>
                </div>

                <!-- Fasilitas 2 -->
                <div class="col-md-4 mb-4">
                    <div class="text-center p-4 h-100 bg-white shadow rounded">
                        <i class="bx bx-globe display-4 mb-3 text-primary"></i>
                        <h3 class="nunito" style="font-weight:bold;">Website Sekolah</h3>
                        <p class="nunito">Madrasah Hidayatul Ikhwan memiliki website resmi yang menyajikan informasi
                            terkini seputar kegiatan, pengumuman, dan layanan pembelajaran daring.</p>
                    </div>
                </div>

                <!-- Fasilitas 3 -->
                <div class="col-md-4 mb-4">
                    <div class="text-center p-4 h-100 bg-white shadow rounded">
                        <i class="bx bx-user-plus display-4 mb-3 text-primary"></i>
                        <h3 class="nunito" style="font-weight:bold;">PPDB</h3>
                        <p class="nunito">Penerimaan Peserta Didik Baru (PPDB) dilakukan secara online untuk memudahkan
                            proses pendaftaran calon siswa baru.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- carouse kegiatan -->
    <section class="container my-5" id="kegiatan">
        <h2 class="text-center mb-4 cabin-sketch-regular">Kegiatan Madrasah</h2>
        <div id="kegiatanCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="nunito" style="font-weight:bold;">Upacara Bendera</h1>
                            <p class="nunito">
                                Kegiatan upacara bendera yang dilaksanakan setiap hari Senin di Madrasah Hidayatul
                                Ikhwan bukan hanya untuk menanamkan rasa cinta tanah air, tetapi juga menjadi sarana
                                pembinaan karakter disiplin, kepemimpinan, dan tanggung jawab bagi seluruh siswa dan
                                siswi.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('backend/assets/images/foto_madrasah/upacara (1).jpeg')}}"
                                class="d-block w-100 rounded" alt="Upacara">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="nunito" style="font-weight:bold;">Sholat Dhuha</h1>
                            <p class="nunito">
                                Setiap pagi sebelum kegiatan belajar dimulai, para siswa dan guru melaksanakan sholat
                                Dhuha secara berjamaah. Kegiatan ini bertujuan untuk membiasakan siswa menjalankan
                                ibadah sunnah, serta menanamkan kedisiplinan spiritual dan ketenangan hati sebelum
                                menerima pelajaran.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('backend/assets/images/foto_madrasah/sholat duha (1).jpeg')}}"
                                class="d-block w-100 rounded" alt="Sholat Dhuha">
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="nunito" style="font-weight:bold;">Field Trip</h1>
                            <p class="nunito">
                                Senam pagi dilaksanakan secara rutin setiap minggu sebagai bagian dari upaya menjaga
                                kesehatan fisik dan semangat belajar siswa. Kegiatan ini juga menjadi ajang kebersamaan
                                antar warga madrasah dan menumbuhkan kesadaran akan pentingnya gaya hidup sehat sejak
                                dini.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('backend/assets/images/foto_madrasah/field trip (2).jpeg')}}"
                                class="d-block w-100 rounded" alt="Study Excursion">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel controls -->

            <button class="carousel-control-next" type="button" data-bs-target="#kegiatanCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>


    <section class="sambutan-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Kolom Foto -->
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <img src="{{asset('backend/assets/images/foto_madrasah/sambutan kepala sekolah (1).jpeg')}}"
                        alt="Kepala Sekolah" class="d-block w-100 rounded shadow"
                        style="max-height: 400px; object-fit:cover;">
                    <h5 class="mt-3 text-black">Patoni, S.Pd.I.</h5>
                    <p class="text-black">Kepala Madrasah</p>
                </div>

                <!-- Kolom Sambutan -->
                <div class="col-md-7">
                    <h3 class="text-black concert-one-regular" style="color:black; font-size:2rem;">Sambutan Kepala
                        Madrasah</h3>
                    <p class="text-black">Assalamu’alaikum Warahmatullahi Wabarakaatuh.</p>
                    <p class="text-black">


                        Salam sejahtera untuk kita semua. Selamat datang di website Madrasah Ibtidaiyah Hidayatul
                        Ikhwan. Website ini dibangun sebagai sarana informasi dan komunikasi resmi madrasah, seiring
                        dengan perkembangan teknologi di era industri 4.0. Harapannya, website ini dapat memudahkan
                        masyarakat dalam mengakses berbagai informasi mengenai kegiatan, program, dan profil Madrasah
                        Ibtidaiyah Hidayatul Ikhwan.


                    </p>

                </div>
            </div>
        </div>
    </section>

    <!-- Section Visi dan Misi -->
    <section class="py-5 bg-light" id="visi-misi">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold cabin-sketch-regular">Visi dan Misi</h2>
                <p class="text-muted">Membentuk ikhsan Berkarya, Berprestasi dan Bertakwa.</p>
            </div>
            <div class="row">
                <!-- Visi -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 border rounded h-100 bg-white shadow-sm">
                        <h4 class="concert-one-regular" style="font-size:2rem;">Visi</h4>
                        <p>
                            Bekarya, Raih Prestasi, Berpijak Pada Iman dan Takwa
                        </p>
                    </div>
                </div>
                <!-- Misi -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 border rounded h-100 bg-white shadow-sm">
                        <h4 class="concert-one-regular" style="font-size:2rem;">Misi</h4>
                        <ul class="mb-0">
                            <li>Melaksanakan pembelajaran dan bimbingan secara efektif, sehingga peserta didik
                                berkembang secara optimal, sesuai potensi yang dimiliki</li>
                            <li>Mengembangkan pengetahuan di bidang Iptek, bahasa olahraga dan seni</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4" style="background-color: #27548A; color: #ffffff;">
        <div class="container">
            <div class="row">
                <!-- Kontak Sekolah -->
                <div class="col-md-6 mb-3">
                    <h5 class="nunito footer-title" style="font-weight:bold; color: #f1f1f1;">MI Hidayatul Ikhwan</h5>
                    <p class="nunito footer-text"><strong>Alamat:</strong> Jl. Padat Karya Kampung Kandang, Mekarwangi,
                        Kec. Cisauk.
                        Kab. Tangerang, Banten.
                    </p>
                   
                    <p class="nunito footer-text"><i class='bx bx-phone'></i> (+62) 8129-0210-878</p>
                    <p class="nunito footer-text"><i class='bx bxl-whatsapp'></i> (+62) 8129-0210-878</p>

                    <!-- Ikon Media Sosial -->

                    <a href="https://www.instagram.com/mis_hidayatul_ikhwan/" class="social-icon">
                        <i class='bx bxl-instagram-alt bx-md'></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class='bx bx-globe bx-md'></i>
                    </a>
                </div>


                <!-- Google Maps Embed -->
                <div class="col-md-6 mb-3">
                    <h5 class="nunito" style="font-weight:bold; color: #f1f1f1;">Lokasi Sekolah</h5>
                    <div class="responsive-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3965.38114969776!2d106.59664727378184!3d-6.344661362071992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjAnNDAuOCJTIDEwNsKwMzUnNTcuMiJF!5e0!3m2!1sid!2sid!4v1746548791588!5m2!1sid!2sid"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <hr class="border-light">

            <div class="text-center pb-3">
                <small class="nunito" style="color: #ffffff;">© Copyright MI Hidayatul Ikhwan</small>
            </div>
        </div>
    </footer>









    <!-- Bootstrap JS -->
    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/chartjs/js/chart.js')}}"></script>

    <!--app JS-->
    <script src="{{asset('backend/assets/js/app.js')}}"></script>
    <!-- <script>
		new PerfectScrollbar(".app-container")
	</script> -->

    <!-- toaster -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif 
    </script>


</body>

</html>