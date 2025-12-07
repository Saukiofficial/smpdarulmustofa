<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\AdmissionDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdmissionController extends Controller
{
    /**
     * Menampilkan halaman form pendaftaran.
     * Diubah dari create() menjadi index() untuk menyesuaikan dengan route Anda.
     */
    public function index()
    {
        return view('pages.frontend.admission.index');
    }

    /**
     * Menyimpan data pendaftaran baru dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form SMP yang baru
        $validated = $request->validate([
            // Data Diri
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits_between:10,10|unique:admissions,nisn',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'religion' => 'required|string|max:255',

            // Data Akademik Asal
            'previous_school' => 'required|string|max:255',
            'school_address' => 'required|string',
            'graduation_year' => 'required|numeric|digits:4',

            // Alamat
            'address' => 'required|string',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',

            // Data Orang Tua
            'father_name' => 'required|string|max:255',
            'father_job' => 'required|string|max:255',
            'father_phone' => 'required|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_job' => 'required|string|max:255',
            'mother_phone' => 'required|string|max:15',

            // Berkas (sesuaikan nama input file di form Anda)
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Ijazah boleh kosong
            'skl' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // Persetujuan
            'agreement' => 'required',
        ]);

        // 2. Gunakan DB Transaction untuk memastikan semua data tersimpan atau tidak sama sekali
        DB::beginTransaction();
        try {
            // 3. Buat data pendaftar baru
            $admission = Admission::create([
                'registration_number' => 'PPDB-SMP-' . date('Y') . '-' . Str::upper(Str::random(5)),
                'full_name' => $validated['full_name'],
                'nisn' => $validated['nisn'],
                'gender' => $validated['gender'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'religion' => $validated['religion'],
                'previous_school' => $validated['previous_school'],
                'school_address' => $validated['school_address'],
                'graduation_year' => $validated['graduation_year'],
                'address' => $validated['address'],
                'village' => $validated['village'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'father_name' => $validated['father_name'],
                'father_job' => $validated['father_job'],
                'father_phone' => $validated['father_phone'],
                'mother_name' => $validated['mother_name'],
                'mother_job' => $validated['mother_job'],
                'mother_phone' => $validated['mother_phone'],
            ]);

            // 4. Proses upload berkas
            $documentsToUpload = [
                'pas_foto',
                'akta_kelahiran',
                'kartu_keluarga',
                'ijazah',
                'skl',
            ];

            foreach ($documentsToUpload as $docName) {
                if ($request->hasFile($docName)) {
                    $path = $request->file($docName)->store("admissions/{$admission->id}", 'public');
                    $admission->documents()->create([
                        'document_name' => $docName,
                        'file_path' => $path,
                    ]);
                }
            }

            // Jika semua berhasil, commit transaksi
            DB::commit();

            // 5. Redirect dengan pesan sukses
            return redirect()->route('admission.index')->with('success', 'Pendaftaran Anda berhasil! Nomor pendaftaran Anda adalah: ' . $admission->registration_number);

        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua perubahan
            DB::rollBack();

            // Tampilkan error untuk debugging (bisa di-log) dan kembalikan ke form dengan pesan error
            // return back()->with('error', 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi. Error: ' . $e->getMessage())->withInput();
             return back()->with('error', 'Terjadi kesalahan saat pendaftaran. Pastikan semua data terisi dengan benar dan coba lagi.')->withInput();
        }
    }

    /**
     * Menampilkan halaman untuk mengecek hasil pendaftaran.
     */
    public function results(Request $request)
    {
        $admission = null;
        if ($request->has('registration_number')) {
            $admission = Admission::where('registration_number', $request->registration_number)->first();
        }

        return view('pages.frontend.admission.results', compact('admission'));
    }
}

