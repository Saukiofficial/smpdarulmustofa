@extends('layouts.frontend')

@section('title', 'Kalender Akademik')

@push('styles')
<style>
    .calendar-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #581c87 100%);
        position: relative;
        overflow: hidden;
    }

    .calendar-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="20" cy="80" r="0.5" fill="white" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(-20px) translateY(-10px); }
        50% { transform: translateX(20px) translateY(-20px); }
        75% { transform: translateX(-10px) translateY(10px); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .stats-container {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        margin-top: -60px;
        z-index: 10;
    }

    .stats-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b);
    }

    .stat-item {
        position: relative;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 60px;
        background: linear-gradient(to bottom, transparent, #e5e7eb, transparent);
    }

    .stat-item:hover {
        transform: scale(1.02);
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
    }

    .stat-number {
        font-size: 2.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .event-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .event-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .event-card:hover::before {
        transform: scaleX(1);
    }

    .date-display {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .date-badge {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        border-radius: 16px;
        padding: 1rem;
        text-align: center;
        min-width: 80px;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .date-number {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1;
    }

    .date-month {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        opacity: 0.9;
    }

    .event-content {
        flex: 1;
    }

    .event-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .event-meta i {
        color: #3b82f6;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 20px;
        border: 2px dashed #cbd5e1;
    }

    .empty-icon {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .scroll-top-btn {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .scroll-top-btn:hover {
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.5);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .section-subtitle {
        color: #64748b;
        text-align: center;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .events-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-item:not(:last-child)::after {
            display: none;
        }

        .stats-container {
            margin-top: -40px;
        }

        .hero-content {
            padding: 3rem 0;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="calendar-hero">
    <div class="hero-content py-20">
        <div class="container mx-auto px-6 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">
                Kalender Akademik
            </h1>
            <p class="text-xl md:text-2xl opacity-90 font-light">
                SMK Siding Puri - Tahun Ajaran 2025/2026
            </p>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container mx-auto px-6">
    <div class="stats-container">
        <div class="grid grid-cols-2 md:grid-cols-4">
            <div class="stat-item">
                <div class="stat-number">{{ $totalEvents }}</div>
                <div class="stat-label">Total Kegiatan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $examCount }}</div>
                <div class="stat-label">Ujian Semester</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $nationalDayCount }}</div>
                <div class="stat-label">Hari Nasional</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $holidayCount }}</div>
                <div class="stat-label">Libur Semester</div>
            </div>
        </div>
    </div>
</div>

<!-- Events Section -->
<div class="py-16 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container mx-auto px-6">
        <h2 class="section-title">Daftar Kegiatan</h2>
        <p class="section-subtitle">
            Seluruh agenda dan kegiatan akademik yang telah dijadwalkan
        </p>

        <div class="events-grid">
            @forelse ($events as $event)
            <div class="event-card">
                <div class="date-display">
                    <div class="date-badge">
                        <div class="date-number">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</div>
                        <div class="date-month">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</div>
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->title }}</h3>
                        <div class="event-meta">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-600 mb-2">
                    Belum Ada Kegiatan
                </h3>
                <p class="text-slate-500">
                    Belum ada kegiatan akademik yang dijadwalkan untuk saat ini.
                </p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Scroll to Top Button -->
<div class="scroll-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    <i class="fas fa-arrow-up"></i>
</div>
@endsection
