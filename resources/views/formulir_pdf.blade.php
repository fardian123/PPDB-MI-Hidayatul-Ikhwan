<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulir Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h3,
        h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td {
            padding: 4px;
            vertical-align: top;
        }

        td.label {
            width: 30%;
        }

        td.colon {
            width: 1%;
            white-space: nowrap;
            text-align: left;
        }

        td.value {
            width: 69%;
            text-align: left;
        }

        .logo {
            width: 100px;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .tanggal {
            text-align: right;
            margin-top: 50px;
        }

        .kop-container {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .logo {
            float: left;
            width: 80px;
            height: 80px;
        }

        .header-text {
            margin-left: 100px;
            margin-right: 100px;
        }

        .alamat {
            font-style: italic;
            font-size: 12px;
        }

        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Diperkecil */
            margin: 0;
            padding: 0;
        }

        table {
            page-break-inside: avoid;
        }

        td.label {
            width: 25%;
        }

        td.value {
            width: 74%;
        }

        .kop-container {
            display: flex;
            align-items: center;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        h2,
        h3,
        h4 {
            margin: 0;
            font-size: 12px;
        }

        .alamat {
            font-size: 9px;
            font-style: italic;
            margin-top: 2px;
        }
    </style>

</head>

<body>



    <div class="kop-container">
        <img src="{{ public_path('backend/assets/images/1746432754279.png')}}" class="logo">
        <div class="header-text">
            <h2>YAYASAN NURHIDAYAH KARIMIAH</h2>
            <h3><strong>MADRASAH IBTIDAIYAH HIDAYATUL IKHWAN</strong></h3>
            <h4>KEC. CISAUK KAB. TANGERANG</h4>
            <p class="alamat">
                Alamat : Jln. Padat Karya Kp. Kondang RT.005/002 Email : .......... Tlp : ..........
            </p>
        </div>
    </div>


    <strong>KETERANGAN ANAK :</strong>
    <table>
        <tr>
            <td class="label">1. Nama Lengkap</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nama_lengkap ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">2. NISN</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nisn ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">2. NIK</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nik ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">3. Kartu Keluarga</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nomor_kk ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">3. Tempat / Tanggal Lahir</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->tempat_lahir ?: ' ' }}, {{ $data->tanggal_lahir ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">4. Jenis Kelamin</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->jenis_kelamin ?: ' ' }}</td>
        </tr>

        <tr>
            <td class="label">5. Agama</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->agama ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">6. Status Keluarga</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->status_keluarga ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">7. Anak Nomor Ke</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->anak_ke ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">8. Berat Badan / Tinggi Badan</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->berat_badan ?: ' ' }} kg / {{ $data->tinggi_badan ?: ' ' }} cm</td>
        </tr>
        <tr>
            <td class="label">9. Alamat Tempat Tinggal</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->alamat ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">10. Bertempat Tinggal Pada</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->bertempat_tinggal_pada ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">11. Nomor Telepon / HP</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->telepon ?: ' ' }}</td>
        </tr>
    </table>

    <br><strong>KETERANGAN PENDIDIKAN SEBELUMNYA :</strong>
    <table>
        <tr>
            <td class="label">12. Asal Sekolah</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->asal_sekolah ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">13. Tanggal / No. Ijazah</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->tgl_ijazah ?: "-" }}</td>
        </tr>
        <tr>
            <td class="label">14. Lama Belajar</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->lama_belajar ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">15. Diterima di Sekolah Ini</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->tanggal_diterima ?: "-" }}</td>
        </tr>
        <tr>
            <td class="label">16. Kelas</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->kelas_diterima ?: ' ' }}</td>
        </tr>
    </table>

    <br><strong>KETERANGAN ORANG TUA</strong>
    <table>
        <tr>
            <td class="label">17. Nama Lengkap Ayah / Ibu</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nama_ayah ?: ' ' }} / {{ $data->nama_ibu ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">17. NIK Ayah / Ibu</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nik_ayah ?: ' ' }} / {{ $data->nik_ibu ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">18. Pendidikan Tertinggi Ayah / Ibu</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->pendidikan_ayah ?: ' ' }} / {{ $data->pendidikan_ibu ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">19. Pekerjaan Ayah / Ibu</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->pekerjaan_ayah ?: ' ' }} / {{ $data->pekerjaan_ibu ?: ' ' }}</td>
        </tr>


    </table>

    <strong>KETERANGAN Wali</strong>
    <table>
        <tr>
            <td class="label">20. Nama Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->nama_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">21. Pendidikan Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->pendidikan_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">22. Hubungan Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->hubungan_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">23. Pekerjaan Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->pekerjaan_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">24. No Telepon Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->telepon_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">25. Alamat Wali</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->alamat_wali ?: ' ' }}</td>
        </tr>
        <tr>
            <td class="label">26. Kewarganegaraan</td>
            <td class="colon">:</td>
            <td class="value">{{ $data->kewarganegaraan ?: ' ' }}</td>
        </tr>

    </table>

    <br><strong>KIP / KIS / KKP</strong>
    <table width="100%" style="margin-top: 10px;">
        <tr valign="top">
            <!-- Kolom KIP/KIS/KKS -->
            <td style="width: 65%; padding-right: 20px;">
                <table>
                    <tr>
                        <td class="label">27. KIS</td>
                        <td style="colon">:</td>
                        <td class="value">
                            {{ (!isset($data->KIS) || $data->KIS === null || (strlen($data->KIS) < 5 && $data->KIS == '1')) ? '-' : $data->KIS }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">28. KKS</td>
                        <td class="colon">:</td>
                        <td class="value">
                            {{ (!isset($data->KKS) || $data->KKS === null || (strlen($data->KKS) < 5 && $data->KKS == '1')) ? '-' : $data->KKS }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">29. KIP</td>
                        <td class="colon">:</td>
                        <td class="value">
                            {{ (!isset($data->KIP) || $data->KIP === null || (strlen($data->KIP) < 5 && $data->KIP == '1')) ? '-' : $data->KIP }}
                        </td>
                    </tr>
                </table>
            </td>

            <!-- Kolom Tanda Tangan -->
            <!-- Dua kolom tanda tangan -->
            <td style="width: 35%; text-align: center;">
                <div>
                    Cisauk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                    Orang Tua / Wali Murid<br><br><br><br><br>
                    (.......................................)
                </div>
            </td>
            <td style="width: 35%; text-align: center;">
                <div>
                    Cisauk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                    Panitia Pendaftaran<br><br><br><br><br>
                    (.......................................)
                </div>
            </td>
        </tr>
    </table>


</body>

</html>