@extends('layouts.frontend')

@section('title', 'Pengurus OSIS')

@push('styles')
<style>
    :root {
        --osis-navy: #061b36;
        --osis-navy-2: #0b2b52;
        --osis-gold: #dba52d;
        --osis-gold-2: #f0c45a;
        --osis-white: #ffffff;
        --osis-soft: #f7f9fc;
        --osis-soft-2: #eef3f8;
        --osis-text: #142844;
        --osis-muted: #6c7788;
        --osis-border: rgba(6, 27, 54, 0.08);
        --osis-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --osis-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .osis-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .osis-page::before,
    .osis-page::after {
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

    .osis-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .osis-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .osis-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .osis-header {
        max-width: 860px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .osis-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--osis-gold);
    }

    .osis-icon svg {
        width: 46px;
        height: 46px;
    }

    .osis-kicker {
        margin: 0 0 12px;
        color: var(--osis-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .osis-title {
        margin: 0;
        color: var(--osis-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .osis-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .osis-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--osis-gold), transparent);
    }

    .osis-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--osis-gold);
        border-radius: 2px;
    }

    .osis-subtitle {
        max-width: 760px;
        margin: 0 auto;
        color: var(--osis-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .osis-period {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        min-height: 54px;
        padding: 0 30px;
        margin: 36px auto 0;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.65);
        box-shadow: 0 18px 38px rgba(6, 27, 54, 0.20);
        font-size: 15px;
        font-weight: 900;
    }

    .osis-period svg {
        width: 20px;
        height: 20px;
        color: var(--osis-gold-2);
    }

    .osis-structure {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 28px;
        margin-top: 46px;
    }

    .osis-row {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 26px;
    }

    .osis-card {
        position: relative;
        width: min(100%, 310px);
        overflow: hidden;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--osis-border);
        box-shadow: var(--osis-shadow);
        transition: 0.28s ease;
    }

    .osis-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--osis-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .osis-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 96px;
        background:
            radial-gradient(circle at 20% 18%, rgba(219, 165, 45, 0.20), transparent 28%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
    }

    .osis-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--osis-gold), var(--osis-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .osis-card:hover::after {
        transform: scaleX(1);
    }

    .osis-card-inner {
        position: relative;
        z-index: 2;
        min-height: 315px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px 22px 26px;
        text-align: center;
    }

    .osis-photo-wrap {
        width: 138px;
        height: 138px;
        position: relative;
        margin-bottom: 22px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        background: #ffffff;
        border: 4px solid #ffffff;
        box-shadow:
            0 18px 36px rgba(6, 27, 54, 0.18),
            0 0 0 1px rgba(219, 165, 45, 0.20);
    }

    .osis-photo-wrap::after {
        content: "";
        position: absolute;
        right: 7px;
        bottom: 8px;
        width: 26px;
        height: 26px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--osis-gold-2), var(--osis-gold));
        border: 3px solid #ffffff;
        box-shadow: 0 8px 18px rgba(6, 27, 54, 0.18);
    }

    .osis-photo {
        width: 100%;
        height: 100%;
        display: block;
        border-radius: 999px;
        object-fit: cover;
        object-position: center top;
        background: var(--osis-soft-2);
    }

    .osis-avatar-fallback {
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
        font-size: 52px;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
    }

    .osis-position {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 38px;
        padding: 0 15px;
        margin-bottom: 14px;
        border-radius: 999px;
        color: var(--osis-navy);
        background: rgba(219, 165, 45, 0.11);
        border: 1px solid rgba(219, 165, 45, 0.24);
        font-size: 12px;
        line-height: 1.35;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.75px;
    }

    .osis-position svg {
        width: 15px;
        height: 15px;
        color: var(--osis-gold);
        flex-shrink: 0;
    }

    .osis-name {
        margin: 0;
        color: var(--osis-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 25px;
        line-height: 1.18;
        font-weight: 700;
        letter-spacing: -0.35px;
    }

    .osis-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--osis-gold);
        margin: 16px auto 0;
    }

    .osis-connector {
        position: relative;
        width: 2px;
        height: 40px;
        background: linear-gradient(180deg, transparent, rgba(219, 165, 45, 0.95), transparent);
    }

    .osis-connector::before,
    .osis-connector::after {
        content: "";
        position: absolute;
        left: 50%;
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--osis-gold);
        box-shadow: 0 0 0 5px rgba(219, 165, 45, 0.13);
        transform: translateX(-50%);
    }

    .osis-connector::before {
        top: 0;
    }

    .osis-connector::after {
        bottom: 0;
    }

    .osis-section-label {
        position: relative;
        overflow: hidden;
        min-height: 74px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        padding: 0 34px;
        border-radius: 20px;
        color: #ffffff;
        background:
            radial-gradient(circle at 18% 20%, rgba(219, 165, 45, 0.20), transparent 35%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.68);
        box-shadow: 0 20px 44px rgba(6, 27, 54, 0.20);
        font-size: 18px;
        line-height: 1.3;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
    }

    .osis-section-label svg {
        width: 25px;
        height: 25px;
        color: var(--osis-gold-2);
        flex-shrink: 0;
    }

    .osis-sekbid-grid {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        justify-items: center;
    }

    .osis-empty {
        max-width: 820px;
        margin: 46px auto 0;
        padding: 68px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--osis-shadow);
    }

    .osis-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--osis-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .osis-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .osis-empty-title {
        margin: 0 0 8px;
        color: var(--osis-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .osis-empty-text {
        margin: 0;
        color: var(--osis-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    @media (max-width: 1280px) {
        .osis-sekbid-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px) {
        .osis-sekbid-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .osis-card {
            width: min(100%, 300px);
        }
    }

    @media (max-width: 768px) {
        .osis-page {
            padding: 48px 0 70px;
        }

        .osis-container {
            width: min(100% - 22px, 1420px);
        }

        .osis-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .osis-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .osis-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .osis-period {
            width: 100%;
            min-height: 50px;
        }

        .osis-row {
            gap: 22px;
        }

        .osis-card {
            width: 100%;
        }

        .osis-sekbid-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .osis-section-label {
            width: 100%;
            padding: 0 22px;
            font-size: 15px;
            letter-spacing: 1.4px;
        }
    }

    @media (max-width: 480px) {
        .osis-page {
            padding-top: 38px;
        }

        .osis-card {
            border-radius: 22px;
        }

        .osis-card-inner {
            min-height: 292px;
            padding: 28px 18px 24px;
        }

        .osis-photo-wrap {
            width: 122px;
            height: 122px;
            margin-bottom: 20px;
        }

        .osis-avatar-fallback {
            font-size: 46px;
        }

        .osis-position {
            font-size: 11px;
            padding: 0 12px;
        }

        .osis-name {
            font-size: 22px;
        }
    }
</style>
@endpush

@php
    $leaderMembers = collect()
        ->merge($osisMembers->where('position', 'Ketua OSIS'))
        ->merge($osisMembers->where('position', 'Wakil Ketua OSIS'));

    $adminMembers = collect()
        ->merge($osisMembers->where('position', 'Sekretaris'))
        ->merge($osisMembers->where('position', 'Wakil Sekretaris'))
        ->merge($osisMembers->where('position', 'Bendahara'))
        ->merge($osisMembers->where('position', 'Wakil Bendahara'));

    $sekbidMembers = $osisMembers->filter(fn($m) => str_starts_with($m->position, 'Sekbid'));

    $renderOsisCard = function ($member) {
        $photoPath = $member->photo_path ?? null;
        $photoUrl = $photoPath ? asset('storage/' . $photoPath) : null;
        $initial = strtoupper(substr($member->name ?? 'O', 0, 1));
    };
@endphp

@section('content')
<section class="osis-page">
    <div class="osis-container">
        <div class="osis-header">
            <div class="osis-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l3 3 5-6"></path>
                </svg>
            </div>

            <p class="osis-kicker">Organisasi Siswa</p>

            <h1 class="osis-title">
                Struktur Kepengurusan OSIS
            </h1>

            <div class="osis-divider"></div>

            <p class="osis-subtitle">
                Pengurus OSIS SMP Darul Mustofa yang menjadi wadah kepemimpinan,
                kreativitas, tanggung jawab, dan kontribusi positif bagi lingkungan sekolah.
            </p>

            <div class="osis-period">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
                Masa Bakti 2025/2026
            </div>
        </div>

        @if($osisMembers->count() > 0)
            <div class="osis-structure">
                {{-- Ketua & Wakil --}}
                @if($leaderMembers->count() > 0)
                    <div class="osis-row">
                        @foreach($leaderMembers as $member)
                            <article class="osis-card">
                                <div class="osis-card-inner">
                                    <div class="osis-photo-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}"
                                                 alt="Foto {{ $member->name }}"
                                                 class="osis-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                            <div class="osis-avatar-fallback" style="display:none;">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="osis-avatar-fallback">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="osis-position">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m7-17H5v5a7 7 0 0014 0V4z"></path>
                                        </svg>
                                        {{ $member->position }}
                                    </div>

                                    <h2 class="osis-name">{{ $member->name }}</h2>
                                    <div class="osis-line"></div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="osis-connector"></div>
                @endif

                {{-- Sekretaris & Bendahara --}}
                @if($adminMembers->count() > 0)
                    <div class="osis-row">
                        @foreach($adminMembers as $member)
                            <article class="osis-card">
                                <div class="osis-card-inner">
                                    <div class="osis-photo-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}"
                                                 alt="Foto {{ $member->name }}"
                                                 class="osis-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                            <div class="osis-avatar-fallback" style="display:none;">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="osis-avatar-fallback">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="osis-position">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14H5V6a2 2 0 012-2z"></path>
                                        </svg>
                                        {{ $member->position }}
                                    </div>

                                    <h2 class="osis-name">{{ $member->name }}</h2>
                                    <div class="osis-line"></div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if($sekbidMembers->count() > 0)
                        <div class="osis-connector"></div>
                    @endif
                @endif

                {{-- Koordinator Seksi Bidang --}}
                @if($sekbidMembers->count() > 0)
                    <div class="osis-section-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Koordinator Seksi Bidang
                    </div>

                    <div class="osis-connector"></div>

                    <div class="osis-sekbid-grid">
                        @foreach($sekbidMembers as $member)
                            <article class="osis-card">
                                <div class="osis-card-inner">
                                    <div class="osis-photo-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}"
                                                 alt="Foto {{ $member->name }}"
                                                 class="osis-photo"
                                                 loading="lazy"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                            <div class="osis-avatar-fallback" style="display:none;">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="osis-avatar-fallback">
                                                {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="osis-position">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                                        </svg>
                                        {{ $member->position }}
                                    </div>

                                    <h2 class="osis-name">{{ $member->name }}</h2>
                                    <div class="osis-line"></div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="osis-empty">
                <div class="osis-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                    </svg>
                </div>

                <h3 class="osis-empty-title">Data OSIS Belum Tersedia</h3>

                <p class="osis-empty-text">
                    Data pengurus OSIS sedang dalam proses pembaruan. Silakan kembali lagi nanti
                    untuk melihat struktur organisasi terbaru.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection