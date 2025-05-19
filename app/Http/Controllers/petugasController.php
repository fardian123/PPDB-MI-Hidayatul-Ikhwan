<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Validator;
use ValidationException;
use Carbon\Carbon;

class petugasController extends Controller
{

    public function petugasDashboard()
    {
        $startDate = Carbon::createFromDate(now()->year, 5, 1); // Mei
        $endDate = Carbon::createFromDate(now()->year, 7, 31); // Juli

        $pendaftarTerbaru = Pendaftaran::latest()->limit(6)->get();

        $valid = Pendaftaran::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pendaftaran', 'valid')->count();

        $tidak_valid = Pendaftaran::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pendaftaran', 'tidak_valid')->count();

        $pending = Pendaftaran::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_pendaftaran', 'pending')->count();

        return view('petugas.petugas_index', [
            'pendaftarTerbaru' => $pendaftarTerbaru,
            'valid' => $valid,
            'tidak_valid' => $tidak_valid,
            'pending' => $pending,
            'bulanLabel' => 'Mei - Juli ' . now()->year
        ]);

    }
    public function petugasProfileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'petugas Profile Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function petugasProfile()
    {
        return view('petugas.petugas_profile');
    }

    public function petugasChangePassword()
    {
        $profileData = User::find(Auth::user()->id);

        return view('petugas.petugas_change_password', compact('profileData'));
    }

    public function petugasPasswordUpdate(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed|',

        ]);
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old password Doesnt match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // update new password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Succes',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function petugasMasterPesertaDidik(Request $request)
    {
        if (Auth::user()->role === 'petugas') {
            $query = Pendaftaran::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%")
                    ->orwhere('user_id', 'like', "%{$search}%")
                    ->orwhere('status_pendaftaran', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%"); // Tambahkan kolom lain jika perlu
            }

            $pendaftarans = $query->with('user')->get();
        } else {
            // User hanya bisa melihat pendaftarannya sendiri
            $pendaftarans = Pendaftaran::with('user')->where('user_id', Auth::id())->get();
        }

        return view('petugas.petugas_master_peserta_didik', compact('pendaftarans'));
    }



    public function petugasStore(Request $request)
    {
        try {
            // Validasi input
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
                'kewarganegaraan' => 'required|string',
                'alamat_wali' => 'required|string|max:255',

                'KIP' => 'nullable|string|max:50',
                'KIS' => 'nullable|string|max:50',
                'KKS' => 'nullable|string|max:50',
            ]);

            // Jika validasi gagal, trigger manual ValidationException agar masuk ke catch-nya
            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            // Simpan ke database
            Pendaftaran::create($validator->validated());

            // Notifikasi berhasil
            return redirect()->route('petugas.master_peserta_didik')->with([
                'message' => 'Pendaftaran berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            $notification = [
                'message' => 'Terdapat kesalahan input. Silakan periksa kembali.',
                'alert-type' => 'error'
            ];
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'tambahPendaftarModal') // Buka kembali modal jika perlu
                ->with($notification);

        } catch (\Exception $e) {
            // Untuk error lainnya
            $notification = [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()
                ->withInput()
                ->with($notification);
        }
    }

    public function petugasUpdateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->save();

        return response()->json(['message' => 'Status updated']);
    }

    public function petugasUpdatePendaftaran(Request $request, $id)
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
                'kewarganegaraan' => 'required|string',
                'telepon_wali' => 'required|numeric|digits_between:9,15',
                'alamat_wali' => 'required|string|max:100',

                'KIP' => 'nullable|string|max:50',
                'KIS' => 'nullable|string|max:50',
                'KKS' => 'nullable|string|max:50',
            ]);

            // Ambil data pendaftaran berdasarkan ID
            $pendaftaran = Pendaftaran::findOrFail($id);

            // Update data pendaftaran
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

            $notification = [
                'message' => 'Data pendaftaran berhasil diperbarui.',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $notification = [
                'message' => 'Terdapat kesalahan input. Silakan periksa kembali.',
                'alert-type' => 'error'
            ];
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalEditData-' . $id) // Otomatis buka modal sesuai ID
                ->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()
                ->withInput()
                ->with($notification);
        }
    }

    public function petugasHapusPendaftaran(Request $request)
    {



        $notification = [
            'message' => 'Data pendaftaran berhasil dihapus.',
            'alert-type' => 'success'
        ];

        $pendaftaran = Pendaftaran::findOrFail($request->id);
        $pendaftaran->delete();

        return redirect()->back()->with([
            'message' => 'Data pendaftaran berhasil dihapus.',
            'alert-type' => 'success'
        ])->with($notification);

    }


}
