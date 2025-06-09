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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;

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

            $pendaftarans = $query->with('user')->orderBy('created_at', 'desc')->get();
        } else {
            // User hanya bisa melihat pendaftarannya sendiri
            $pendaftarans = Pendaftaran::with('user')->where('user_id', Auth::id())->get();
        }

        return view('petugas.petugas_master_peserta_didik', compact('pendaftarans'));
    }



    public function petugasStore(Request $request)
    {
        // Validasi
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

            'kewarganegaraan' => 'required|string',

            'KIP' => 'nullable|string|max:50',
            'KIS' => 'nullable|string|max:50',
            'KKS' => 'nullable|string|max:50',
        ]);

        // Validasi wali jika orang tua tiada
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

        // Jika validasi gagal
        if ($validator->fails()) {
            $notification = [
                'message' => 'Terdapat Kesalahan Input',
                'alert-type' => 'error'
            ];

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        // Kosongkan data wali jika salah satu orang tua masih hidup
        if ($request->status_ayah === "masih_hidup" || $request->status_ibu === "masih_hidup") {
            $request->merge([
                'nama_wali' => null,
                'pendidikan_wali' => null,
                'hubungan_wali' => null,
                'pekerjaan_wali' => null,
                'telepon_wali' => null,
                'alamat_wali' => null,
            ]);
        }

        // Simpan data dalam try-catch
        try {
            $pendaftaran = new Pendaftaran();
            $pendaftaran->user_id = $request->input('user_id') ?? auth()->id(); // Jika petugas memasukkan user_id

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
            $pendaftaran->telepon_wali = $request->telepon_wali ?? '';
            $pendaftaran->alamat_wali = $request->alamat_wali ?? '';
            $pendaftaran->kewarganegaraan = $request->kewarganegaraan ?? '';

            $pendaftaran->KIP = $request->KIP;
            $pendaftaran->KIS = $request->KIS;
            $pendaftaran->KKS = $request->KKS;

            $pendaftaran->save();

            $notification = [
                'message' => 'Pendaftaran Berhasil Disimpan oleh Petugas',
                'alert-type' => 'success'
            ];

            return redirect()->route('petugas.dashboard')->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->withInput()->with($notification);
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
                'kewarganegaraan' => 'required|string|max:255',

                'KIP' => 'nullable|string|max:50',
                'KIS' => 'nullable|string|max:50',
                'KKS' => 'nullable|string|max:50',
            ];

            // Aturan wali jika orang tua sudah tiada
            $waliRules = [
                'nama_wali' => 'required|string|max:255',
                'pendidikan_wali' => 'required|string|max:100',
                'hubungan_wali' => 'required|string|max:100',
                'pekerjaan_wali' => 'required|string|max:100',
                'telepon_wali' => 'required|numeric|digits_between:9,15',
                'alamat_wali' => 'required|string|max:255',
            ];

            if ($keduaOrangTuaMeninggal) {
                $rules = array_merge($rules, $waliRules);
            } else {
                // Jika tidak meninggal, data wali boleh kosong
                foreach ($waliRules as $key => $value) {
                    $rules[$key] = 'nullable';
                }
            }

            // Validasi data
            $validator = \Validator::make($request->all(), $rules);
            $validated = $validator->validated();

            // Kosongkan data wali jika tidak wajib
            if (!$keduaOrangTuaMeninggal) {
                foreach (array_keys($waliRules) as $field) {
                    $validated[$field] = '';
                }
            }

            // Ambil data pendaftaran
            $pendaftaran = Pendaftaran::findOrFail($id);

            // Update data pendaftaran
            $pendaftaran->update($validated);

            return redirect()->back()->with([
                'message' => 'Data pendaftaran berhasil diperbarui.',
                'alert-type' => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalEditData-' . $id)
                ->with([
                    'message' => 'Terdapat kesalahan input. Silakan periksa kembali.',
                    'alert-type' => 'error'
                ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                    'alert-type' => 'error'
                ]);
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
    public function petugasDownloadFormulir($id)
    {
        Carbon::setLocale('id');
        // Ambil data pendaftaran berdasarkan ID
        $data = Pendaftaran::findOrFail($id);

        // Load view PDF dan generate file
        $pdf = Pdf::loadView('formulir_pdf', compact('data'))
            ->setPaper('A4', 'portrait');

        // Download PDF
        return $pdf->download('Formulir_Pendaftaran_' . $data->nama_lengkap . '.pdf');
    }

    public function petugasLaporan(Request $request)
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

            $pendaftarans = $query->with('user')->orderBy('created_at', 'desc')->get();
        } else {
            // User hanya bisa melihat pendaftarannya sendiri
            $pendaftarans = Pendaftaran::with('user')->where('user_id', Auth::id())->get();
        }

        return view('petugas.petugas_laporan', compact('pendaftarans'));
    }

    public function petugasDownloadRekapan(Request $request)
    {
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        $fileName = "rekap_pendaftaran_{$start}_sd_{$end}.xlsx";

        return Excel::download(new PendaftaranExport($start, $end), $fileName);
    }


}
