@extends('layouts.frontend')

@section('title', 'Jadwal Pelajaran')

@push('styles')
<style>
    .schedule-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        position: relative;
        overflow: hidden;
    }

    .schedule-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        animation: drift 30s linear infinite;
    }

    @keyframes drift {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .class-selector {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        margin-top: -50px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .class-selector::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #059669, #0d9488, #0891b2, #0284c7);
        border-radius: 20px 20px 0 0;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-label {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1e293b;
        text-align: center;
    }

    .form-controls {
        display: flex;
        gap: 0;
        max-width: 500px;
        margin: 0 auto;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
    }

    .class-select {
        flex: 1;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        font-size: 1rem;
        font-weight: 500;
        color: #334155;
        border-right: none;
        border-radius: 12px 0 0 12px;
        transition: all 0.3s ease;
    }

    .class-select:focus {
        outline: none;
        border-color: #0891b2;
        background: white;
        box-shadow: inset 0 0 0 1px #0891b2;
    }

    .submit-btn {
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #0891b2, #0d9488);
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 0 12px 12px 0;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.875rem;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, #0e7490, #0f766e);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(8, 145, 178, 0.3);
    }

    .schedule-container {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .schedule-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #059669, #0d9488, #0891b2, #0284c7);
    }

    .schedule-title {
        text-align: center;
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 2rem;
        position: relative;
    }

    .schedule-title::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #0891b2, #0d9488);
        border-radius: 2px;
    }

    .day-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        border-radius: 16px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .day-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .day-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .day-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #0891b2, #0d9488);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .subjects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
    }

    .subject-card {
        background: white;
        padding: 1.25rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .subject-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, #0891b2, #0d9488);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .subject-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: #0891b2;
    }

    .subject-card:hover::before {
        transform: scaleY(1);
    }

    .subject-name {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .subject-time {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .subject-time i {
        color: #0891b2;
        font-size: 0.75rem;
    }

    .subject-teacher {
        font-size: 0.875rem;
        color: #0891b2;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .subject-teacher i {
        font-size: 0.75rem;
    }

    .empty-schedule {
        text-align: center;
        padding: 3rem;
        color: #64748b;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
        border: 2px dashed #cbd5e1;
    }

    .empty-icon {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #0891b2, #0d9488);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(8, 145, 178, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-to-top:hover {
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 12px 35px rgba(8, 145, 178, 0.5);
    }

    @media (max-width: 768px) {
        .form-controls {
            flex-direction: column;
            border-radius: 12px;
        }

        .class-select {
            border-radius: 12px 12px 0 0;
            border-right: 2px solid #e2e8f0;
        }

        .submit-btn {
            border-radius: 0 0 12px 12px;
        }

        .subjects-grid {
            grid-template-columns: 1fr;
        }

        .schedule-container {
            padding: 1.5rem;
        }

        .day-section {
            padding: 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="schedule-hero">
    <div class="hero-content py-20">
        <div class="container mx-auto px-6 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">
                Jadwal Pelajaran
            </h1>
            <p class="text-xl md:text-2xl opacity-90 font-light">
                Lihat jadwal pelajaran untuk semua kelas
            </p>
        </div>
    </div>
</div>

<!-- Class Selector -->
<div class="container mx-auto px-6">
    <div class="class-selector">
        <form action="{{ route('academic.schedule') }}" method="GET" class="form-group">
            <label for="class_id" class="form-label">
                Pilih Kelas untuk Melihat Jadwal
            </label>
            <div class="form-controls">
                <select name="class_id" id="class_id" class="class-select">
                    <option value="">-- Pilih Kelas --</option>
                    {{-- Loop dari data $classes --}}
                    <option value="1">Kelas 10-A</option>
                    <option value="2">Kelas 11-B</option>
                    <option value="3">Kelas 12-C</option>
                </select>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-search mr-2"></i>
                    Tampilkan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Schedule Display -->
<div class="py-16 bg-gradient-to-br from-slate-50 to-cyan-50">
    <div class="container mx-auto px-6">
        <div class="schedule-container">
            <h2 class="schedule-title">Jadwal Kelas 10-A</h2>

            <div class="space-y-6">
                {{-- Loop per hari --}}
                @php
                    $schedule_data = [
                        'Senin' => 'MON',
                        'Selasa' => 'TUE',
                        'Rabu' => 'WED',
                        'Kamis' => 'THU',
                        'Jumat' => 'FRI'
                    ];
                    $subjects = [
                        'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris',
                        'Fisika', 'Kimia', 'Biologi',
                        'Sejarah', 'Geografi', 'Ekonomi'
                    ];
                    $teachers = [
                        'Dr. Ahmad Susanto', 'Dra. Siti Rahayu', 'M.Pd. Budi Santoso',
                        'S.Pd. Maya Kartini', 'Dr. Eko Prasetyo', 'M.Si. Dewi Lestari',
                        'S.Pd. Rizki Fadila', 'M.A. Indra Wijaya', 'S.E. Rina Maharani'
                    ];
                @endphp

                @foreach($schedule_data as $day => $dayCode)
                <div class="day-section">
                    <div class="day-title">
                        <div class="day-icon">{{ $dayCode }}</div>
                        {{ $day }}
                    </div>

                    <div class="subjects-grid">
                        {{-- Loop per jam pelajaran --}}
                        @for($i = 0; $i < 3; $i++)
                        <div class="subject-card">
                            <h4 class="subject-name">{{ $subjects[($loop->index * 3 + $i) % count($subjects)] }}</h4>
                            <div class="subject-time">
                                <i class="fas fa-clock"></i>
                                {{ sprintf('%02d:00 - %02d:00', 7 + $i, 8 + $i) }}
                            </div>
                            <div class="subject-teacher">
                                <i class="fas fa-user-tie"></i>
                                {{ $teachers[($loop->index * 3 + $i) % count($teachers)] }}
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    <i class="fas fa-arrow-up"></i>
</div>
@endsection
