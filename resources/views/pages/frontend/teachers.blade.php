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
        opacity: 0.34;
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

    /* CARD 3 BAGIAN: MAPEL - FOTO - NAMA */
    .teacher-card {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 12px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.76);
        border: 1px solid rgba(6, 27, 54, 0.07);
        box-shadow: var(--teacher-shadow);
        transition: 0.28s ease;
    }

    .teacher-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--teacher-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .teacher-title-card {
        min-height: 72px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background:
            radial-gradient(circle at 20% 18%, rgba(219, 165, 45, 0.20), transparent 28%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.34);
        text-align: center;
        overflow: hidden;
    }

    .teacher-subject {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #ffffff;
        font-size: 12px;
        line-height: 1.35;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        text-align: center;
    }

    .teacher-subject svg {
        width: 15px;
        height: 15px;
        color: var(--teacher-gold-2);
        flex-shrink: 0;
    }

    .teacher-photo-card {
        width: 100%;
        height: 190px;
        min-height: 190px;
        max-height: 190px;
        padding: 16px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.95);
    }

    .teacher-photo-wrap {
        width: 132px;
        height: 132px;
        min-width: 132px;
        min-height: 132px;
        max-width: 132px;
        max-height: 132px;
        position: relative;
        overflow: hidden;
        border-radius: 999px;
        display: block;
        background: #ffffff;
        border: 4px solid #ffffff;
        box-shadow:
            0 14px 28px rgba(6, 27, 54, 0.16),
            0 0 0 1px rgba(219, 165, 45, 0.22);
        flex: 0 0 132px;
    }

    .teacher-photo-wrap::after {
        content: "";
        position: absolute;
        right: 7px;
        bottom: 8px;
        z-index: 5;
        width: 22px;
        height: 22px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--teacher-gold-2), var(--teacher-gold));
        border: 3px solid #ffffff;
        box-shadow: 0 8px 18px rgba(6, 27, 54, 0.18);
    }

    .teacher-photo {
        width: 100%;
        height: 100%;
        max-width: 100%;
        max-height: 100%;
        display: block;
        object-fit: cover;
        object-position: center top;
        border-radius: 999px;
        margin: 0;
        padding: 0;
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
        font-size: 50px;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
    }

    .teacher-name-card {
        min-height: 124px;
        padding: 18px 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        text-align: center;
    }

    .teacher-name {
        margin: 0;
        color: var(--teacher-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 23px;
        line-height: 1.18;
        font-weight: 700;
        letter-spacing: -0.35px;
        position: static;
        z-index: auto;
    }

    .teacher-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--teacher-gold);
        margin: 14px auto 0;
    }

    .teacher-meta {
        margin: 12px 0 0;
        color: var(--teacher-muted);
        font-size: 13px;
        line-height: 1.5;
        font-weight: 700;
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
    }

    @media (max-width: 480px) {
        .teachers-page {
            padding-top: 38px;
        }

        .teacher-card {
            border-radius: 22px;
            padding: 10px;
        }

        .teacher-title-card {
            min-height: 66px;
            border-radius: 18px;
        }

        .teacher-photo-card {
            height: 170px;
            min-height: 170px;
            max-height: 170px;
            padding: 14px;
        }

        .teacher-photo-wrap {
            width: 116px;
            height: 116px;
            min-width: 116px;
            min-height: 116px;
            max-width: 116px;
            max-height: 116px;
            flex-basis: 116px;
        }

        .teacher-photo-wrap::after {
            width: 20px;
            height: 20px;
            right: 6px;
            bottom: 7px;
        }

        .teacher-avatar-fallback {
            font-size: 44px;
        }

        .teacher-subject {
            font-size: 11px;
        }

        .teacher-name-card {
            min-height: 104px;
            padding: 16px 14px;
        }

        .teacher-name {
            font-size: 22px;
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

            <h1 class="teachers-title">Dewan Guru</h1>

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
                        <div class="teacher-title-card">
                            <div class="teacher-subject">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"></path>
                                </svg>
                                {{ $teacher->mapel ?? 'Mata Pelajaran' }}
                            </div>
                        </div>

                        <div class="teacher-photo-card">
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
                        </div>

                        <div class="teacher-name-card">
                            <h2 class="teacher-name">
                                {{ optional($teacher->user)->name ?? 'Nama Guru' }}
                            </h2>

                            <div class="teacher-line"></div>

                            <p class="teacher-meta">
                                Pendidik SMP Darul Mustofa
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="teachers-empty">
                <div class="teachers-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"></path>
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