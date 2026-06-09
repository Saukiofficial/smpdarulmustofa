@extends('layouts.frontend')

@section('title', 'Kalender Akademik')

@push('styles')
<style>
    :root {
        --cal-navy: #061b36;
        --cal-navy-2: #0b2b52;
        --cal-gold: #dba52d;
        --cal-gold-2: #f0c45a;
        --cal-white: #ffffff;
        --cal-soft: #f7f9fc;
        --cal-soft-2: #eef3f8;
        --cal-text: #142844;
        --cal-muted: #6c7788;
        --cal-border: rgba(6, 27, 54, 0.08);
        --cal-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --cal-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.15);
    }

    .calendar-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding-bottom: 90px;
    }

    .calendar-container {
        width: min(100% - 36px, 1320px);
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .calendar-hero {
        position: relative;
        overflow: hidden;
        isolation: isolate;
        min-height: 355px;
        background:
            radial-gradient(circle at 18% 22%, rgba(219, 165, 45, 0.12), transparent 28%),
            linear-gradient(135deg, #061b36 0%, #082447 48%, #061b36 100%);
        border-bottom: 4px solid var(--cal-gold);
    }

    .calendar-hero::before,
    .calendar-hero::after {
        content: "";
        position: absolute;
        pointer-events: none;
        opacity: 0.35;
    }

    .calendar-hero::before {
        inset: 0;
        background-image:
            linear-gradient(rgba(219, 165, 45, 0.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(219, 165, 45, 0.055) 1px, transparent 1px);
        background-size: 42px 42px;
        mask-image: radial-gradient(circle at 20% 30%, #000 0%, transparent 54%);
        -webkit-mask-image: radial-gradient(circle at 20% 30%, #000 0%, transparent 54%);
    }

    .calendar-hero::after {
        right: -40px;
        top: 34px;
        width: 410px;
        height: 240px;
        border: 2px solid rgba(219, 165, 45, 0.18);
        border-radius: 28px;
        transform: rotate(-8deg);
    }

    .calendar-hero-inner {
        min-height: 355px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #ffffff;
        padding: 64px 0 92px;
        position: relative;
        z-index: 2;
    }

    .calendar-emblem {
        width: 76px;
        height: 76px;
        margin: 0 auto 16px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--cal-gold-2);
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(219, 165, 45, 0.36);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.18);
    }

    .calendar-emblem svg {
        width: 44px;
        height: 44px;
    }

    .calendar-title-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 22px;
    }

    .calendar-title-row::before,
    .calendar-title-row::after {
        content: "";
        width: min(120px, 16vw);
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--cal-gold));
    }

    .calendar-title-row::after {
        background: linear-gradient(90deg, var(--cal-gold), transparent);
    }

    .calendar-title {
        margin: 0;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 70px);
        line-height: 1.08;
        font-weight: 700;
        letter-spacing: -1.4px;
        text-shadow: 0 14px 34px rgba(0, 0, 0, 0.30);
    }

    .calendar-subtitle {
        margin: 12px 0 0;
        color: var(--cal-gold-2);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(20px, 2vw, 30px);
        line-height: 1.35;
        font-weight: 600;
    }

    .stats-section {
        position: relative;
        margin-top: -82px;
        z-index: 5;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        max-width: 1040px;
        margin-inline: auto;
    }

    .stat-card {
        min-height: 170px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 28px 20px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 18px 42px rgba(6, 27, 54, 0.12);
        transition: 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 20px;
        width: 28px;
        height: 2px;
        border-radius: 999px;
        background: var(--cal-gold);
        transform: translateX(-50%);
    }

    .stat-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 28px 60px rgba(6, 27, 54, 0.17);
        border-color: rgba(219, 165, 45, 0.32);
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        color: #b98217;
        margin-bottom: 2px;
    }

    .stat-icon svg {
        width: 32px;
        height: 32px;
    }

    .stat-number {
        color: var(--cal-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 54px;
        line-height: 1;
        font-weight: 700;
        letter-spacing: -1px;
    }

    .stat-label {
        margin: 0;
        color: var(--cal-navy);
        font-size: 13px;
        line-height: 1.3;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
    }

    .events-section {
        position: relative;
        padding-top: 62px;
    }

    .events-heading {
        max-width: 760px;
        margin: 0 auto 30px;
        text-align: center;
    }

    .events-heading-icon {
        width: 52px;
        height: 24px;
        margin: 0 auto 8px;
        position: relative;
        color: var(--cal-gold);
        display: grid;
        place-items: center;
    }

    .events-heading-icon::before,
    .events-heading-icon::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 90px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--cal-gold));
    }

    .events-heading-icon::before {
        right: 100%;
    }

    .events-heading-icon::after {
        left: 100%;
        background: linear-gradient(90deg, var(--cal-gold), transparent);
    }

    .events-heading-icon svg {
        width: 25px;
        height: 25px;
    }

    .events-title {
        margin: 0;
        color: var(--cal-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(30px, 3vw, 42px);
        line-height: 1.12;
        font-weight: 700;
        letter-spacing: -0.6px;
    }

    .events-subtitle {
        margin: 10px 0 0;
        color: var(--cal-muted);
        font-size: 15.5px;
        line-height: 1.7;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .event-card {
        display: grid;
        grid-template-columns: 76px 1fr;
        gap: 18px;
        align-items: center;
        min-height: 96px;
        padding: 14px 18px;
        border-radius: 13px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.07);
        box-shadow: 0 14px 34px rgba(6, 27, 54, 0.08);
        transition: 0.24s ease;
        position: relative;
        overflow: hidden;
    }

    .event-card::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        background: linear-gradient(180deg, var(--cal-gold), var(--cal-gold-2));
        transform: scaleY(0);
        transform-origin: top;
        transition: 0.24s ease;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--cal-shadow-hover);
        border-color: rgba(219, 165, 45, 0.26);
    }

    .event-card:hover::before {
        transform: scaleY(1);
    }

    .date-badge {
        width: 66px;
        height: 66px;
        border-radius: 9px;
        display: grid;
        place-items: center;
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.85);
        box-shadow:
            0 10px 24px rgba(6, 27, 54, 0.22),
            inset 0 1px 0 rgba(255, 255, 255, 0.12);
        flex-shrink: 0;
    }

    .date-number {
        display: block;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 30px;
        line-height: 0.95;
        font-weight: 700;
        letter-spacing: -0.4px;
        text-align: center;
    }

    .date-month {
        display: block;
        margin-top: 5px;
        color: var(--cal-gold-2);
        font-size: 11px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        text-align: center;
    }

    .event-title {
        margin: 0 0 9px;
        color: var(--cal-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 17px;
        line-height: 1.25;
        font-weight: 700;
    }

    .event-date {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #607087;
        font-size: 13.5px;
        line-height: 1.4;
        font-weight: 600;
    }

    .event-date svg {
        width: 14px;
        height: 14px;
        color: #b98217;
        flex-shrink: 0;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 62px 24px;
        border-radius: 22px;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        box-shadow: var(--cal-shadow);
    }

    .empty-state svg {
        width: 66px;
        height: 66px;
        display: block;
        margin: 0 auto 16px;
        color: rgba(6, 27, 54, 0.25);
    }

    .empty-title {
        margin: 0 0 8px;
        color: var(--cal-navy);
        font-size: 24px;
        font-weight: 900;
    }

    .empty-text {
        margin: 0;
        color: var(--cal-muted);
        font-size: 15px;
        line-height: 1.7;
    }

    .scroll-top-btn {
        position: fixed;
        right: 26px;
        bottom: 26px;
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, var(--cal-navy-2), var(--cal-navy));
        border: 1px solid rgba(219, 165, 45, 0.76);
        box-shadow: 0 16px 34px rgba(6, 27, 54, 0.25);
        cursor: pointer;
        z-index: 60;
        transition: 0.24s ease;
    }

    .scroll-top-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 44px rgba(6, 27, 54, 0.32);
    }

    .scroll-top-btn svg {
        width: 22px;
        height: 22px;
        color: var(--cal-gold-2);
    }

    @media (max-width: 1180px) {
        .events-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .stats-grid {
            max-width: 900px;
        }
    }

    @media (max-width: 900px) {
        .calendar-hero,
        .calendar-hero-inner {
            min-height: 320px;
        }

        .calendar-hero-inner {
            padding: 52px 0 86px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .stat-card {
            min-height: 150px;
        }

        .stat-number {
            font-size: 46px;
        }
    }

    @media (max-width: 768px) {
        .calendar-container {
            width: min(100% - 22px, 1320px);
        }

        .calendar-title-row {
            gap: 12px;
        }

        .calendar-title-row::before,
        .calendar-title-row::after {
            width: 44px;
        }

        .calendar-title {
            font-size: clamp(36px, 11vw, 52px);
        }

        .calendar-subtitle {
            font-size: 19px;
        }

        .calendar-emblem {
            width: 66px;
            height: 66px;
        }

        .stats-section {
            margin-top: -70px;
        }

        .events-section {
            padding-top: 48px;
        }

        .events-heading-icon::before,
        .events-heading-icon::after {
            width: 54px;
        }

        .events-grid {
            grid-template-columns: 1fr;
        }

        .event-card {
            grid-template-columns: 72px 1fr;
            gap: 14px;
            padding: 13px 14px;
        }

        .scroll-top-btn {
            width: 48px;
            height: 48px;
            right: 18px;
            bottom: 18px;
        }
    }

    @media (max-width: 480px) {
        .calendar-hero,
        .calendar-hero-inner {
            min-height: 300px;
        }

        .calendar-hero-inner {
            padding: 46px 0 82px;
        }

        .stats-grid {
            gap: 12px;
        }

        .stat-card {
            min-height: 138px;
            padding: 22px 12px;
            border-radius: 14px;
        }

        .stat-icon svg {
            width: 27px;
            height: 27px;
        }

        .stat-number {
            font-size: 40px;
        }

        .stat-label {
            font-size: 10.5px;
            letter-spacing: 1.2px;
        }

        .event-card {
            grid-template-columns: 64px 1fr;
        }

        .date-badge {
            width: 60px;
            height: 60px;
        }

        .date-number {
            font-size: 26px;
        }

        .event-title {
            font-size: 15.5px;
        }

        .event-date {
            font-size: 12.5px;
        }
    }
</style>
@endpush

@section('content')
<section class="calendar-page">
    {{-- Hero Section --}}
    <div class="calendar-hero">
        <div class="calendar-container">
            <div class="calendar-hero-inner">
                <div>
                    <div class="calendar-emblem">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 3l2.35 4.76 5.25.76-3.8 3.71.9 5.23L12 15l-4.7 2.46.9-5.23-3.8-3.71 5.25-.76L12 3z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M7 21h10M9 18h6"></path>
                        </svg>
                    </div>

                    <div class="calendar-title-row">
                        <h1 class="calendar-title">Kalender Akademik</h1>
                    </div>

                    <p class="calendar-subtitle">
                        SMP Darul Mustofa - Tahun Ajaran 2025/2026
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="stats-section">
        <div class="calendar-container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $totalEvents }}</div>
                    <p class="stat-label">Total Kegiatan</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l6.16-3.42A12.08 12.08 0 0112 21.5a12.08 12.08 0 01-6.16-10.92L12 14z"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $examCount }}</div>
                    <p class="stat-label">Ujian Semester</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21V5a2 2 0 012-2h10l1 3h5v11h-6l-1-3H5v7H3z"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $nationalDayCount }}</div>
                    <p class="stat-label">Hari Nasional</p>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M7 18a5 5 0 0110 0M12 3v8m0 0l-4-4m4 4l4-4"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $holidayCount }}</div>
                    <p class="stat-label">Libur Semester</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Events Section --}}
    <div class="events-section">
        <div class="calendar-container">
            <div class="events-heading">
                <div class="events-heading-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 21h18M5 21V9l7-4 7 4v12M9 21v-6h6v6M9 10h.01M12 10h.01M15 10h.01"></path>
                    </svg>
                </div>

                <h2 class="events-title">Daftar Kegiatan</h2>
                <p class="events-subtitle">
                    Seluruh agenda dan kegiatan akademik yang telah dijadwalkan
                </p>
            </div>

            <div class="events-grid">
                @forelse ($events as $event)
                    <article class="event-card">
                        <div class="date-badge">
                            <div>
                                <span class="date-number">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                                </span>
                                <span class="date-month">
                                    {{ \Carbon\Carbon::parse($event->start_date)->locale('id')->isoFormat('MMM') }}
                                </span>
                            </div>
                        </div>

                        <div class="event-content">
                            <h3 class="event-title">{{ $event->title }}</h3>

                            <div class="event-date">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                                </svg>
                                <span>
                                    {{ \Carbon\Carbon::parse($event->start_date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zm4-6h6"></path>
                        </svg>

                        <h3 class="empty-title">Belum Ada Kegiatan</h3>
                        <p class="empty-text">
                            Belum ada kegiatan akademik yang dijadwalkan untuk saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <button type="button"
            class="scroll-top-btn"
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            aria-label="Kembali ke atas">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>
</section>
@endsection