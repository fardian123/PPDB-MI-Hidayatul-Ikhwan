<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendaftaran>
 */
class PendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tanggalDiterima = $this->faker->dateTimeBetween('-5 years', '-1 years');
        $tglIjazah = $this->faker->dateTimeBetween($tanggalDiterima, '+1 years');
        return [
            'user_id' => User::factory(), // generate user baru sekalian kalau mau
            'nama_lengkap' => $this->faker->name(),
            'nisn' => $this->faker->numerify('##########'), // 10 digit random
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
            'status_keluarga' => $this->faker->randomElement(['Anak Kandung', 'Anak Tiri']),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'berat_badan' => $this->faker->randomFloat(1, 20, 80),
            'tinggi_badan' => $this->faker->randomFloat(1, 80, 180),
            'alamat' => $this->faker->address(),
            'bertempat_tinggal_pada' => $this->faker->randomElement(['Orang Tua', 'Menumpang', 'Asrama']),
            'telepon' => '08' . $this->faker->numerify('##########'),

            'asal_sekolah' => $this->faker->company(),
            'tgl_ijazah' => $tglIjazah->format('Y-m-d'),
            'lama_belajar' => $this->faker->randomElement(['6 Tahun', '9 Tahun']),
            'tanggal_diterima' => $tanggalDiterima->format('Y-m-d'),
            'kelas_diterima' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6']),

            'nama_ayah' => $this->faker->name('male'),
            'nama_ibu' => $this->faker->name('female'),
            'pendidikan_ayah' => $this->faker->randomElement(['SMP/Sederajat', 'SMA/Sederajat', 'S1 atau lebih']),
            'pendidikan_ibu' => $this->faker->randomElement(['SMP/Sederajat', 'SMA/Sederajat', 'S1 atau lebih']),
            'pekerjaan_ayah' => $this->faker->jobTitle(),
            'pekerjaan_ibu' => $this->faker->jobTitle(),

            'nama_wali' => $this->faker->name(),
            'pendidikan_wali' => $this->faker->randomElement(['SMP/Sederajat', 'SMA/Sederajat', 'S1 atau lebih']),
            'hubungan_wali' => $this->faker->randomElement(['Paman', 'Bibi', 'Kakek', 'Nenek', 'Orang Tugas']),
            'pekerjaan_wali' => $this->faker->jobTitle(),
            'alamat_wali' => $this->faker->address(),
            'telepon_wali' => '08' . $this->faker->numerify('##########'),
            'kewarganegaraan' => 'Indonesia',

            'KIP' => $this->faker->numerify('############'), // 12 digit angka
            'KIS' => $this->faker->numerify('############'),
            'KKS' => $this->faker->numerify('############'),

            'status_pendaftaran' => $this->faker->randomElement(['valid', 'pending','tidak_valid']),
        ];
    }
}
