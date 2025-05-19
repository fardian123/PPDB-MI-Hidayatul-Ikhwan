<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Validator;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    public function PendaftaranStore(Request $request)
    {


        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits_between:10,12',
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

            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pendidikan_ayah' => 'required|string|max:100',
            'pendidikan_ibu' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:100',

            'nama_wali' => 'required|string|max:255',
            'pendidikan_wali' => 'required|string|max:100',
            'hubungan_wali' => 'required|string|max:100',
            'pekerjaan_wali' => 'required|string|max:100',
            'telepon_wali' => 'required|numeric|digits_between:9,15',
            'kewarganegaraan' => 'required|string|',
            'alamat_wali' => 'required|string|max:255',


            'KIP' => 'nullable|string|max:50',
            'KIS' => 'nullable|string|max:50',
            'KKS' => 'nullable|string|max:50',
        ]);

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

        // Simpan data
        $pendaftaran = new Pendaftaran();
        $pendaftaran->user_id = auth()->id(); // atau sesuai kebutuhan
        $pendaftaran->nama_lengkap = $request->nama_lengkap;
        $pendaftaran->nisn = $request->nisn;
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

        $pendaftaran->nama_ayah = $request->nama_ayah;
        $pendaftaran->nama_ibu = $request->nama_ibu;
        $pendaftaran->pendidikan_ayah = $request->pendidikan_ayah;
        $pendaftaran->pendidikan_ibu = $request->pendidikan_ibu;
        $pendaftaran->pekerjaan_ayah = $request->pekerjaan_ayah;
        $pendaftaran->pekerjaan_ibu = $request->pekerjaan_ibu;

        $pendaftaran->nama_wali = $request->nama_wali;
        $pendaftaran->pendidikan_wali = $request->pendidikan_wali;
        $pendaftaran->hubungan_wali = $request->hubungan_wali;
        $pendaftaran->pekerjaan_wali = $request->pekerjaan_wali;
        $pendaftaran->kewarganegaraan = $request->kewarganegaraan;
        $pendaftaran->telepon_wali = $request->telepon_wali;
        $pendaftaran->alamat_wali = $request->alamat_wali;

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

            // Validasi inputan
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nisn' => 'required|numeric|digits_between:10,12',
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

                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'pendidikan_ayah' => 'required|string|max:100',
                'pendidikan_ibu' => 'required|string|max:100',
                'pekerjaan_ayah' => 'required|string|max:100',
                'pekerjaan_ibu' => 'required|string|max:100',

                'nama_wali' => 'required|string|max:255',
                'pendidikan_wali' => 'required|string|max:100',
                'hubungan_wali' => 'required|string|max:100',
                'pekerjaan_wali' => 'required|string|max:100',
                'kewarganegaraan' => 'required|string|',
                'telepon_wali' => 'required|numeric|digits_between:9,15',
                'alamat_wali' => 'required|string|max:100',

                'KIP' => 'nullable|string|max:50',
                'KIS' => 'nullable|string|max:50',
                'KKS' => 'nullable|string|max:50',
            ]);

            // Ambil data pendaftaran berdasarkan user yang login
            $pendaftaran = Pendaftaran::where('user_id', auth()->id())->firstOrFail();

            // Update data
            $pendaftaran->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'status_keluarga' => $request->status_keluarga,
                'anak_ke' => $request->anak_ke,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'alamat' => $request->alamat,
                'bertempat_tinggal_pada' => $request->bertempat_tinggal_pada,
                'telepon' => $request->telepon,

                // Pendidikan sebelumnya
                'asal_sekolah' => $request->asal_sekolah,
                'tgl_ijazah' => $request->tgl_ijazah,
                'lama_belajar' => $request->lama_belajar,
                'tanggal_diterima' => $request->tanggal_diterima,
                'kelas_diterima' => $request->kelas_diterima,

                // Orang tua
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,

                'nama_wali' => $request->nama_wali,
                'pendidikan_wali' => $request->pendidikan_wali,
                'hubungan_wali' => $request->hubungan_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'kewarganegaraan' => $request->kewarganegaraan,
                'telepon_wali' => $request->telepon_wali,
                'alamat_wali' => $request->alamat_wali,

                'KIP' => $request->KIP,
                'KIS' => $request->KIS,
                'KKS' => $request->KKS,
            ]);


            $notification = array(
                'message' => 'Pendaftaran Berhasil Diperbarui',
                'alert-type' => 'success'
            );

            return redirect()->back()->with('success', 'Data pendaftaran berhasil diperbarui.')->with($notification);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $notification = array(
                'message' => 'Terdapat Kesalahan Input Silahkan Edit Lagi ',
                'alert-type' => 'error'
            );
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'pendaftaranModal')->with($notification); // <-- tambahan, kasih tahu modal mana yang perlu dibuka
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Terdapat Kesalahan ',
                'alert-type' => 'error'
            );
            // Catch error lain, misal gagal query database
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput()->with($notification);
        }


    }

    public function pendaftaranDownload()
    {
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
