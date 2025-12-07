<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmissionController extends Controller
{
    public function index()
    {
        $admissions = Admission::latest()->paginate(20);
        return view('pages.admin.admissions.index', compact('admissions'));
    }

    public function show(Admission $ppdb)
    {
        $ppdb->load('documents');
        return view('pages.admin.admissions.show', ['admission' => $ppdb]);
    }


    public function downloadForm(Admission $ppdb)
    {
        $data = [
            'admission' => $ppdb->load('documents')
        ];

        $pdf = Pdf::loadView('pages.admin.admissions.pdf-template', $data);
        $fileName = 'Formulir-PPDB-' . Str::slug($ppdb->full_name) . '.pdf';

        return $pdf->download($fileName);
    }

    public function update(Request $request, Admission $ppdb)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,pending',
        ]);

        $ppdb->update(['status' => $request->status]);

        return redirect()->route('admin.ppdb.index')->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function destroy(Admission $ppdb)
    {

        $ppdb->delete();
        return redirect()->route('admin.ppdb.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
}
