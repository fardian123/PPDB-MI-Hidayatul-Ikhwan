<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Pendaftaran;
use PhpOffice\PhpSpreadsheet\Style\Borders;


class PendaftaranExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Pendaftaran::whereBetween('created_at', [$this->start . ' 00:00:00', $this->end . ' 23:59:59'])->get();
    }
    public function headings(): array
    {
        return [
            ['Rekapan Pendaftaran dari ' . $this->start . ' sampai ' . $this->end],

            [
                'ID Unik',
                'ID User',
                'Nama lengkap siswa',
                'Nomor Induk Siswa Nasional',
                'Nomor Kartu Keluarga',
                'Nomor Induk Kependudukan',
                'Tanggal lahir siswa',
                'Tempat lahir siswa',
                'Jenis kelamin',
                'Agama siswa',
                'Status dalam keluarga',
                'Anak keberapa',
                'Berat badan (kg)',
                'Tinggi badan (cm)',
                'Alamat lengkap',
                'Tempat tinggal',
                'Nomor telepon siswa',
                'Asal sekolah',
                'Tanggal ijazah terakhir',
                'Lama belajar (tahun)',
                'Tanggal diterima',
                'Kelas saat diterima',
                'NIK ibu',
                'NIK ayah',
                'Status ayah',
                'Status ibu',
                'Nama ayah',
                'Nama ibu',
                'Pendidikan terakhir ayah',
                'Pendidikan terakhir ibu',
                'Pekerjaan ayah',
                'Pekerjaan ibu',
                'Nama wali',
                'Pendidikan wali',
                'Hubungan wali dengan siswa',
                'Pekerjaan wali',
                'Telepon wali',
                'Kewarganegaraan siswa',
                'Alamat wali',
                'Nomor KIP',
                'Nomor KIS',
                'Nomor KKS',
                'Status verifikasi pendaftaran',
                'Tanggal Tanggal Pendaftaran',
                'Tanggal diperbarui'
            ]
        ];
    }
    public function map($data): array
    {
        return [
        (int) $data->id,
        (int) $data->user_id,
        $data->nama_lengkap,
        $data->nisn,
        $data->nomor_kk,
        $data->nik,
        $data->tanggal_lahir,
        $data->tempat_lahir,
        $data->jenis_kelamin,
        $data->agama,
        $data->status_keluarga,
        (int) $data->anak_ke,
        (int) $data->berat_badan,
        (int) $data->tinggi_badan,
        $data->alamat,
        $data->bertempat_tinggal_pada,
        $data->telepon,
        $data->asal_sekolah,
        $data->tgl_ijazah,
        (int) $data->lama_belajar,
        $data->tanggal_diterima,
        $data->kelas_diterima,
        $data->nik_ibu,
        $data->nik_ayah,
        $data->status_ayah,
        $data->status_ibu,
        $data->nama_ayah,
        $data->nama_ibu,
        $data->pendidikan_ayah,
        $data->pendidikan_ibu,
        $data->pekerjaan_ayah,
        $data->pekerjaan_ibu,
        $data->nama_wali,
        $data->pendidikan_wali,
        $data->hubungan_wali,
        $data->pekerjaan_wali,
        $data->telepon_wali,
        $data->kewarganegaraan,
        $data->alamat_wali,
        $data->KIP,
        $data->KIS,
        $data->KKS,
        $data->status_pendaftaran,
        $data->created_at,
        $data->updated_at,
    ];;
    }


    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $sheet = $event->sheet->getDelegate();

            

            // Tambah judul di C1
            $sheet->setCellValue('C1', 'Rekapan Pendaftaran dari ' . $this->start . ' sampai ' . $this->end . ' - MI Hidayatul Ikhwan');
            $sheet->mergeCells('C1:Z1');
            $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14);

            // Format heading
            $sheet->freezePane('A4');

            // Format angka panjang tetap sebagai angka (hindari notasi ilmiah)
            $numberColumns = ['D', 'E', 'F', 'Q', 'W', 'X', 'AL', 'AM', 'AN'];
            foreach ($numberColumns as $col) {
                $sheet->getStyle($col)->getNumberFormat()->setFormatCode('0');
            }

            // Tambah border ke semua data
            
        }
    ];
}


}
