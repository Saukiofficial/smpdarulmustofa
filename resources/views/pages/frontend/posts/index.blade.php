@extends('layouts.frontend')

@section('title', 'Berita & Artikel')

@section('content')
<style>
    :root {
        --ba-navy: #061b36;
        --ba-navy-2: #0b2b52;
        --ba-gold: #dba52d;
        --ba-gold-2: #f0c45a;
        --ba-white: #ffffff;
        --ba-soft: #f7f9fc;
        --ba-soft-2: #eef3f8;
        --ba-text: #142844;
        --ba-muted: #6c7788;
        --ba-border: rgba(6, 27, 54, 0.08);
        --ba-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --ba-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .ba-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 18% 10%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .ba-page::before,
    .ba-page::after {
        content: "";
        position: absolute;
        width: 520px;
        height: 520px;
        opacity: 0.42;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(6, 27, 54, 0.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(6, 27, 54, 0.055) 1px, transparent 1px);
        background-size: 34px 34px;
        mask-image: radial-gradient(circle, #000 0%, transparent 72%);
        -webkit-mask-image: radial-gradient(circle, #000 0%, transparent 72%);
    }

    .ba-page::before {
        left: -180px;
        top: -110px;
        transform: rotate(16deg);
    }

    .ba-page::after {
        right: -180px;
        top: 16px;
        transform: rotate(-12deg);
    }

    .ba-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .ba-header {
        max-width: 820px;
        margin: 0 auto 44px;
        text-align: center;
    }

    .ba-icon {
        width: 46px;
        height: 46px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--ba-gold);
    }

    .ba-icon svg {
        width: 42px;
        height: 42px;
    }

    .ba-kicker {
        margin: 0 0 12px;
        color: var(--ba-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .ba-title {
        margin: 0;
        color: var(--ba-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .ba-divider {
        width: 108px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .ba-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--ba-gold), transparent);
    }

    .ba-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--ba-gold);
        border-radius: 2px;
    }

    .ba-subtitle {
        max-width: 760px;
        margin: 0 auto;
        color: var(--ba-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .ba-filter {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 18px;
        margin: 38px auto 46px;
    }

    .ba-filter-item {
        min-width: 150px;
        min-height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 0 26px;
        border-radius: 999px;
        color: var(--ba-navy);
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(6, 27, 54, 0.07);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.07);
        font-size: 15px;
        font-weight: 800;
        text-decoration: none;
        transition: 0.25s ease;
    }

    .ba-filter-item svg {
        width: 19px;
        height: 19px;
        flex-shrink: 0;
    }

    .ba-filter-item:hover,
    .ba-filter-item.active {
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border-color: rgba(219, 165, 45, 0.55);
        box-shadow: 0 18px 38px rgba(6, 27, 54, 0.20);
        transform: translateY(-3px);
    }

    .ba-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        align-items: stretch;
    }

    .ba-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 22px;
        background: #ffffff;
        border: 1px solid var(--ba-border);
        box-shadow: var(--ba-shadow);
        transition: 0.28s ease;
    }

    .ba-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--ba-shadow-hover);
        border-color: rgba(219, 165, 45, 0.28);
    }

    .ba-card.is-featured {
        border: 5px solid var(--ba-navy);
        box-shadow:
            0 26px 64px rgba(6, 27, 54, 0.18),
            0 0 0 2px rgba(219, 165, 45, 0.85);
        transform: translateY(-8px);
    }

    .ba-card.is-featured:hover {
        transform: translateY(-14px);
    }

    .ba-card-media {
        position: relative;
        padding: 16px 16px 0;
    }

    .ba-image-link {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 8.8;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 16px;
        background:
            linear-gradient(180deg, #fbfcff 0%, #edf2f7 100%);
        border: 1px solid rgba(6, 27, 54, 0.06);
        padding: 8px;
    }

    .ba-image-link img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        border-radius: 12px;
        transition: 0.35s ease;
    }

    .ba-card:hover .ba-image-link img {
        transform: scale(1.025);
    }

    .ba-category {
        position: absolute;
        top: 28px;
        left: 28px;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 17px;
        border-radius: 12px;
        color: #ffffff;
        background: linear-gradient(180deg, rgba(9, 40, 77, 0.96), rgba(6, 27, 54, 0.96));
        border: 1px solid rgba(219, 165, 45, 0.45);
        box-shadow: 0 12px 28px rgba(6, 27, 54, 0.20);
        font-size: 14px;
        font-weight: 800;
        backdrop-filter: blur(10px);
    }

    .ba-category svg {
        width: 17px;
        height: 17px;
        color: var(--ba-gold-2);
    }

    .ba-bookmark {
        position: absolute;
        top: 28px;
        right: 28px;
        z-index: 3;
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        color: var(--ba-navy);
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 12px 26px rgba(6, 27, 54, 0.12);
    }

    .ba-bookmark svg {
        width: 21px;
        height: 21px;
    }

    .ba-ribbon {
        position: absolute;
        top: -8px;
        right: 34px;
        z-index: 4;
        width: 66px;
        height: 96px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        padding-top: 16px;
        color: var(--ba-navy);
        background: linear-gradient(180deg, #e1b14a, #d09a24);
        font-size: 10px;
        font-weight: 900;
        text-align: center;
        line-height: 1.1;
        text-transform: uppercase;
        box-shadow: 0 12px 24px rgba(6, 27, 54, 0.18);
    }

    .ba-ribbon::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -18px;
        border-left: 33px solid #d09a24;
        border-right: 33px solid #d09a24;
        border-bottom: 18px solid transparent;
    }

    .ba-ribbon svg {
        width: 20px;
        height: 20px;
    }

    .ba-card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 22px 26px 26px;
    }

    .ba-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--ba-muted);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .ba-date svg {
        width: 17px;
        height: 17px;
        color: var(--ba-muted);
        flex-shrink: 0;
    }

    .ba-card-title {
        margin: 0 0 14px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(24px, 1.65vw, 32px);
        line-height: 1.13;
        font-weight: 700;
        letter-spacing: -0.4px;
    }

    .ba-card-title a {
        color: var(--ba-navy);
        text-decoration: none;
        transition: 0.22s ease;
    }

    .ba-card:hover .ba-card-title a {
        color: #b98217;
    }

    .ba-mini-line {
        width: 52px;
        height: 2px;
        border-radius: 999px;
        background: var(--ba-gold);
        margin-bottom: 16px;
    }

    .ba-excerpt {
        flex: 1;
        margin: 0 0 24px;
        color: var(--ba-muted);
        font-size: 15.5px;
        line-height: 1.8;
    }

    .ba-readmore {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: var(--ba-navy);
        font-size: 15px;
        font-weight: 900;
        text-decoration: none;
        transition: 0.22s ease;
    }

    .ba-readmore svg {
        width: 17px;
        height: 17px;
        color: var(--ba-gold);
        transition: 0.22s ease;
    }

    .ba-readmore:hover {
        color: var(--ba-gold);
    }

    .ba-readmore:hover svg {
        transform: translateX(4px);
    }

    .ba-bottom-action {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .ba-all-btn {
        min-width: 310px;
        min-height: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        padding: 0 34px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.82);
        box-shadow:
            0 18px 38px rgba(6, 27, 54, 0.22),
            0 0 0 2px rgba(219, 165, 45, 0.16);
        font-size: 17px;
        font-weight: 900;
        text-decoration: none;
        transition: 0.28s ease;
    }

    .ba-all-btn svg {
        width: 23px;
        height: 23px;
        color: var(--ba-gold-2);
    }

    .ba-all-btn:hover {
        color: #ffffff;
        transform: translateY(-4px);
        box-shadow:
            0 24px 50px rgba(6, 27, 54, 0.30),
            0 0 0 2px rgba(219, 165, 45, 0.22);
    }

    .ba-pagination {
        display: flex;
        justify-content: center;
        margin-top: 42px;
    }

    .ba-pagination > div {
        background: #ffffff;
        border-radius: 18px;
        padding: 14px 16px;
        border: 1px solid var(--ba-border);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.08);
    }

    .ba-empty {
        max-width: 820px;
        margin: 0 auto;
        padding: 64px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--ba-shadow);
    }

    .ba-empty svg {
        width: 68px;
        height: 68px;
        display: block;
        margin: 0 auto 18px;
        color: rgba(6, 27, 54, 0.25);
    }

    .ba-empty h3 {
        margin: 0 0 8px;
        color: var(--ba-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .ba-empty p {
        margin: 0;
        color: var(--ba-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    @media (max-width: 1280px) {
        .ba-grid {
            gap: 22px;
        }

        .ba-card-title {
            font-size: 25px;
        }

        .ba-image-link {
            min-height: 205px;
        }
    }

    @media (max-width: 1100px) {
        .ba-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ba-card.is-featured {
            transform: none;
        }

        .ba-card.is-featured:hover {
            transform: translateY(-8px);
        }
    }

    @media (max-width: 768px) {
        .ba-page {
            padding: 48px 0 70px;
        }

        .ba-container {
            width: min(100% - 22px, 1420px);
        }

        .ba-header {
            margin-bottom: 30px;
        }

        .ba-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .ba-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .ba-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .ba-filter {
            gap: 10px;
            margin: 26px auto 32px;
        }

        .ba-filter-item {
            min-width: auto;
            min-height: 46px;
            padding: 0 16px;
            font-size: 13.5px;
        }

        .ba-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .ba-card.is-featured {
            border-width: 3px;
        }

        .ba-image-link {
            min-height: 210px;
        }

        .ba-card-body {
            padding: 20px 20px 22px;
        }

        .ba-card-title {
            font-size: 27px;
        }

        .ba-all-btn {
            width: 100%;
            min-width: 0;
        }
    }

    @media (max-width: 480px) {
        .ba-page {
            padding-top: 38px;
        }

        .ba-filter {
            justify-content: flex-start;
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 8px;
        }

        .ba-filter-item {
            flex: 0 0 auto;
        }

        .ba-card-media {
            padding: 12px 12px 0;
        }

        .ba-category {
            top: 22px;
            left: 22px;
            padding: 9px 13px;
            font-size: 12px;
        }

        .ba-bookmark {
            top: 22px;
            right: 22px;
            width: 42px;
            height: 42px;
        }

        .ba-ribbon {
            right: 24px;
            width: 58px;
            height: 86px;
            font-size: 9px;
        }

        .ba-ribbon::after {
            border-left-width: 29px;
            border-right-width: 29px;
        }

        .ba-image-link {
            min-height: 190px;
        }

        .ba-card-title {
            font-size: 24px;
        }
    }
</style>

<section class="ba-page">
    <div class="ba-container">
        <div class="ba-header">
            <div class="ba-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l2.2 4.46 4.93.72-3.57 3.48.84 4.91L12 14.25l-4.4 2.32.84-4.91-3.57-3.48 4.93-.72L12 3z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 21h14M8 18h8"></path>
                </svg>
            </div>

            <p class="ba-kicker">Informasi Terkini</p>

            <h1 class="ba-title">
                Berita & Artikel
            </h1>

            <div class="ba-divider"></div>

            <p class="ba-subtitle">
                Dapatkan informasi terbaru seputar kegiatan sekolah, prestasi siswa,
                pengumuman akademik, dan program unggulan SMP Darul Mustofa.
            </p>
        </div>

        <div class="ba-filter" aria-label="Kategori Berita">
            <a href="{{ route('posts.index') }}" class="ba-filter-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h7v7H4V4zm9 0h7v7h-7V4zM4 13h7v7H4v-7zm9 0h7v7h-7v-7z"></path>
                </svg>
                Semua
            </a>

            <a href="{{ route('posts.index') }}" class="ba-filter-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.42A12.08 12.08 0 0112 21.5a12.08 12.08 0 01-6.16-10.92L12 14z"></path>
                </svg>
                Akademik
            </a>

            <a href="{{ route('posts.index') }}" class="ba-filter-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m7-17H5v5a7 7 0 0014 0V4z"></path>
                </svg>
                Prestasi
            </a>

            <a href="{{ route('posts.index') }}" class="ba-filter-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                </svg>
                Kegiatan
            </a>

            <a href="{{ route('posts.index') }}" class="ba-filter-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5L6 9H3v6h3l5 4V5zm8 3a5 5 0 010 8m2-11a9 9 0 010 14"></path>
                </svg>
                Pengumuman
            </a>
        </div>

        @if($posts->count() > 0)
            <div class="ba-grid">
                @foreach ($posts as $post)
                    @php
                        $titleLower = strtolower($post->title ?? '');
                        $contentLower = strtolower(strip_tags($post->content ?? ''));

                        if (str_contains($titleLower, 'tka') || str_contains($titleLower, 'juara') || str_contains($titleLower, 'prestasi') || str_contains($contentLower, 'prestasi')) {
                            $categoryLabel = 'Prestasi';
                            $categoryIcon = 'trophy';
                        } elseif (str_contains($titleLower, 'asat') || str_contains($titleLower, 'ujian') || str_contains($titleLower, 'akademik') || str_contains($contentLower, 'akademik')) {
                            $categoryLabel = 'Akademik';
                            $categoryIcon = 'academic';
                        } elseif (str_contains($titleLower, 'qurban') || str_contains($titleLower, 'idul') || str_contains($titleLower, 'kegiatan') || str_contains($contentLower, 'kegiatan')) {
                            $categoryLabel = 'Kegiatan';
                            $categoryIcon = 'users';
                        } else {
                            $categoryLabel = 'Pengumuman';
                            $categoryIcon = 'megaphone';
                        }

                        $isFeatured = $loop->iteration === 2;
                    @endphp

                    <article class="ba-card {{ $isFeatured ? 'is-featured' : '' }}">
                        <div class="ba-card-media">
                            <a href="{{ route('posts.show', $post->slug) }}" class="ba-image-link">
                                <img
                                    src="{{ $post->featured_image_path ? asset('storage/' . $post->featured_image_path) : 'https://placehold.co/900x520/f3f6fa/061b36?text=SMP+Darul+Mustofa' }}"
                                    alt="{{ $post->title }}"
                                    loading="lazy">
                            </a>

                            <div class="ba-category">
                                @if($categoryIcon === 'trophy')
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4m7-17H5v5a7 7 0 0014 0V4z"></path>
                                    </svg>
                                @elseif($categoryIcon === 'academic')
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.42A12.08 12.08 0 0112 21.5a12.08 12.08 0 01-6.16-10.92L12 14z"></path>
                                    </svg>
                                @elseif($categoryIcon === 'users')
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z"></path>
                                    </svg>
                                @else
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5L6 9H3v6h3l5 4V5zm8 3a5 5 0 010 8m2-11a9 9 0 010 14"></path>
                                    </svg>
                                @endif

                                {{ $categoryLabel }}
                            </div>

                            @if($isFeatured)
                                <div class="ba-ribbon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.158c.969 0 1.371 1.24.588 1.81l-3.364 2.444a1 1 0 00-.364 1.118l1.285 3.955c.3.922-.755 1.688-1.539 1.118L12 15.56l-3.364 2.457c-.784.57-1.838-.196-1.539-1.118l1.285-3.955a1 1 0 00-.364-1.118L4.654 9.382c-.783-.57-.38-1.81.588-1.81H9.4a1 1 0 00.95-.69l1.286-3.955z"></path>
                                    </svg>
                                    Berita<br>Utama
                                </div>
                            @else
                                <div class="ba-bookmark">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="ba-card-body">
                            <div class="ba-date">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>

                            <h2 class="ba-card-title">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <div class="ba-mini-line"></div>

                            <p class="ba-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 132) }}
                            </p>

                            <a href="{{ route('posts.show', $post->slug) }}" class="ba-readmore">
                                Baca Selengkapnya
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="ba-pagination">
                    <div>
                        {{ $posts->links() }}
                    </div>
                </div>
            @else
                <div class="ba-bottom-action">
                    <a href="{{ route('posts.index') }}" class="ba-all-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Lihat Semua Artikel
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <div class="ba-empty">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                </svg>
                <h3>Belum Ada Berita</h3>
                <p>Berita dan artikel terbaru SMP Darul Mustofa akan segera ditampilkan di halaman ini.</p>
            </div>
        @endif
    </div>
</section>
@endsection