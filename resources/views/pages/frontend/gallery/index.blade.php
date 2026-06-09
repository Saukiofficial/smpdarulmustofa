@extends('layouts.frontend')

@section('title', 'Galeri Sekolah')

@push('styles')
<style>
    :root {
        --gal-navy: #061b36;
        --gal-navy-2: #0b2b52;
        --gal-gold: #dba52d;
        --gal-gold-2: #f0c45a;
        --gal-white: #ffffff;
        --gal-soft: #f7f9fc;
        --gal-soft-2: #eef3f8;
        --gal-text: #142844;
        --gal-muted: #6c7788;
        --gal-border: rgba(6, 27, 54, 0.08);
        --gal-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --gal-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .gallery-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .gallery-page::before,
    .gallery-page::after {
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

    .gallery-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .gallery-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .gallery-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .gallery-header {
        max-width: 850px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .gallery-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--gal-gold);
    }

    .gallery-icon svg {
        width: 44px;
        height: 44px;
    }

    .gallery-kicker {
        margin: 0 0 12px;
        color: var(--gal-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .gallery-title {
        margin: 0;
        color: var(--gal-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .gallery-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .gallery-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--gal-gold), transparent);
    }

    .gallery-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--gal-gold);
        border-radius: 2px;
    }

    .gallery-subtitle {
        max-width: 760px;
        margin: 0 auto;
        color: var(--gal-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .gallery-toolbar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        margin: 38px auto 46px;
    }

    .gallery-pill {
        min-height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 0 26px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(180deg, #09284d 0%, #061b36 100%);
        border: 1px solid rgba(219, 165, 45, 0.65);
        box-shadow: 0 18px 38px rgba(6, 27, 54, 0.20);
        font-size: 15px;
        font-weight: 900;
    }

    .gallery-pill svg {
        width: 20px;
        height: 20px;
        color: var(--gal-gold-2);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        align-items: stretch;
    }

    .gallery-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 24px;
        background: #ffffff;
        border: 1px solid var(--gal-border);
        box-shadow: var(--gal-shadow);
        transition: 0.28s ease;
    }

    .gallery-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--gal-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .gallery-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--gal-gold), var(--gal-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .gallery-card:hover::after {
        transform: scaleX(1);
    }

    .gallery-card-media {
        position: relative;
        padding: 16px 16px 0;
    }

    .gallery-image-link {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 10;
        min-height: 245px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 18px;
        background:
            linear-gradient(180deg, #fbfcff 0%, #edf2f7 100%);
        border: 1px solid rgba(6, 27, 54, 0.06);
        padding: 10px;
        text-decoration: none;
    }

    .gallery-image-link img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        border-radius: 14px;
        transition: 0.35s ease;
    }

    .gallery-card:hover .gallery-image-link img {
        transform: scale(1.025);
    }

    .gallery-album-badge {
        position: absolute;
        top: 28px;
        left: 28px;
        z-index: 4;
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
        font-weight: 900;
        backdrop-filter: blur(10px);
    }

    .gallery-album-badge svg {
        width: 17px;
        height: 17px;
        color: var(--gal-gold-2);
    }

    .gallery-count-badge {
        position: absolute;
        top: 28px;
        right: 28px;
        z-index: 4;
        min-width: 78px;
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 13px;
        border-radius: 12px;
        color: var(--gal-navy);
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 12px 26px rgba(6, 27, 54, 0.12);
        font-size: 13px;
        font-weight: 900;
    }

    .gallery-count-badge svg {
        width: 17px;
        height: 17px;
        color: var(--gal-gold);
    }

    .gallery-overlay {
        position: absolute;
        inset: 16px 16px 0;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(6, 27, 54, 0.72), rgba(6, 27, 54, 0.38));
        opacity: 0;
        transition: 0.28s ease;
        display: grid;
        place-items: center;
        pointer-events: none;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-view {
        width: 74px;
        height: 74px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.26);
        backdrop-filter: blur(14px);
        box-shadow: 0 18px 38px rgba(0, 0, 0, 0.22);
        transform: translateY(12px);
        transition: 0.28s ease;
    }

    .gallery-card:hover .gallery-view {
        transform: translateY(0);
    }

    .gallery-view svg {
        width: 34px;
        height: 34px;
        color: var(--gal-gold-2);
    }

    .gallery-card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 24px 26px 26px;
    }

    .gallery-card-title {
        margin: 0 0 12px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(25px, 1.6vw, 32px);
        line-height: 1.16;
        font-weight: 700;
        letter-spacing: -0.45px;
    }

    .gallery-card-title a {
        color: var(--gal-navy);
        text-decoration: none;
        transition: 0.22s ease;
    }

    .gallery-card:hover .gallery-card-title a {
        color: #b98217;
    }

    .gallery-mini-line {
        width: 54px;
        height: 2px;
        border-radius: 999px;
        background: var(--gal-gold);
        margin-bottom: 16px;
    }

    .gallery-description {
        flex: 1;
        margin: 0 0 22px;
        color: var(--gal-muted);
        font-size: 15.5px;
        line-height: 1.78;
    }

    .gallery-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid rgba(6, 27, 54, 0.07);
    }

    .gallery-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gal-muted);
        font-size: 13.5px;
        font-weight: 700;
        line-height: 1.4;
    }

    .gallery-date svg {
        width: 16px;
        height: 16px;
        color: var(--gal-gold);
        flex-shrink: 0;
    }

    .gallery-readmore {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gal-navy);
        font-size: 14px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
        transition: 0.22s ease;
    }

    .gallery-readmore svg {
        width: 16px;
        height: 16px;
        color: var(--gal-gold);
        transition: 0.22s ease;
    }

    .gallery-readmore:hover {
        color: var(--gal-gold);
    }

    .gallery-readmore:hover svg {
        transform: translateX(4px);
    }

    .gallery-empty {
        max-width: 820px;
        margin: 0 auto;
        padding: 68px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--gal-shadow);
    }

    .gallery-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--gal-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .gallery-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .gallery-empty-title {
        margin: 0 0 8px;
        color: var(--gal-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .gallery-empty-text {
        margin: 0;
        color: var(--gal-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    .gallery-pagination {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .gallery-pagination > div {
        background: #ffffff;
        border-radius: 18px;
        padding: 14px 16px;
        border: 1px solid var(--gal-border);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.08);
    }

    @media (max-width: 1180px) {
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .gallery-image-link {
            min-height: 230px;
        }
    }

    @media (max-width: 768px) {
        .gallery-page {
            padding: 48px 0 70px;
        }

        .gallery-container {
            width: min(100% - 22px, 1420px);
        }

        .gallery-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .gallery-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .gallery-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .gallery-toolbar {
            margin: 28px auto 34px;
        }

        .gallery-pill {
            width: 100%;
            min-height: 50px;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .gallery-image-link {
            min-height: 220px;
        }

        .gallery-card-body {
            padding: 22px 20px 24px;
        }

        .gallery-card-title {
            font-size: 27px;
        }
    }

    @media (max-width: 480px) {
        .gallery-page {
            padding-top: 38px;
        }

        .gallery-card-media {
            padding: 12px 12px 0;
        }

        .gallery-image-link {
            min-height: 200px;
            border-radius: 16px;
        }

        .gallery-album-badge {
            top: 22px;
            left: 22px;
            padding: 9px 13px;
            font-size: 12px;
        }

        .gallery-count-badge {
            top: 22px;
            right: 22px;
            min-width: 64px;
            min-height: 40px;
            font-size: 12px;
        }

        .gallery-overlay {
            inset: 12px 12px 0;
            border-radius: 16px;
        }

        .gallery-card-title {
            font-size: 24px;
        }

        .gallery-card-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .gallery-readmore {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>
@endpush

@section('content')
<section class="gallery-page">
    <div class="gallery-container">
        <div class="gallery-header">
            <div class="gallery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 8h.01"></path>
                </svg>
            </div>

            <p class="gallery-kicker">Dokumentasi Sekolah</p>

            <h1 class="gallery-title">
                Galeri Kegiatan
            </h1>

            <div class="gallery-divider"></div>

            <p class="gallery-subtitle">
                Kumpulan dokumentasi kegiatan, prestasi, pembelajaran, dan momen berharga
                SMP Darul Mustofa yang tersusun rapi dalam album galeri sekolah.
            </p>
        </div>

        <div class="gallery-toolbar">
            <div class="gallery-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Album Dokumentasi Sekolah
            </div>
        </div>

        @if($albums->count() > 0)
            <div class="gallery-grid">
                @foreach ($albums as $index => $album)
                    @php
                        $firstGallery = $album->galleries->first();
                        $imageUrl = $firstGallery
                            ? asset('storage/' . $firstGallery->file_path)
                            : 'https://placehold.co/900x560/f3f6fa/061b36?text=SMP+Darul+Mustofa';

                        $albumUrl = \Illuminate\Support\Facades\Route::has('gallery.show')
                            ? route('gallery.show', $album->slug ?? $album->id)
                            : '#';

                        $albumDate = $album->created_at
                            ? \Carbon\Carbon::parse($album->created_at)->locale('id')->isoFormat('D MMMM YYYY')
                            : 'Dokumentasi Sekolah';
                    @endphp

                    <article class="gallery-card">
                        <div class="gallery-card-media">
                            <a href="{{ $albumUrl }}" class="gallery-image-link">
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $album->name }}"
                                     loading="lazy"
                                     onerror="this.src='https://placehold.co/900x560/f3f6fa/061b36?text=Gambar+Tidak+Tersedia'">
                            </a>

                            <div class="gallery-album-badge">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14"></path>
                                </svg>
                                Album
                            </div>

                            <div class="gallery-count-badge">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h2l2-3h10l2 3h2v13H3V7z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17a4 4 0 100-8 4 4 0 000 8z"></path>
                                </svg>
                                {{ $album->galleries->count() }} Foto
                            </div>

                            <div class="gallery-overlay">
                                <div class="gallery-view">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-card-body">
                            <h2 class="gallery-card-title">
                                <a href="{{ $albumUrl }}">
                                    {{ $album->name }}
                                </a>
                            </h2>

                            <div class="gallery-mini-line"></div>

                            <p class="gallery-description">
                                {{ \Illuminate\Support\Str::limit($album->description ?? 'Koleksi foto kegiatan dan dokumentasi sekolah SMP Darul Mustofa.', 120) }}
                            </p>

                            <div class="gallery-card-footer">
                                <div class="gallery-date">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $albumDate }}
                                </div>

                                <a href="{{ $albumUrl }}" class="gallery-readmore">
                                    Lihat Album
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($albums->hasPages())
                <div class="gallery-pagination">
                    <div>
                        {{ $albums->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="gallery-empty">
                <div class="gallery-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L22 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <h3 class="gallery-empty-title">Belum Ada Album</h3>

                <p class="gallery-empty-text">
                    Album galeri kegiatan sekolah akan segera ditampilkan di halaman ini.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection