@extends('layouts.frontend')

@section('title', 'Visi & Misi Sekolah')

@push('styles')
<style>
    :root {
        --vm-navy: #061b36;
        --vm-navy-2: #0b2b52;
        --vm-gold: #dba52d;
        --vm-gold-2: #f0c45a;
        --vm-white: #ffffff;
        --vm-soft: #f7f9fc;
        --vm-soft-2: #eef3f8;
        --vm-text: #142844;
        --vm-muted: #6c7788;
        --vm-border: rgba(6, 27, 54, 0.08);
        --vm-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --vm-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .vm-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .vm-page::before,
    .vm-page::after {
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

    .vm-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .vm-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .vm-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1260px);
        margin-inline: auto;
    }

    .vm-header {
        max-width: 880px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .vm-logo {
        width: 86px;
        height: 86px;
        margin: 0 auto 18px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid rgba(219, 165, 45, 0.28);
        box-shadow: 0 18px 45px rgba(6, 27, 54, 0.10);
        padding: 8px;
    }

    .vm-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .vm-kicker {
        margin: 0 0 12px;
        color: var(--vm-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .vm-title {
        margin: 0;
        color: var(--vm-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .vm-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .vm-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--vm-gold), transparent);
    }

    .vm-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--vm-gold);
        border-radius: 2px;
    }

    .vm-subtitle {
        max-width: 760px;
        margin: 0 auto;
        color: var(--vm-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .vm-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 30px;
        margin-top: 48px;
    }

    .vm-card {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        background: #ffffff;
        border: 1px solid var(--vm-border);
        box-shadow: var(--vm-shadow);
        transition: 0.28s ease;
    }

    .vm-card:hover {
        transform: translateY(-9px);
        box-shadow: var(--vm-shadow-hover);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .vm-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--vm-gold), var(--vm-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .vm-card:hover::after {
        transform: scaleX(1);
    }

    .vm-card-head {
        position: relative;
        padding: 38px 34px 30px;
        background:
            radial-gradient(circle at 18% 22%, rgba(219, 165, 45, 0.18), transparent 30%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
        color: #ffffff;
        text-align: center;
    }

    .vm-card-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 18px;
        display: grid;
        place-items: center;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(219, 165, 45, 0.34);
        color: var(--vm-gold-2);
        box-shadow: 0 14px 34px rgba(0, 0, 0, 0.14);
    }

    .vm-card-icon svg {
        width: 40px;
        height: 40px;
    }

    .vm-card-title {
        margin: 0;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 38px;
        line-height: 1.1;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .vm-card-body {
        padding: 34px 36px 38px;
    }

    .vm-card-line {
        width: 58px;
        height: 2px;
        border-radius: 999px;
        background: var(--vm-gold);
        margin: 0 auto 24px;
    }

    .vm-content {
        color: #3f4f63;
        font-size: 17px;
        line-height: 1.9;
    }

    .vm-content p {
        margin: 0 0 1.25rem;
    }

    .vm-content p:last-child {
        margin-bottom: 0;
    }

    .vm-content ul,
    .vm-content ol {
        margin: 0;
        padding-left: 1.25rem;
    }

    .vm-content li {
        margin-bottom: 0.7rem;
    }

    .vm-content strong {
        color: var(--vm-navy);
        font-weight: 900;
    }

    .vm-note {
        margin-top: 34px;
        padding: 24px 28px;
        border-radius: 22px;
        background: #ffffff;
        border: 1px solid var(--vm-border);
        box-shadow: var(--vm-shadow);
        display: flex;
        align-items: center;
        gap: 18px;
        color: var(--vm-muted);
        font-size: 15.5px;
        line-height: 1.7;
    }

    .vm-note-icon {
        width: 54px;
        height: 54px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 16px;
        color: var(--vm-gold);
        background: rgba(219, 165, 45, 0.11);
    }

    .vm-note-icon svg {
        width: 28px;
        height: 28px;
    }

    @media (max-width: 900px) {
        .vm-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .vm-page {
            padding: 48px 0 70px;
        }

        .vm-container {
            width: min(100% - 22px, 1260px);
        }

        .vm-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .vm-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .vm-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .vm-logo {
            width: 76px;
            height: 76px;
        }

        .vm-card-head {
            padding: 32px 24px 26px;
        }

        .vm-card-body {
            padding: 28px 22px 32px;
        }

        .vm-content {
            font-size: 15.8px;
            line-height: 1.85;
        }

        .vm-note {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .vm-page {
            padding-top: 38px;
        }

        .vm-card {
            border-radius: 24px;
        }

        .vm-card-title {
            font-size: 32px;
        }
    }
</style>
@endpush

@section('content')
<section class="vm-page">
    <div class="vm-container">
        <div class="vm-header">
            <div class="vm-logo">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo SMP Darul Mustofa"
                     onerror="this.src='https://placehold.co/100x100/061b36/dba52d?text=DM'">
            </div>

            <p class="vm-kicker">Arah Pendidikan</p>

            <h1 class="vm-title">Visi & Misi</h1>

            <div class="vm-divider"></div>

            <p class="vm-subtitle">
                Komitmen SMP Darul Mustofa dalam membentuk generasi beriman,
                berilmu, berakhlak, dan siap menghadapi masa depan.
            </p>
        </div>

        <div class="vm-grid">
            <article class="vm-card">
                <div class="vm-card-head">
                    <div class="vm-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>

                    <h2 class="vm-card-title">Visi</h2>
                </div>

                <div class="vm-card-body">
                    <div class="vm-card-line"></div>

                    <div class="vm-content">
                        {{ $profile->vision ?? 'Visi sekolah belum diatur.' }}
                    </div>
                </div>
            </article>

            <article class="vm-card">
                <div class="vm-card-head">
                    <div class="vm-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v14H5V6a2 2 0 012-2z"></path>
                        </svg>
                    </div>

                    <h2 class="vm-card-title">Misi</h2>
                </div>

                <div class="vm-card-body">
                    <div class="vm-card-line"></div>

                    <div class="vm-content">
                        {!! nl2br(e($profile->mission ?? 'Misi sekolah belum diatur.')) !!}
                    </div>
                </div>
            </article>
        </div>

        <div class="vm-note">
            <div class="vm-note-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"></path>
                </svg>
            </div>

            <div>
                Visi dan misi menjadi dasar pengembangan program pendidikan,
                pembinaan karakter, serta peningkatan kualitas layanan sekolah.
            </div>
        </div>
    </div>
</section>
@endsection