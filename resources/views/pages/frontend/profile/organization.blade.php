@extends('layouts.frontend')

@section('title', 'Struktur Organisasi')

@push('styles')
<style>
    :root {
        --org-navy: #061b36;
        --org-navy-2: #0b2b52;
        --org-gold: #dba52d;
        --org-gold-2: #f0c45a;
        --org-white: #ffffff;
        --org-soft: #f7f9fc;
        --org-soft-2: #eef3f8;
        --org-text: #142844;
        --org-muted: #6c7788;
        --org-border: rgba(6, 27, 54, 0.08);
        --org-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --org-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .org-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .org-page::before,
    .org-page::after {
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

    .org-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .org-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .org-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .org-header {
        max-width: 880px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .org-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--org-gold);
    }

    .org-icon svg {
        width: 46px;
        height: 46px;
    }

    .org-kicker {
        margin: 0 0 12px;
        color: var(--org-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .org-title {
        margin: 0;
        color: var(--org-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .org-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .org-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--org-gold), transparent);
    }

    .org-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--org-gold);
        border-radius: 2px;
    }

    .org-subtitle {
        max-width: 780px;
        margin: 0 auto;
        color: var(--org-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .org-summary-pill {
        width: fit-content;
        min-height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
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

    .org-summary-pill svg {
        width: 20px;
        height: 20px;
        color: var(--org-gold-2);
        flex-shrink: 0;
    }

    .org-chart-wrap {
        margin-top: 46px;
        padding: 42px 34px;
        border-radius: 34px;
        background: rgba(255, 255, 255, 0.76);
        border: 1px solid rgba(255, 255, 255, 0.86);
        box-shadow: 0 24px 70px rgba(6, 27, 54, 0.08);
        backdrop-filter: blur(14px);
    }

    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .org-level {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 28px;
    }

    .org-level.leader {
        max-width: 340px;
    }

    .org-level.small {
        max-width: 1060px;
    }

    .org-level.waka {
        max-width: 1120px;
    }

    .org-connector {
        width: 2px;
        height: 42px;
        background: linear-gradient(180deg, transparent, rgba(219, 165, 45, 0.95), transparent);
        position: relative;
        margin: 4px 0;
    }

    .org-connector::before,
    .org-connector::after {
        content: "";
        position: absolute;
        left: 50%;
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--org-gold);
        box-shadow: 0 0 0 5px rgba(219, 165, 45, 0.13);
        transform: translateX(-50%);
    }

    .org-connector::before {
        top: 0;
    }

    .org-connector::after {
        bottom: 0;
    }

    .org-level-title {
        margin: 4px 0 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        min-height: 52px;
        padding: 0 28px;
        border-radius: 999px;
        color: #ffffff;
        background:
            radial-gradient(circle at 18% 20%, rgba(219, 165, 45, 0.20), transparent 35%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.68);
        box-shadow: 0 18px 38px rgba(6, 27, 54, 0.18);
        font-size: 14px;
        line-height: 1.3;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        text-align: center;
    }

    .org-level-title svg {
        width: 19px;
        height: 19px;
        color: var(--org-gold-2);
        flex-shrink: 0;
    }

    .org-card {
        width: min(100%, 285px);
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 12px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.76);
        border: 1px solid rgba(6, 27, 54, 0.07);
        box-shadow: var(--org-shadow);
        transition: 0.28s ease;
        flex: 0 0 285px;
    }

    .org-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--org-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .org-title-card {
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

    .org-position {
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

    .org-position svg {
        width: 15px;
        height: 15px;
        color: var(--org-gold-2);
        flex-shrink: 0;
    }

    .org-photo-card {
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

    .org-avatar-wrap {
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

    .org-avatar-wrap::after {
        content: "";
        position: absolute;
        right: 7px;
        bottom: 8px;
        z-index: 5;
        width: 22px;
        height: 22px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--org-gold-2), var(--org-gold));
        border: 3px solid #ffffff;
        box-shadow: 0 8px 18px rgba(6, 27, 54, 0.18);
    }

    .org-avatar {
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
        background: var(--org-soft-2);
    }

    .org-avatar-fallback {
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

    .org-name-card {
        min-height: 104px;
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

    .org-name {
        margin: 0;
        color: var(--org-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 23px;
        line-height: 1.18;
        font-weight: 700;
        letter-spacing: -0.35px;
        position: static;
        z-index: auto;
    }

    .org-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--org-gold);
        margin: 14px auto 0;
    }

    .org-empty {
        max-width: 820px;
        margin: 46px auto 0;
        padding: 68px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--org-shadow);
    }

    .org-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--org-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .org-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .org-empty-title {
        margin: 0 0 8px;
        color: var(--org-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .org-empty-text {
        margin: 0;
        color: var(--org-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    @media (max-width: 1180px) {
        .org-level.waka,
        .org-level.small {
            max-width: 920px;
        }

        .org-card {
            width: min(100%, 275px);
            flex-basis: 275px;
        }
    }

    @media (max-width: 768px) {
        .org-page {
            padding: 48px 0 70px;
        }

        .org-container {
            width: min(100% - 22px, 1420px);
        }

        .org-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .org-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .org-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .org-summary-pill {
            width: 100%;
            min-height: 50px;
        }

        .org-chart-wrap {
            padding: 28px 18px;
            border-radius: 26px;
        }

        .org-level {
            flex-direction: column;
            align-items: center;
            gap: 22px;
        }

        .org-card {
            width: 100%;
            max-width: 340px;
            flex-basis: auto;
        }

        .org-level-title {
            width: 100%;
            font-size: 12px;
            letter-spacing: 1px;
            padding: 0 16px;
        }
    }

    @media (max-width: 480px) {
        .org-page {
            padding-top: 38px;
        }

        .org-card {
            border-radius: 22px;
            padding: 10px;
        }

        .org-title-card {
            min-height: 66px;
            border-radius: 18px;
        }

        .org-photo-card {
            height: 170px;
            min-height: 170px;
            max-height: 170px;
            padding: 14px;
        }

        .org-avatar-wrap {
            width: 116px;
            height: 116px;
            min-width: 116px;
            min-height: 116px;
            max-width: 116px;
            max-height: 116px;
            flex-basis: 116px;
        }

        .org-avatar-wrap::after {
            width: 20px;
            height: 20px;
            right: 6px;
            bottom: 7px;
        }

        .org-avatar-fallback {
            font-size: 44px;
        }

        .org-position {
            font-size: 11px;
        }

        .org-name-card {
            min-height: 92px;
            padding: 16px 14px;
        }

        .org-name {
            font-size: 22px;
        }
    }
</style>
@endpush

@php
    $organizationCollection = collect($organization ?? []);
    $totalMembers = $organizationCollection->flatten(1)->count();

    $leaderGroups = ['KEPALA SEKOLAH'];

    $secondGroups = [
        'WAKIL KEPALA SEKOLAH',
        'KOMITE SEKOLAH',
        'KEPALA TATA USAHA',
        'STAF TATA USAHA',
    ];

    $wakaGroups = [
        'WAKA KURIKULUM',
        'WAKA KESISWAAN',
        'WAKA SARPRAS',
        'WAKA HUMAS',
    ];

    $usedGroups = collect($leaderGroups)
        ->merge($secondGroups)
        ->merge($wakaGroups)
        ->map(fn ($group) => strtoupper($group))
        ->toArray();

    $otherGroups = $organizationCollection->keys()
        ->filter(fn ($group) => !in_array(strtoupper($group), $usedGroups))
        ->values();

    $levels = collect();

    $levels->push([
        'label' => 'KEPALA SEKOLAH',
        'class' => 'leader',
        'groups' => $leaderGroups,
        'icon' => 'trophy',
    ]);

    $levels->push([
        'label' => 'UNSUR PIMPINAN & ADMINISTRASI',
        'class' => 'small',
        'groups' => $secondGroups,
        'icon' => 'users',
    ]);

    $levels->push([
        'label' => 'WAKIL KEPALA BIDANG',
        'class' => 'waka',
        'groups' => $wakaGroups,
        'icon' => 'document',
    ]);

    foreach ($otherGroups as $otherGroup) {
        $levels->push([
            'label' => $otherGroup,
            'class' => 'small',
            'groups' => [$otherGroup],
            'icon' => 'list',
        ]);
    }
@endphp

@section('content')
<section class="org-page">
    <div class="org-container">
        <div class="org-header">
            <div class="org-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1"></path>
                </svg>
            </div>

            <p class="org-kicker">Tata Kelola Sekolah</p>

            <h1 class="org-title">Struktur Organisasi</h1>

            <div class="org-divider"></div>

            <p class="org-subtitle">
                Susunan kepemimpinan dan pengelola sekolah yang mendukung penyelenggaraan
                pendidikan SMP Darul Mustofa secara profesional, tertib, dan berkelanjutan.
            </p>

            <div class="org-summary-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                </svg>
                Struktur Pengelola SMP Darul Mustofa
            </div>
        </div>

        @if($totalMembers > 0)
            <div class="org-chart-wrap">
                <div class="org-chart">
                    @foreach($levels as $level)
                        @php
                            $levelMembers = collect();

                            foreach ($level['groups'] as $groupName) {
                                if (isset($organization[$groupName])) {
                                    foreach (collect($organization[$groupName]) as $member) {
                                        $member->fallback_group_name = $groupName;
                                        $levelMembers->push($member);
                                    }
                                }
                            }
                        @endphp

                        @if($levelMembers->count() > 0)
                            @if(!$loop->first)
                                <div class="org-connector"></div>
                            @endif

                            <div class="org-level-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($level['icon'] === 'trophy')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m7-17H5v5a7 7 0 0014 0V4z"></path>
                                    @elseif($level['icon'] === 'users')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                                    @elseif($level['icon'] === 'document')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14H5V6a2 2 0 012-2z"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    @endif
                                </svg>
                                {{ $level['label'] }}
                            </div>

                            <div class="org-level {{ $level['class'] }}">
                                @foreach($levelMembers as $member)
                                    <article class="org-card">
                                        <div class="org-title-card">
                                            <div class="org-position">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $member->position ?? $member->fallback_group_name ?? 'Jabatan' }}
                                            </div>
                                        </div>

                                        <div class="org-photo-card">
                                            <div class="org-avatar-wrap">
                                                @if($member->photo_path)
                                                    <img src="{{ asset('storage/' . $member->photo_path) }}"
                                                         alt="Foto {{ $member->name }}"
                                                         class="org-avatar"
                                                         loading="lazy"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                                    <div class="org-avatar-fallback" style="display:none;">
                                                        {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                                    </div>
                                                @else
                                                    <div class="org-avatar-fallback">
                                                        {{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="org-name-card">
                                            <h2 class="org-name">
                                                {{ $member->name ?? 'Nama Pengurus' }}
                                            </h2>
                                            <div class="org-line"></div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <div class="org-empty">
                <div class="org-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"></path>
                    </svg>
                </div>

                <h3 class="org-empty-title">Data Struktur Belum Tersedia</h3>

                <p class="org-empty-text">
                    Data struktur organisasi sekolah sedang dalam proses pembaruan.
                    Silakan kembali lagi nanti untuk melihat informasi terbaru.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection