<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - {{ $admission->full_name }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; line-height: 1.4; color: #333; }
        .kop-sekolah { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-sekolah h1 { font-size: 20px; margin: 0; }
        .kop-sekolah h2 { font-size: 16px; margin: 5px 0; font-weight: normal; }
        .kop-sekolah p { font-size: 10px; margin: 0; }
        .form-title { text-align: center; margin-bottom: 25px; }
        .form-title h3 { font-size: 16px; text-decoration: underline; margin: 0; }
        .form-title p { font-size: 12px; margin: 5px 0 0 0; }
        .section-title { font-size: 13px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; background-color: #f2f2f2; padding: 5px; border-radius: 3px; }
        .content-table { width: 100%; border-collapse: collapse; }
        .content-table td { padding: 6px; border: 1px solid #ddd; vertical-align: top; }
        .content-table .label { font-weight: bold; width: 30%; background-color: #f9f9f9; }
        .photo-section { position: absolute; top: 150px; right: 0px; width: 113px; height: 151px; border: 1px solid #333; padding: 2px; }
        .photo-section img { width: 100%; height: 100%; }
        .photo-placeholder { text-align: center; padding-top: 50px; font-size: 10px; color: #888; }
        .signature-section { margin-top: 40px; width: 100%; }
        .signature-box { float: right; width: 200px; text-align: center; }
        .signature-box .signature-title { margin-bottom: 60px; }
        .signature-box .signature-name { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="kop-sekolah">
        <h1>YAYASAN DARUL MUSTOFA</h1>
        <h2>SEKOLAH MENENGAH PERTAMA (SMP) Darul Mustofa</h2>
        <p>Alamat : JL. KH MOCH CHOLIL no 1 TUNJUNG BURNEH BANGKALAN | Telp: 0313099995 / 082334423433 | Email: smpdarulmustofa@gmail.com</p>
    </div>

    <div class="form-title">
        <h3>FORMULIR PENDAFTARAN PESERTA DIDIK BARU</h3>
        <p>Tahun Ajaran 2025/2026</p>
    </div>

    @php
        $photo = $admission->documents->where('document_name', 'pas_foto')->first();
    @endphp
    @if($photo && file_exists(public_path('storage/' . $photo->file_path)))
        <div class="photo-section">
             <img src="{{ public_path('storage/' . $photo->file_path) }}" alt="Foto Siswa">
        </div>
    @else
        <div class="photo-section photo-placeholder">
            Pas Foto 3x4
        </div>
    @endif


    <h3 class="section-title">A. DATA DIRI CALON SISWA</h3>
    <table class="content-table">
        <tr><td class="label">Nomor Pendaftaran</td><td>{{ $admission->registration_number }}</td></tr>
        <tr><td class="label">Nama Lengkap</td><td>{{ $admission->full_name }}</td></tr>
        <tr><td class="label">NISN</td><td>{{ $admission->nisn ?? '-' }}</td></tr>
        <tr><td class="label">Tempat, Tanggal Lahir</td><td>{{ $admission->birth_place }}, {{ \Carbon\Carbon::parse($admission->birth_date)->isoFormat('D MMMM Y') }}</td></tr>
        <tr><td class="label">Jenis Kelamin</td><td>{{ $admission->gender }}</td></tr>
        <tr><td class="label">Agama</td><td>{{ $admission->religion ?? '-' }}</td></tr>
    </table>

    <h3 class="section-title">B. DATA AKADEMIK ASAL</h3>
    <table class="content-table">
        <tr><td class="label">Asal Sekolah</td><td>{{ $admission->previous_school }}</td></tr>
        <tr><td class="label">Tahun Lulus</td><td>{{ $admission->graduation_year ?? '-' }}</td></tr>
        <tr><td class="label">Alamat Sekolah Asal</td><td>{{ $admission->school_address ?? '-' }}</td></tr>
    </table>

    <h3 class="section-title">C. DATA ALAMAT</h3>
    <table class="content-table">
        <tr><td class="label">Alamat Lengkap</td><td>{{ $admission->address }}</td></tr>
        <tr><td class="label">Desa / Kelurahan</td><td>{{ $admission->village ?? '-' }}</td></tr>
        <tr><td class="label">Kecamatan</td><td>{{ $admission->district ?? '-' }}</td></tr>
        <tr><td class="label">Kota / Kabupaten</td><td>{{ $admission->city ?? '-' }}</td></tr>
    </table>

    <h3 class="section-title">D. DATA ORANG TUA</h3>
    <table class="content-table">
        <tr><td class="label">Nama Ayah</td><td>{{ $admission->father_name }}</td></tr>
        <tr><td class="label">Pekerjaan Ayah</td><td>{{ $admission->father_job ?? '-' }}</td></tr>
        <tr><td class="label">No. HP Ayah</td><td>{{ $admission->father_phone ?? '-' }}</td></tr>
        <tr><td class="label">Nama Ibu</td><td>{{ $admission->mother_name }}</td></tr>
        <tr><td class="label">Pekerjaan Ibu</td><td>{{ $admission->mother_job ?? '-' }}</td></tr>
        <tr><td class="label">No. HP Ibu</td><td>{{ $admission->mother_phone ?? '-' }}</td></tr>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p class="signature-title">Sumenep, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p class="signature-name">{{ $admission->full_name }}</p>
            <p>Calon Siswa</p>
        </div>
    </div>
</body>
</html>
