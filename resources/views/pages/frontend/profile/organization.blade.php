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
        opacity: 0.38;
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

    .org-structure {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 26px;
        margin-top: 48px;
    }

    .org-level,
    .org-level-single {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
        gap: 26px;
    }

    .org-group {
        display: grid;
        gap: 20px;
    }

    .org-card {
        position: relative;
        width: min(100%, 310px);
        overflow: hidden;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--org-border);
        box-shadow: var(--org-shadow);
        transition: 0.28s ease;
    }

    .org-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--org-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .org-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 96px;
        background:
            radial-gradient(circle at 20% 18%, rgba(219, 165, 45, 0.20), transparent 28%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
    }

    .org-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--org-gold), var(--org-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .org-card:hover::after {
        transform: scaleX(1);
    }

    .org-card-inner {
        position: relative;
        z-index: 2;
        min-height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px 22px 26px;
        text-align: center;
    }

    .org-avatar-wrap {
        width: 132px;
        height: 132px;
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

    .org-avatar-wrap::after {
        content: "";
        position: absolute;
        right: 7px;
        bottom: 8px;
        width: 26px;
        height: 26px;
        border-radius: 999px;
        background: linear-gradient(180deg, var(--org-gold-2), var(--org-gold));
        border: 3px solid #ffffff;
        box-shadow: 0 8px 18px rgba(6, 27, 54, 0.18);
    }

    .org-avatar {
        width: 100%;
        height: 100%;
        display: block;
        border-radius: 999px;
        object-fit: cover;
        object-position: center top;
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
        font-size: 52px;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
    }

    .org-position {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 38px;
        padding: 0 15px;
        margin-bottom: 14px;
        border-radius: 999px;
        color: var(--org-navy);
        background: rgba(219, 165, 45, 0.11);
        border: 1px solid rgba(219, 165, 45, 0.24);
        font-size: 12px;
        line-height: 1.35;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.75px;
    }

    .org-position svg {
        width: 15px;
        height: 15px;
        color: var(--org-gold);
        flex-shrink: 0;
    }

    .org-name {
        margin: 0;
        color: var(--org-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 24px;
        line-height: 1.18;
        font-weight: 700;
        letter-spacing: -0.35px;
    }

    .org-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--org-gold);
        margin: 16px auto 0;
    }

    .org-connector {
        position: relative;
        width: 2px;
        height: 42px;
        background: linear-gradient(180deg, transparent, rgba(219, 165, 45, 0.95), transparent);
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

    .org-empty h3 {
        margin: 0 0 8px;
        color: var(--org-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .org-empty p {
        margin: 0;
        color: var(--org-muted);
        font-size: 16px;
        line-height: 1.7;
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

        .org-card {
            width: 100%;
        }

        .org-level,
        .org-level-single {
            gap: 22px;
        }
    }

    @media (max-width: 480px) {
        .org-page {
            padding-top: 38px;
        }

        .org-card {
            border-radius: 22px;
        }

        .org-card-inner {
            min-height: 282px;
            padding: 28px 18px 24px;
        }

        .org-avatar-wrap {
            width: 118px;
            height: 118px;
        }

        .org-avatar-fallback {
            font-size: 44px;
        }

        .org-position {
            font-size: 11px;
        }

        .org-name {
            font-size: 21px;
        }
    }
</style>
@endpush

@php
    $hasOrganization = collect($organization ?? [])->flatten(1)->count() > 0;

    $renderOrgCard = function ($member) {
        $photoPath = $member->photo_path ?? null;
        $name = $member->name ?? 'Nama';
        $position = $member->position ?? 'Jabatan';
        $initial = strtoupper(substr($name, 0, 1));
    };
@endphp

@section('content')
<section class="org-page">
    <div class="org-container">
        <div class="org-header">
            <div class="org-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"></path>
                </svg>
            </div>

            <p class="org-kicker">Tata Kelola Sekolah</p>

            <h1 class="org-title">Struktur Organisasi</h1>

            <div class="org-divider"></div>

            <p class="org-subtitle">
                Susunan kepemimpinan dan pengelola sekolah yang mendukung
                penyelenggaraan pendidikan SMP Darul Mustofa secara profesional.
            </p>
        </div>

        @if($hasOrganization)
            <div class="org-structure">
                {{-- Kepala Sekolah --}}
                @if(isset($organization['KEPALA SEKOLAH']))
                    <div class="org-level-single">
                        @foreach($organization['KEPALA SEKOLAH'] as $member)
                            <article class="org-card">
                                <div class="org-card-inner">
                                    <div class="org-avatar-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}"
                                                 alt="{{ $member->name }}"
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

                                    <div class="org-position">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m7-17H5v5a7 7 0 0014 0V4z"></path>
                                        </svg>
                                        {{ $member->position }}
                                    </div>

                                    <h2 class="org-name">{{ $member->name }}</h2>
                                    <div class="org-line"></div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="org-connector"></div>
                @endif

                {{-- Level Komite / TU / Wakil --}}
                <div class="org-level">
                    @if(isset($organization['KOMITE SEKOLAH']))
                        @foreach($organization['KOMITE SEKOLAH'] as $member)
                            <article class="org-card">
                                <div class="org-card-inner">
                                    <div class="org-avatar-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                            <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @else
                                            <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="org-position">{{ $member->position }}</div>
                                    <h2 class="org-name">{{ $member->name }}</h2>
                                    <div class="org-line"></div>
                                </div>
                            </article>
                        @endforeach
                    @endif

                    <div class="org-group">
                        @if(isset($organization['KEPALA TATA USAHA']))
                            @foreach($organization['KEPALA TATA USAHA'] as $member)
                                <article class="org-card">
                                    <div class="org-card-inner">
                                        <div class="org-avatar-wrap">
                                            @if($member->photo_path)
                                                <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                                <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @else
                                                <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @endif
                                        </div>
                                        <div class="org-position">{{ $member->position }}</div>
                                        <h2 class="org-name">{{ $member->name }}</h2>
                                        <div class="org-line"></div>
                                    </div>
                                </article>
                            @endforeach
                        @endif

                        @if(isset($organization['STAF TATA USAHA']))
                            @foreach($organization['STAF TATA USAHA'] as $member)
                                <article class="org-card">
                                    <div class="org-card-inner">
                                        <div class="org-avatar-wrap">
                                            @if($member->photo_path)
                                                <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                                <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @else
                                                <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @endif
                                        </div>
                                        <div class="org-position">{{ $member->position }}</div>
                                        <h2 class="org-name">{{ $member->name }}</h2>
                                        <div class="org-line"></div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    </div>

                    @if(isset($organization['WAKIL KEPALA SEKOLAH']))
                        @foreach($organization['WAKIL KEPALA SEKOLAH'] as $member)
                            <article class="org-card">
                                <div class="org-card-inner">
                                    <div class="org-avatar-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                            <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @else
                                            <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="org-position">{{ $member->position }}</div>
                                    <h2 class="org-name">{{ $member->name }}</h2>
                                    <div class="org-line"></div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>

                <div class="org-connector"></div>

                {{-- WAKA --}}
                <div class="org-level">
                    @foreach(['WAKA KURIKULUM', 'WAKA KESISWAAN', 'WAKA SARPRAS'] as $groupName)
                        @if(isset($organization[$groupName]))
                            @foreach($organization[$groupName] as $member)
                                <article class="org-card">
                                    <div class="org-card-inner">
                                        <div class="org-avatar-wrap">
                                            @if($member->photo_path)
                                                <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                                <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @else
                                                <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                            @endif
                                        </div>
                                        <div class="org-position">{{ $member->position }}</div>
                                        <h2 class="org-name">{{ $member->name }}</h2>
                                        <div class="org-line"></div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                @if(isset($organization['WAKA HUMAS']))
                    <div class="org-connector"></div>

                    <div class="org-level-single">
                        @foreach($organization['WAKA HUMAS'] as $member)
                            <article class="org-card">
                                <div class="org-card-inner">
                                    <div class="org-avatar-wrap">
                                        @if($member->photo_path)
                                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
                                            <div class="org-avatar-fallback" style="display:none;">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @else
                                            <div class="org-avatar-fallback">{{ strtoupper(substr($member->name ?? 'O', 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="org-position">{{ $member->position }}</div>
                                    <h2 class="org-name">{{ $member->name }}</h2>
                                    <div class="org-line"></div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="org-empty">
                <h3>Data Struktur Belum Tersedia</h3>
                <p>Data struktur organisasi sekolah sedang dalam proses pembaruan.</p>
            </div>
        @endif
    </div>
</section>
@endsection