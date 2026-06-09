@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<style>
    :root {
        --post-navy: #061b36;
        --post-navy-2: #0b2b52;
        --post-gold: #dba52d;
        --post-gold-2: #f0c45a;
        --post-white: #ffffff;
        --post-soft: #f7f9fc;
        --post-soft-2: #eef3f8;
        --post-text: #142844;
        --post-muted: #6c7788;
        --post-border: rgba(6, 27, 54, 0.08);
        --post-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --post-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.15);
    }

    .post-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 10%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 58px 0 88px;
    }

    .post-page::before,
    .post-page::after {
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

    .post-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .post-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .post-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1360px);
        margin-inline: auto;
    }

    .post-back {
        margin-bottom: 26px;
    }

    .post-back-link {
        width: fit-content;
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 0 18px;
        border-radius: 999px;
        background: #ffffff;
        color: var(--post-navy);
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.07);
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        transition: 0.24s ease;
    }

    .post-back-link svg {
        width: 17px;
        height: 17px;
        color: var(--post-gold);
        transition: 0.24s ease;
    }

    .post-back-link:hover {
        color: #ffffff;
        background: linear-gradient(180deg, var(--post-navy-2) 0%, var(--post-navy) 100%);
        border-color: rgba(219, 165, 45, 0.45);
        transform: translateY(-2px);
    }

    .post-back-link:hover svg {
        transform: translateX(-3px);
    }

    .post-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.75fr) minmax(320px, 0.85fr);
        gap: 30px;
        align-items: start;
    }

    .post-main {
        overflow: hidden;
        border-radius: 30px;
        background: #ffffff;
        border: 1px solid var(--post-border);
        box-shadow: var(--post-shadow);
    }

    .post-header {
        position: relative;
        overflow: hidden;
        padding: 46px 44px 38px;
        background:
            linear-gradient(135deg, rgba(6, 27, 54, 0.97), rgba(11, 43, 82, 0.93)),
            url('{{ asset('images/gedung-sekolah.jpg') }}') center / cover no-repeat;
        isolation: isolate;
    }

    .post-header::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 16% 16%, rgba(219, 165, 45, 0.24), transparent 28%),
            radial-gradient(circle at 90% 78%, rgba(255, 255, 255, 0.11), transparent 22%);
        z-index: -1;
    }

    .post-header::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--post-gold), var(--post-gold-2), var(--post-gold));
    }

    .post-kicker {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 11px 17px;
        border-radius: 999px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(219, 165, 45, 0.34);
        font-size: 13px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 18px;
        backdrop-filter: blur(12px);
    }

    .post-kicker svg {
        width: 18px;
        height: 18px;
        color: var(--post-gold-2);
        flex-shrink: 0;
    }

    .post-title {
        margin: 0;
        max-width: 960px;
        color: #ffffff;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(34px, 4.1vw, 62px);
        line-height: 1.08;
        font-weight: 700;
        letter-spacing: -1.3px;
        text-shadow: 0 14px 34px rgba(0, 0, 0, 0.24);
    }

    .post-divider {
        width: 110px;
        height: 18px;
        margin: 22px 0 18px;
        position: relative;
    }

    .post-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--post-gold), transparent);
    }

    .post-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 48px;
        width: 10px;
        height: 10px;
        transform: rotate(45deg);
        background: var(--post-gold);
        border-radius: 2px;
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .post-meta-item {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 0 15px;
        border-radius: 999px;
        color: rgba(255, 255, 255, 0.92);
        background: rgba(255, 255, 255, 0.11);
        border: 1px solid rgba(255, 255, 255, 0.13);
        font-size: 14px;
        font-weight: 700;
        backdrop-filter: blur(10px);
    }

    .post-meta-item svg {
        width: 17px;
        height: 17px;
        color: var(--post-gold-2);
        flex-shrink: 0;
    }

    .post-body {
        padding: 34px 44px 46px;
    }

    .post-featured-frame {
        width: 100%;
        min-height: 410px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 34px;
        padding: 16px;
        border-radius: 24px;
        background:
            linear-gradient(180deg, #fbfcff 0%, #eef3f8 100%);
        border: 1px solid rgba(6, 27, 54, 0.06);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.90);
        overflow: hidden;
    }

    .post-featured-frame img {
        width: 100%;
        max-height: 680px;
        object-fit: contain;
        object-position: center;
        display: block;
        border-radius: 18px;
    }

    .post-content {
        color: #3f4f63;
        font-size: 17px;
        line-height: 1.95;
    }

    .post-content > *:first-child {
        margin-top: 0;
    }

    .post-content p {
        margin: 0 0 1.35rem;
    }

    .post-content h1,
    .post-content h2,
    .post-content h3,
    .post-content h4 {
        color: var(--post-navy);
        font-weight: 900;
        line-height: 1.25;
        margin: 2rem 0 1rem;
        letter-spacing: -0.4px;
    }

    .post-content h2 {
        font-size: 30px;
    }

    .post-content h3 {
        font-size: 24px;
    }

    .post-content strong {
        color: var(--post-navy);
        font-weight: 900;
    }

    .post-content a {
        color: #2457d6;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: 0.22s ease;
    }

    .post-content a:hover {
        border-bottom-color: #2457d6;
    }

    .post-content ul,
    .post-content ol {
        padding-left: 1.35rem;
        margin: 0 0 1.4rem;
    }

    .post-content li {
        margin-bottom: 0.55rem;
    }

    .post-content blockquote {
        margin: 2rem 0;
        padding: 22px 24px;
        border-left: 4px solid var(--post-gold);
        border-radius: 0 18px 18px 0;
        background: rgba(219, 165, 45, 0.09);
        color: var(--post-navy);
        font-weight: 700;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        display: block;
        border-radius: 18px;
        margin: 24px auto;
    }

    .post-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-top: 36px;
        padding-top: 26px;
        border-top: 1px solid rgba(6, 27, 54, 0.08);
    }

    .post-footer-note {
        color: var(--post-muted);
        font-size: 14px;
        line-height: 1.6;
    }

    .post-footer-action {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0 20px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, var(--post-navy-2), var(--post-navy));
        border: 1px solid rgba(219, 165, 45, 0.60);
        font-size: 14px;
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 14px 30px rgba(6, 27, 54, 0.18);
        transition: 0.24s ease;
    }

    .post-footer-action svg {
        width: 17px;
        height: 17px;
        color: var(--post-gold-2);
        transition: 0.24s ease;
    }

    .post-footer-action:hover {
        color: #ffffff;
        transform: translateY(-3px);
    }

    .post-footer-action:hover svg {
        transform: translateX(-3px);
    }

    .post-sidebar {
        position: sticky;
        top: 150px;
        display: grid;
        gap: 22px;
    }

    .post-sidebar-card {
        overflow: hidden;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--post-border);
        box-shadow: var(--post-shadow);
    }

    .post-sidebar-head {
        position: relative;
        padding: 24px 24px 20px;
        background:
            linear-gradient(135deg, rgba(6, 27, 54, 0.97), rgba(11, 43, 82, 0.92));
        color: #ffffff;
    }

    .post-sidebar-head::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 4px;
        background: linear-gradient(90deg, var(--post-gold), var(--post-gold-2));
    }

    .post-sidebar-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--post-gold-2);
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .post-sidebar-kicker svg {
        width: 15px;
        height: 15px;
    }

    .post-sidebar-title {
        margin: 0;
        color: #ffffff;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 28px;
        line-height: 1.15;
        font-weight: 700;
    }

    .post-sidebar-list {
        display: grid;
        gap: 0;
        padding: 14px;
    }

    .post-related {
        display: grid;
        grid-template-columns: 96px 1fr;
        gap: 14px;
        padding: 12px;
        border-radius: 18px;
        text-decoration: none;
        transition: 0.24s ease;
    }

    .post-related:not(:last-child) {
        margin-bottom: 4px;
    }

    .post-related:hover {
        background: rgba(219, 165, 45, 0.10);
        transform: translateY(-2px);
    }

    .post-related-thumb {
        width: 96px;
        height: 96px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px;
        overflow: hidden;
        border-radius: 16px;
        background: linear-gradient(180deg, #fbfcff 0%, #eef3f8 100%);
        border: 1px solid rgba(6, 27, 54, 0.06);
    }

    .post-related-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        border-radius: 11px;
        transition: 0.24s ease;
    }

    .post-related:hover .post-related-thumb img {
        transform: scale(1.04);
    }

    .post-related-content {
        min-width: 0;
    }

    .post-related-title {
        display: block;
        color: var(--post-navy);
        font-size: 15px;
        line-height: 1.42;
        font-weight: 900;
        transition: 0.22s ease;
    }

    .post-related:hover .post-related-title {
        color: #b98217;
    }

    .post-related-date {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 9px;
        color: var(--post-muted);
        font-size: 13px;
        line-height: 1.45;
        font-weight: 600;
    }

    .post-related-date svg {
        width: 14px;
        height: 14px;
        color: var(--post-gold);
        flex-shrink: 0;
    }

    .post-empty {
        padding: 22px;
        color: var(--post-muted);
        font-size: 15px;
        line-height: 1.7;
    }

    .post-info-card {
        padding: 24px;
        border-radius: 26px;
        background:
            linear-gradient(180deg, #ffffff 0%, #f9fbfd 100%);
        border: 1px solid var(--post-border);
        box-shadow: var(--post-shadow);
    }

    .post-info-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 12px;
        color: var(--post-navy);
        font-size: 18px;
        font-weight: 900;
    }

    .post-info-title svg {
        width: 22px;
        height: 22px;
        color: var(--post-gold);
    }

    .post-info-text {
        margin: 0;
        color: var(--post-muted);
        font-size: 14.5px;
        line-height: 1.75;
    }

    @media (max-width: 1180px) {
        .post-layout {
            grid-template-columns: 1fr;
        }

        .post-sidebar {
            position: static;
            top: auto;
        }

        .post-sidebar-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            display: grid;
            gap: 10px;
        }
    }

    @media (max-width: 768px) {
        .post-page {
            padding: 38px 0 70px;
        }

        .post-container {
            width: min(100% - 22px, 1360px);
        }

        .post-header {
            padding: 34px 24px 28px;
        }

        .post-title {
            font-size: clamp(31px, 10vw, 44px);
            letter-spacing: -0.8px;
        }

        .post-body {
            padding: 24px 20px 30px;
        }

        .post-featured-frame {
            min-height: 250px;
            padding: 10px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .post-featured-frame img {
            border-radius: 14px;
            max-height: 460px;
        }

        .post-content {
            font-size: 15.8px;
            line-height: 1.85;
        }

        .post-content h2 {
            font-size: 24px;
        }

        .post-content h3 {
            font-size: 21px;
        }

        .post-footer {
            align-items: stretch;
        }

        .post-footer-action {
            width: 100%;
        }

        .post-sidebar-list {
            grid-template-columns: 1fr;
        }

        .post-related {
            grid-template-columns: 86px 1fr;
        }

        .post-related-thumb {
            width: 86px;
            height: 86px;
        }
    }

    @media (max-width: 480px) {
        .post-back-link {
            width: 100%;
            justify-content: center;
        }

        .post-main {
            border-radius: 24px;
        }

        .post-header {
            padding: 30px 20px 26px;
        }

        .post-kicker {
            font-size: 11px;
            letter-spacing: 0.7px;
        }

        .post-meta-item {
            width: 100%;
            justify-content: center;
            text-align: center;
        }

        .post-featured-frame {
            min-height: 210px;
        }

        .post-sidebar-head {
            padding: 22px 20px 18px;
        }

        .post-sidebar-title {
            font-size: 24px;
        }

        .post-related {
            grid-template-columns: 78px 1fr;
            gap: 12px;
            padding: 10px;
        }

        .post-related-thumb {
            width: 78px;
            height: 78px;
        }

        .post-related-title {
            font-size: 14px;
        }
    }
</style>

<section class="post-page">
    <div class="post-container">
        <div class="post-back">
            <a href="{{ route('posts.index') }}" class="post-back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Berita & Artikel
            </a>
        </div>

        <div class="post-layout">
            {{-- Konten Utama Berita --}}
            <article class="post-main">
                <header class="post-header">
                    <div class="post-kicker">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                        </svg>
                        Informasi Sekolah
                    </div>

                    <h1 class="post-title">{{ $post->title }}</h1>

                    <div class="post-divider"></div>

                    <div class="post-meta">
                        <div class="post-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </div>

                        <div class="post-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Oleh: {{ optional($post->author)->name ?? 'Admin' }}
                        </div>
                    </div>
                </header>

                <div class="post-body">
                    @if($post->featured_image_path)
                        <div class="post-featured-frame">
                            <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="{{ $post->title }}">
                        </div>
                    @endif

                    <div class="post-content">
                        {!! $post->content !!}
                    </div>

                    <footer class="post-footer">
                        <div class="post-footer-note">
                            Artikel ini merupakan informasi resmi dari SMP Darul Mustofa.
                        </div>

                        <a href="{{ route('posts.index') }}" class="post-footer-action">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Lihat Artikel Lainnya
                        </a>
                    </footer>
                </div>
            </article>

            {{-- Sidebar Berita Terbaru --}}
            <aside class="post-sidebar">
                <div class="post-sidebar-card">
                    <div class="post-sidebar-head">
                        <div class="post-sidebar-kicker">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.158c.969 0 1.371 1.24.588 1.81l-3.364 2.444a1 1 0 00-.364 1.118l1.285 3.955c.3.922-.755 1.688-1.539 1.118L12 15.56l-3.364 2.457c-.784.57-1.838-.196-1.539-1.118l1.285-3.955a1 1 0 00-.364-1.118L4.654 9.382c-.783-.57-.38-1.81.588-1.81H9.4a1 1 0 00.95-.69l1.286-3.955z"></path>
                            </svg>
                            Rekomendasi
                        </div>

                        <h3 class="post-sidebar-title">Berita Lainnya</h3>
                    </div>

                    @if($latestPosts->count() > 0)
                        <div class="post-sidebar-list">
                            @foreach ($latestPosts as $latestPost)
                                <a href="{{ route('posts.show', $latestPost->slug) }}" class="post-related">
                                    <div class="post-related-thumb">
                                        <img
                                            src="{{ $latestPost->featured_image_path ? asset('storage/' . $latestPost->featured_image_path) : 'https://placehold.co/300x300/f3f6fa/061b36?text=Berita' }}"
                                            alt="{{ $latestPost->title }}">
                                    </div>

                                    <div class="post-related-content">
                                        <span class="post-related-title">{{ $latestPost->title }}</span>

                                        <span class="post-related-date">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($latestPost->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="post-empty">Tidak ada berita lain yang tersedia saat ini.</p>
                    @endif
                </div>

                <div class="post-info-card">
                    <h4 class="post-info-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 3a9 9 0 110 18 9 9 0 010-18z"></path>
                        </svg>
                        Informasi
                    </h4>

                    <p class="post-info-text">
                        Pantau terus halaman berita untuk mendapatkan pengumuman akademik,
                        dokumentasi kegiatan, dan informasi terbaru dari SMP Darul Mustofa.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection