<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->unique();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data Anak
            $table->string('nama_lengkap');
            $table->string('nisn');
            $table->date('tanggal_lahir');
            $table->string("tempat_lahir");
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('status_keluarga');
            $table->integer('anak_ke');
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->text('alamat');
            $table->string('bertempat_tinggal_pada');
            $table->string('telepon');

            // Pendidikan Sebelumnya
            $table->string('asal_sekolah')->nullable();
            $table->date('tgl_ijazah')->nullable();
            $table->string('lama_belajar')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('kelas_diterima')->nullable();

            // Data Orang Tua 
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pendidikan_ayah');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');

            //  Data Wali
            $table->string('nama_wali');
            $table->string('pendidikan_wali');
            $table->string('hubungan_wali');
            $table->string('pekerjaan_wali');
            $table->string('telepon_wali');
            $table->string('kewarganegaraan');
            $table->string('alamat_wali');


            // KIP/KKS/KIS
            $table->string('KIP')->nullable()->default('0');
            $table->string('KIS')->nullable()->default('0');
            $table->string('KKS')->nullable()->default('0');

            $table->enum('status_pendaftaran', ['valid', 'pending','tidak_valid'])->default("pending");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
