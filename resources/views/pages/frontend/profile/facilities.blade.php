@extends('layouts.frontend')

@section('title', 'Fasilitas Sekolah')

@push('styles')
<style>
    :root {
        --fac-navy: #061b36;
        --fac-navy-2: #0b2b52;
        --fac-gold: #dba52d;
        --fac-gold-2: #f0c45a;
        --fac-white: #ffffff;
        --fac-soft: #f7f9fc;
        --fac-soft-2: #eef3f8;
        --fac-text: #142844;
        --fac-muted: #6c7788;
        --fac-border: rgba(6, 27, 54, 0.08);
        --fac-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --fac-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .fac-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .fac-page::before,
    .fac-page::after {
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

    .fac-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .fac-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .fac-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1420px);
        margin-inline: auto;
    }

    .fac-header {
        max-width: 860px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .fac-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--fac-gold);
    }

    .fac-icon svg {
        width: 46px;
        height: 46px;
    }

    .fac-kicker {
        margin: 0 0 12px;
        color: var(--fac-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .fac-title {
        margin: 0;
        color: var(--fac-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .fac-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .fac-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--fac-gold), transparent);
    }

    .fac-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--fac-gold);
        border-radius: 2px;
    }

    .fac-subtitle {
        max-width: 780px;
        margin: 0 auto;
        color: var(--fac-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .fac-toolbar {
        display: flex;
        justify-content: center;
        margin: 38px auto 46px;
    }

    .fac-pill {
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

    .fac-pill svg {
        width: 20px;
        height: 20px;
        color: var(--fac-gold-2);
    }

    .fac-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        align-items: stretch;
    }

    .fac-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 24px;
        background: #ffffff;
        border: 1px solid var(--fac-border);
        box-shadow: var(--fac-shadow);
        transition: 0.28s ease;
    }

    .fac-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--fac-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .fac-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--fac-gold), var(--fac-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .fac-card:hover::after {
        transform: scaleX(1);
    }

    .fac-media {
        position: relative;
        padding: 16px 16px 0;
    }

    .fac-image-box {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 10;
        min-height: 245px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(180deg, #fbfcff 0%, #edf2f7 100%);
        border: 1px solid rgba(6, 27, 54, 0.06);
        padding: 10px;
    }

    .fac-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        border-radius: 14px;
        transition: 0.35s ease;
    }

    .fac-card:hover .fac-image {
        transform: scale(1.025);
    }

    .fac-badge {
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
        font-weight: 900;
        backdrop-filter: blur(10px);
    }

    .fac-badge svg {
        width: 17px;
        height: 17px;
        color: var(--fac-gold-2);
    }

    .fac-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 24px 26px 26px;
    }

    .fac-card-title {
        margin: 0 0 12px;
        color: var(--fac-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(25px, 1.6vw, 32px);
        line-height: 1.16;
        font-weight: 700;
        letter-spacing: -0.45px;
    }

    .fac-mini-line {
        width: 54px;
        height: 2px;
        border-radius: 999px;
        background: var(--fac-gold);
        margin-bottom: 16px;
    }

    .fac-description {
        margin: 0;
        color: var(--fac-muted);
        font-size: 15.5px;
        line-height: 1.78;
    }

    .fac-empty {
        max-width: 820px;
        margin: 0 auto;
        padding: 68px 24px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.16);
        border-radius: 28px;
        box-shadow: var(--fac-shadow);
    }

    .fac-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--fac-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .fac-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .fac-empty-title {
        margin: 0 0 8px;
        color: var(--fac-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .fac-empty-text {
        margin: 0;
        color: var(--fac-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    .fac-pagination {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .fac-pagination > div {
        background: #ffffff;
        border-radius: 18px;
        padding: 14px 16px;
        border: 1px solid var(--fac-border);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.08);
    }

    .fac-summary {
        margin-top: 42px;
        padding: 22px 26px;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid var(--fac-border);
        box-shadow: var(--fac-shadow);
        color: var(--fac-muted);
        text-align: center;
        font-weight: 700;
        line-height: 1.6;
    }

    .fac-summary strong {
        color: var(--fac-navy);
    }

    @media (max-width: 1180px) {
        .fac-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .fac-page {
            padding: 48px 0 70px;
        }

        .fac-container {
            width: min(100% - 22px, 1420px);
        }

        .fac-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .fac-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .fac-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .fac-toolbar {
            margin: 28px auto 34px;
        }

        .fac-pill {
            width: 100%;
            min-height: 50px;
        }

        .fac-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .fac-image-box {
            min-height: 220px;
        }

        .fac-body {
            padding: 22px 20px 24px;
        }

        .fac-card-title {
            font-size: 27px;
        }
    }

    @media (max-width: 480px) {
        .fac-page {
            padding-top: 38px;
        }

        .fac-media {
            padding: 12px 12px 0;
        }

        .fac-image-box {
            min-height: 200px;
            border-radius: 16px;
        }

        .fac-badge {
            top: 22px;
            left: 22px;
            padding: 9px 13px;
            font-size: 12px;
        }

        .fac-card-title {
            font-size: 24px;
        }
    }
</style>
@endpush

@section('content')
<section class="fac-page">
    <div class="fac-container">
        <div class="fac-header">
            <div class="fac-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 10h.01M12 10h.01M15 10h.01"></path>
                </svg>
            </div>

            <p class="fac-kicker">Sarana Pendidikan</p>

            <h1 class="fac-title">Fasilitas Sekolah</h1>

            <div class="fac-divider"></div>

            <p class="fac-subtitle">
                Fasilitas sekolah yang mendukung pembelajaran, pembinaan karakter,
                dan pengembangan potensi siswa SMP Darul Mustofa.
            </p>
        </div>

        <div class="fac-toolbar">
            <div class="fac-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1M9 11h1m4 0h1"></path>
                </svg>
                Fasilitas Pendukung Pembelajaran
            </div>
        </div>

        @if($facilities->count() > 0)
            <div class="fac-grid">
                @forelse ($facilities as $facility)
                    <article class="fac-card">
                        <div class="fac-media">
                            <div class="fac-image-box">
                                <img src="{{ asset('storage/' . $facility->image_path) }}"
                                     alt="{{ $facility->name }}"
                                     class="fac-image"
                                     loading="lazy"
                                     onerror="this.src='https://placehold.co/900x560/f3f6fa/061b36?text=Fasilitas+Sekolah'">
                            </div>

                            <div class="fac-badge">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M5 21V7l7-4 7 4v14"></path>
                                </svg>
                                Fasilitas
                            </div>
                        </div>

                        <div class="fac-body">
                            <h2 class="fac-card-title">{{ $facility->name }}</h2>
                            <div class="fac-mini-line"></div>
                            <p class="fac-description">{{ $facility->description }}</p>
                        </div>
                    </article>
                @empty
                @endforelse
            </div>

            @if($facilities->hasPages())
                <div class="fac-pagination">
                    <div>
                        {{ $facilities->links() }}
                    </div>
                </div>
            @endif

            <div class="fac-summary">
                <strong>{{ $facilities->total() }}</strong> total fasilitas tersedia
                @if($facilities->hasPages())
                    — halaman <strong>{{ $facilities->currentPage() }}</strong> dari <strong>{{ $facilities->lastPage() }}</strong>
                @endif
            </div>
        @else
            <div class="fac-empty">
                <div class="fac-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2"></path>
                    </svg>
                </div>

                <h3 class="fac-empty-title">Belum Ada Fasilitas</h3>
                <p class="fac-empty-text">
                    Data fasilitas sekolah sedang dalam proses pembaruan.
                </p>
            </div>
        @endif
    </div>
</section>
@endsection