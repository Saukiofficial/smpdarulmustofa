@extends('layouts.frontend')

@section('title', 'Dewan Guru')

@push('styles')
<style>
    :root {
        --teacher-navy: #061b36;
        --teacher-navy-2: #0b2b52;
        --teacher-gold: #dba52d;
        --teacher-gold-2: #f0c45a;
        --teacher-white: #ffffff;
        --teacher-soft: #f7f9fc;
        --teacher-soft-2: #eef3f8;
        --teacher-text: #142844;
        --teacher-muted: #6c7788;
        --teacher-border: rgba(6, 27, 54, 0.08);
        --teacher-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --teacher-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .teachers-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .teachers-page::before,
    .teachers-page::after {
        content: "";
        position: absolute;
        width: 520px;
        height: 520px;
        opacity: 0.38;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(6, 27, 54, 0.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(6, 27, 54, 0.055) 1px, transparent 1px);
        background-size: 34px 34px;
        mask-image: radial-gradient(circle, #000 0%, transparent 72%);
        -webkit-mask-image: radial-gradient(circle, #000 0%, transparent 72%);
    }

    .teachers-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .teachers-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .teachers-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .teachers-header {
        max-width: 860px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .teachers-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--teacher-gold);
    }

    .teachers-icon svg {
        width: 46px;
        height: 46px;
    }

    .teachers-kicker {
        margin: 0 0 12px;
        color: var(--teacher-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .teachers-title {
        margin: 0;
        color: var(--teacher-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .teachers-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .teachers-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--teacher-gold), transparent);
    }

    .teachers-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--teacher-gold);
        border-radius: 2px;
    }

    .teachers-subtitle {
        max-width: 780px;
        margin: 0 auto;
        color: var(--teacher-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .teachers-toolbar {
        display: flex;
        justify-content: center;
        margin: 38px auto 46px;
    }

    .teachers-pill {
        min-height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 0 28px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.65);
        box-shadow: 0 18px 38px rgba(6, 27, 54, 0.20);
        font-size: 15px;
        font-weight: 900;
    }

    .teachers-pill svg {
        width: 20px;
        height: 20px;
        color: var(--teacher-gold-2);
    }

    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 28px;
        align-items: stretch;
    }

    .teacher-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--teacher-border);
        box-shadow: var(--teacher-shadow);
        transition: 0.28s ease;
    }

    .teacher-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--teacher-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .teacher-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 112px;
        background:
            radial-gradient(circle at 20% 18%, rgba(219, 165, 45, 0.20), transparent 28%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
    }

    .teacher-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--teacher-gold), var(--teacher-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .teacher-card:hover::after {
        transform: scaleX(1);
    }

    .teacher-card-inner {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        padding: 38px 24px 28px;
        text-align: center;
    }

    .teacher-photo-wrap {
        width: 154px;
        height: 154px;
        position: relative;
        margin-bottom: 24px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        background: #ffffff;
        border: 4px solid #ffffff;
        box-shadow:
            0 18px 36px rgba(6, 27, 54, 0.18),
            0 0 0 1px rgba(219, 165, 45, 0.20);
    }

    .teacher-photo-wrap::after {
        content: "";
        position: absolute;
        right: 8px;
        bottom: 9px;
        width: 28px;
        height: 28px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--teacher-gold-2), var(--teacher-gold));
        border: 3px solid #ffffff;
        box-shadow: 0 8px 18px rgba(6, 27, 54, 0.18);
    }

    .teacher-photo {
        width: 100%;
        height: 100%;
        display: block;
        border-radius: 999px;
        object-fit: cover;
        object-position: center top;
        background: var(--teacher-soft-2);
    }

    .teacher-avatar-fallback {
        width: 100%;
        height: 100%;
        border-radius: 999px;
        display: grid;
        place-items: center;
        color: #ffffff;
        background:
            radial-gradient(circle at 30% 20%, rgba(219, 165, 45, 0.28), transparent 32%),
            linear-gradient(135deg, #0b2b52 0%, #061b36 100%);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 58px;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
    }

    .teacher-name {
        margin: 0 0 12px;
        color: var(--teacher-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 25px;
        line-height: 1.18;
        font-weight: 700;
        letter-spacing: -0.35px;
    }

    .teacher-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--teacher-gold);
        margin-bottom: 16px;
    }

    .teacher-subject {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 42px;
        padding: 0 16px;
        border-radius: 999px;
        color: var(--teacher-navy);
        background: rgba(219, 165, 45, 0.11);
        border: 1px solid rgba(219, 165, 45, 0.24);
        font-size: 13.5px;
        line-height: 1.35;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .teacher-subject svg {
        width: 16px;
        height: 16px;
        color: var(--teacher-gold);
        flex-shrink: 0;
    }

    .teacher-meta {
        margin-top: 18px;
        padding-top: 18px;
        width: 100%;
        border-top: 1px solid rgba(6, 27, 54, 0.07);
        color: var(--teacher-muted);
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    .teachers-empty {
        max-width: 820px;
        margin: 0 auto;
        padding: 68px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--teacher-shadow);
    }

    .teachers-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--teacher-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .teachers-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .teachers-empty-title {
        margin: 0 0 8px;
        color: var(--teacher-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .teachers-empty-text {
        margin: 0;
        color: var(--teacher-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    @media (max-width: 1280px) {
        .teachers-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .teacher-name {
            font-size: 23px;
        }
    }

    @media (max-width: 992px) {
        .teachers-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .teachers-page {
            padding: 48px 0 70px;
        }

        .teachers-container {
            width: min(100% - 22px, 1420px);
        }

        .teachers-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .teachers-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .teachers-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .teachers-toolbar {
            margin: 28px auto 34px;
        }

        .teachers-pill {
            width: 100%;
            min-height: 50px;
        }

        .teachers-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .teacher-card-inner {
            padding: 34px 22px 26px;
        }

        .teacher-photo-wrap {
            width: 142px;
            height: 142px;
        }
    }

    @media (max-width: 480px) {
        .teachers-page {
            padding-top: 38px;
        }

        .teacher-card {
            border-radius: 22px;
        }

        .teacher-card-inner {
            padding: 30px 18px 24px;
        }

        .teacher-photo-wrap {
            width: 124px;
            height: 124px;
            margin-bottom: 20px;
        }

        .teacher-avatar-fallback {
            font-size: 46px;
        }

        .teacher-name {
            font-size: 22px;
        }

        .teacher-subject {
            font-size: 12.5px;
            padding: 0 13px;
        }
    }
</style>
@endpush

@section('content')
<section class="teachers-page">
    <div class="teachers-container">
        <div class="teachers-header">
            <div class="teachers-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.42A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"></path>
                </svg>
            </div>

            <p class="teachers-kicker">Tenaga Pendidik</p>

            <h1 class="teachers-title">
                Dewan Guru
            </h1>

            <div class="teachers-divider"></div>

            <p class="teachers-subtitle">
                Para pendidik profesional dan berdedikasi yang membimbing siswa SMP Darul Mustofa
                dalam membangun iman, ilmu, akhlak, dan prestasi.
            </p>
        </div>

        <div class="teachers-toolbar">
            <div class="teachers-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                </svg>
                Profil Pendidik SMP Darul Mustofa
            </div>
        </div>

        @if($teachers->count() > 0)
            <div class="teachers-grid">
                @foreach ($teachers as $teacher)
                    <article class="teacher-card">
                        <div class="teacher-card-inner">
                            <div class="teacher-photo-wrap">
                                @if(optional($teacher->user)->profile_photo_path)
                                    <img src="{{ asset('storage/' . $teacher->user->profile_photo_path) }}"
                                         alt="Foto {{ optional($teacher->user)->name ?? 'Guru' }}"
                                         class="teacher-photo"
                                         loading="lazy"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                    <div class="teacher-avatar-fallback" style="display:none;">
                                        {{ strtoupper(substr(optional($teacher->user)->name ?? 'G', 0, 1)) }}
                                    </div>
                                @else
                                    <div class="teacher-avatar-fallback">
                                        {{ strtoupper(substr(optional($teacher->user)->name ?? 'G', 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <h2 class="teacher-name">
                                {{ optional($teacher->user)->name ?? 'Nama Guru' }}
                            </h2>

                            <div class="teacher-line"></div>

                            <div class="teacher-subject">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                {{ $teacher->mapel ?? 'Mata Pelajaran' }}
                            </div>

                            <div class="teacher-meta">
                                Pendidik SMP Darul Mustofa
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="teachers-empty">
                <div class="teachers-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>

                <h3 class="teachers-empty-title">Data Guru Belum Tersedia</h3>

                <p class="teachers-empty-text">
                    Data dewan guru sedang dalam proses pembaruan. Silakan kembali lagi nanti
                    untuk melihat informasi terbaru.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection