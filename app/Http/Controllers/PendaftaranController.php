<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Validator;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function PendaftaranStore(Request $request)
    {


        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits_between:10,12',
            'nik' => 'required|numeric|digits_between:12,17',
            'nomor_kk' => 'required|numeric|digits_between:12,17',
            'jenis_kelamin' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'status_keluarga' => 'required|string|max:100',
            'anak_ke' => 'required|numeric|min:1',
            'berat_badan' => 'required|numeric|min:1',
            'tinggi_badan' => 'required|numeric|min:1',
            'alamat' => 'required|string|max:255',
            'bertempat_tinggal_pada' => 'required|string|max:100',
            'telepon' => 'required|numeric|digits_between:9,15',

            'asal_sekolah' => 'nullable|string|max:255',
            'tgl_ijazah' => 'nullable|date',
            'lama_belajar' => 'nullable|string|max:50',
            'tanggal_diterima' => 'nullable|date',
            'kelas_diterima' => 'nullable|string|max:50',

            'nik_ibu' => 'required|numeric|digits_between:12,17',
            'nik_ayah' => 'required|numeric|digits_between:12,17',
            'status_ayah' => 'required|string|max:255',
            'status_ibu' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pendidikan_ayah' => 'required|string|max:100',
            'pendidikan_ibu' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:100',



            'nama_wali' => 'nullable|string|max:255',
            'pendidikan_wali' => 'nullable|string|max:100',
            'hubungan_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
            'telepon_wali' => 'nullable|numeric|digits_between:9,15',
            'alamat_wali' => 'nullable|string|max:255',

            'kewarganegaraan' => 'required|string|',


            'KIP' => 'nullable|string|max:50',
            'KIS' => 'nullable|string|max:50',
            'KKS' => 'nullable|string|max:50',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (
                $request->status_ayah === 'sudah_tiada' &&
                $request->status_ibu === 'sudah_tiada'
            ) {
                $waliFields = [
                    'nama_wali',
                    'pendidikan_wali',
                    'hubungan_wali',
                    'pekerjaan_wali',
                    'telepon_wali',
                    'alamat_wali',
                ];

                foreach ($waliFields as $field) {
                    if (empty($request->$field)) {
                        $validator->errors()->add($field, 'Field ' . str_replace('_', ' ', $field) . ' wajib diisi jika ayah dan ibu sudah tiada.');
                    }
                }
            }
        });

        if ($validator->fails()) {


            $notification = array(
                'message' => 'Terdapat Kesalahan Input',
                'alert-type' => 'error'
            );

            return redirect()->back()
                ->withErrors($validator)
                ->with($notification)
                ->withInput();
        }

        if ($request->status_ayah === "masih_hidup" or $request->status_ibu === "masih_hidup") {
            $request->nama_wali = null;
            $request->pendidikan_wali = null;
            $request->hubungan_wali = null;
            $request->pekerjaan_wali = null;
            $request->telepon_wali = null;
            $request->alamat_wali = null;

        }

        // Simpan data
        $pendaftaran = new Pendaftaran();
        $pendaftaran->user_id = auth()->id(); // atau sesuai kebutuhan
        $pendaftaran->nama_lengkap = $request->nama_lengkap;
        $pendaftaran->nisn = $request->nisn;
        $pendaftaran->nik = $request->nik;
        $pendaftaran->nomor_kk = $request->nomor_kk;
        $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
        $pendaftaran->tempat_lahir = $request->tempat_lahir;
        $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
        $pendaftaran->agama = $request->agama;
        $pendaftaran->status_keluarga = $request->status_keluarga;
        $pendaftaran->anak_ke = $request->anak_ke;
        $pendaftaran->berat_badan = $request->berat_badan;
        $pendaftaran->tinggi_badan = $request->tinggi_badan;
        $pendaftaran->alamat = $request->alamat;
        $pendaftaran->bertempat_tinggal_pada = $request->bertempat_tinggal_pada;
        $pendaftaran->telepon = $request->telepon;
        $pendaftaran->asal_sekolah = $request->asal_sekolah;
        $pendaftaran->tgl_ijazah = $request->tgl_ijazah;
        $pendaftaran->lama_belajar = $request->lama_belajar;
        $pendaftaran->tanggal_diterima = $request->tanggal_diterima;
        $pendaftaran->kelas_diterima = $request->kelas_diterima;

        $pendaftaran->nik_ibu = $request->nik_ibu;
        $pendaftaran->nik_ayah = $request->nik_ayah;
        $pendaftaran->status_ayah = $request->status_ayah;
        $pendaftaran->status_ibu = $request->status_ibu;
        $pendaftaran->nama_ayah = $request->nama_ayah;
        $pendaftaran->nama_ibu = $request->nama_ibu;
        $pendaftaran->pendidikan_ayah = $request->pendidikan_ayah;
        $pendaftaran->pendidikan_ibu = $request->pendidikan_ibu;
        $pendaftaran->pekerjaan_ayah = $request->pekerjaan_ayah;
        $pendaftaran->pekerjaan_ibu = $request->pekerjaan_ibu;

        $pendaftaran->nama_wali = $request->nama_wali ?? '';
        $pendaftaran->pendidikan_wali = $request->pendidikan_wali ?? '';
        $pendaftaran->hubungan_wali = $request->hubungan_wali ?? '';
        $pendaftaran->pekerjaan_wali = $request->pekerjaan_wali ?? '';
        $pendaftaran->kewarganegaraan = $request->kewarganegaraan ?? '';
        $pendaftaran->telepon_wali = $request->telepon_wali ?? '';
        $pendaftaran->alamat_wali = $request->alamat_wali ?? '';

        $pendaftaran->KIP = $request->KIP;
        $pendaftaran->KIS = $request->KIS;
        $pendaftaran->KKS = $request->KKS;
        $pendaftaran->save();

        $notification = array(
            'message' => 'Pendaftaran Berhasil',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil!')->with($notification);
    }


    public function PendaftaranUpdate(Request $request)
    {
        try {
            // Cek apakah kedua orang tua sudah tiada
            $keduaOrangTuaMeninggal = (
                $request->status_ayah === 'sudah_tiada' &&
                $request->status_ibu === 'sudah_tiada'
            );

            // Aturan validasi utama
            $rules = [
                'nama_lengkap' => 'required|string|max:255',
                'nisn' => 'required|numeric|digits_between:10,12',
                'nik' => 'required|numeric|digits_between:12,17',
                'nomor_kk' => 'required|numeric|digits_between:12,17',
                'jenis_kelamin' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|string|max:50',
                'status_keluarga' => 'required|string|max:100',
                'anak_ke' => 'required|numeric|min:1',
                'berat_badan' => 'required|numeric|min:1',
                'tinggi_badan' => 'required|numeric|min:1',
                'alamat' => 'required|string|max:255',
                'bertempat_tinggal_pada' => 'required|string|max:100',
                'telepon' => 'required|numeric|digits_between:9,15',

                // Pendidikan sebelumnya
                'asal_sekolah' => 'nullable|string|max:255',
                'tgl_ijazah' => 'nullable|date',
                'lama_belajar' => 'nullable|string|max:50',
                'tanggal_diterima' => 'nullable|date',
                'kelas_diterima' => 'nullable|string|max:50',

                // Orang tua
                'nik_ibu' => 'required|numeric|digits_between:12,17',
                'nik_ayah' => 'required|numeric|digits_between:12,17',
                'status_ayah' => 'required|string|max:255',
                'status_ibu' => 'required|string|max:255',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'pendidikan_ayah' => 'required|string|max:100',
                'pendidikan_ibu' => 'required|string|max:100',
                'pekerjaan_ayah' => 'required|string|max:100',
                'pekerjaan_ibu' => 'required|string|max:100',
                'kewarganegaraan' => 'required|string|max:255',

                // Kartu pendukung
                'KIP' => 'nullable|string|max:50',
                'KIS' => 'nullable|string|max:50',
                'KKS' => 'nullable|string|max:50',
            ];

            // Aturan untuk wali
            $waliRules = [
                'nama_wali' => 'required|string|max:255',
                'pendidikan_wali' => 'required|string|max:100',
                'hubungan_wali' => 'required|string|max:100',
                'pekerjaan_wali' => 'required|string|max:100',
                'telepon_wali' => 'required|numeric|digits_between:9,15',
                
                'alamat_wali' => 'required|string|max:255',
            ];

            if ($keduaOrangTuaMeninggal) {
                // Wajib isi wali
                $rules = array_merge($rules, $waliRules);
            } else {
                // Field wali boleh kosong
                foreach ($waliRules as $key => $value) {
                    $rules[$key] = 'nullable';
                }
            }

            // Validasi dengan validator manual (untuk debug lebih mudah)
            $validator = \Validator::make($request->all(), $rules);

          

            $validated = $validator->validated();

            // Kosongkan data wali jika tidak dibutuhkan
            if (!$keduaOrangTuaMeninggal) {
                foreach (array_keys($waliRules) as $field) {
                    $validated[$field] = '';
                }
            }

            // Ambil data pendaftaran user
            $pendaftaran = Pendaftaran::where('user_id', auth()->id())->firstOrFail();

            // Update data
            $pendaftaran->update($validated);

            return redirect()->back()->with([
                'success' => 'Data pendaftaran berhasil diperbarui.',
                'message' => 'Pendaftaran Berhasil Diperbarui',
                'alert-type' => 'success'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with([
                    'modal' => 'pendaftaranModal',
                    'message' => 'Terdapat Kesalahan Input Silahkan Edit Lagi ',
                    'alert-type' => 'error'
                ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
                    'message' => 'Terdapat Kesalahan ',
                    'alert-type' => 'error'
                ]);
        }
    }







    public function pendaftaranDownload()
    {
        Carbon::setLocale('id');
        // Ambil data pendaftaran berdasarkan user_id
        $data = Pendaftaran::where('user_id', Auth::id())->first();

        // Jika tidak ditemukan, abort 404
        if (!$data) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        // Load view PDF dan generate file
        $pdf = Pdf::loadView('formulir_pdf', compact('data'))
            ->setPaper('A4', 'portrait');

        // Download PDF
        return $pdf->download('Formulir_Pendaftaran_' . $data->nama_lengkap . '.pdf');
    }

    public function PendaftaranDelete()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('user.pendaftaran')
                ->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $pendaftaran->delete();

        $notification = [
            'message' => 'Pendaftaran Berhasil Dihapus',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.hasil-seleksi')
            ->with($notification);
    }

}
