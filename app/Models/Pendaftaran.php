<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'nomor_kk',
        'nama_lengkap',
        'nisn',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'agama',
        'status_keluarga',
        'anak_ke',
        'berat_badan',
        'tinggi_badan',
        'alamat',
        'bertempat_tinggal_pada',
        'telepon',
        'asal_sekolah',
        'tgl_ijazah',
        'lama_belajar',
        'tanggal_diterima',
        'kelas_diterima',
        'nik_ibu',
        'nik_ayah',
        'status_ayah',
        'status_ibu',
        'nama_ayah',
        'nama_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'nama_wali',
        'pendidikan_wali',
        'hubungan_wali',
        'pekerjaan_wali',
        'telepon_wali',
        'kewarganegaraan',
        'alamat_wali',
        'KIP',
        'KIS',
        'KKS',
        'status_pendaftaran'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
