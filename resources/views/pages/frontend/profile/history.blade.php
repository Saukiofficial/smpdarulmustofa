@extends('layouts.frontend')

@section('title', 'Sejarah Sekolah')

@push('styles')
<style>
    :root {
        --hist-navy: #061b36;
        --hist-navy-2: #0b2b52;
        --hist-gold: #dba52d;
        --hist-gold-2: #f0c45a;
        --hist-white: #ffffff;
        --hist-soft: #f7f9fc;
        --hist-soft-2: #eef3f8;
        --hist-text: #142844;
        --hist-muted: #6c7788;
        --hist-border: rgba(6, 27, 54, 0.08);
        --hist-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        --hist-shadow-hover: 0 28px 70px rgba(6, 27, 54, 0.16);
    }

    .hist-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 52%, #ffffff 100%);
        padding: 72px 0 88px;
    }

    .hist-page::before,
    .hist-page::after {
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

    .hist-page::before {
        left: -190px;
        top: -120px;
        transform: rotate(16deg);
    }

    .hist-page::after {
        right: -190px;
        top: 18px;
        transform: rotate(-12deg);
    }

    .hist-container {
        position: relative;
        z-index: 2;
        width: min(100% - 36px, 1280px);
        margin-inline: auto;
    }

    .hist-header {
        max-width: 860px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .hist-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 10px;
        display: grid;
        place-items: center;
        color: var(--hist-gold);
    }

    .hist-icon svg {
        width: 46px;
        height: 46px;
    }

    .hist-kicker {
        margin: 0 0 12px;
        color: var(--hist-gold);
        font-size: 14px;
        line-height: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .hist-title {
        margin: 0;
        color: var(--hist-navy);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 5vw, 76px);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -1.8px;
    }

    .hist-divider {
        width: 112px;
        height: 18px;
        margin: 14px auto 12px;
        position: relative;
    }

    .hist-divider::before {
        content: "";
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--hist-gold), transparent);
    }

    .hist-divider::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 50%;
        width: 10px;
        height: 10px;
        transform: translateX(-50%) rotate(45deg);
        background: var(--hist-gold);
        border-radius: 2px;
    }

    .hist-subtitle {
        max-width: 760px;
        margin: 0 auto;
        color: var(--hist-muted);
        font-size: 18px;
        line-height: 1.72;
    }

    .hist-card {
        overflow: hidden;
        border-radius: 30px;
        background: #ffffff;
        border: 1px solid var(--hist-border);
        box-shadow: var(--hist-shadow);
    }

    .hist-cover {
        position: relative;
        padding: 20px 20px 0;
    }

    .hist-image-frame {
        position: relative;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        overflow: hidden;
        background:
            linear-gradient(135deg, rgba(6, 27, 54, 0.92), rgba(11, 43, 82, 0.82)),
            url('{{ asset('images/gedung-sekolah2.png') }}') center / cover no-repeat;
        border: 1px solid rgba(6, 27, 54, 0.06);
        isolation: isolate;
    }

    .hist-image-frame::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 16% 22%, rgba(219, 165, 45, 0.22), transparent 30%),
            linear-gradient(180deg, rgba(6, 27, 54, 0.10), rgba(6, 27, 54, 0.28));
        z-index: -1;
    }

    .hist-image-title {
        max-width: 760px;
        padding: 40px;
        text-align: center;
        color: #ffffff;
    }

    .hist-image-title h2 {
        margin: 0 0 14px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(32px, 4vw, 54px);
        line-height: 1.1;
        font-weight: 700;
        letter-spacing: -0.8px;
        text-shadow: 0 14px 34px rgba(0, 0, 0, 0.28);
    }

    .hist-image-title p {
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
        font-size: 17px;
        line-height: 1.7;
    }

    .hist-body {
        padding: 42px 52px 52px;
    }

    .hist-content {
        color: #3f4f63;
        font-size: 17px;
        line-height: 1.95;
    }

    .hist-content p {
        margin: 0 0 1.35rem;
    }

    .hist-content strong {
        color: var(--hist-navy);
        font-weight: 900;
    }

    .hist-empty {
        text-align: center;
        padding: 58px 22px;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f9fbfd 100%);
        border: 1px dashed rgba(6, 27, 54, 0.16);
    }

    .hist-empty-icon {
        width: 84px;
        height: 84px;
        margin: 0 auto 20px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        color: var(--hist-gold);
        background: rgba(219, 165, 45, 0.10);
    }

    .hist-empty-icon svg {
        width: 44px;
        height: 44px;
    }

    .hist-empty-title {
        margin: 0 0 8px;
        color: var(--hist-navy);
        font-size: 26px;
        font-weight: 900;
    }

    .hist-empty-text {
        margin: 0;
        color: var(--hist-muted);
        font-size: 16px;
        line-height: 1.7;
    }

    .hist-footer {
        margin-top: 34px;
        padding-top: 26px;
        border-top: 1px solid rgba(6, 27, 54, 0.08);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 16px;
        color: var(--hist-muted);
        font-size: 14px;
        font-weight: 700;
    }

    .hist-footer span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .hist-footer svg {
        width: 17px;
        height: 17px;
        color: var(--hist-gold);
    }

    @media (max-width: 768px) {
        .hist-page {
            padding: 48px 0 70px;
        }

        .hist-container {
            width: min(100% - 22px, 1280px);
        }

        .hist-kicker {
            font-size: 12px;
            letter-spacing: 4px;
        }

        .hist-title {
            font-size: clamp(38px, 12vw, 54px);
        }

        .hist-subtitle {
            font-size: 15.5px;
            line-height: 1.65;
        }

        .hist-cover {
            padding: 14px 14px 0;
        }

        .hist-image-frame {
            min-height: 300px;
            border-radius: 20px;
        }

        .hist-image-title {
            padding: 28px 20px;
        }

        .hist-body {
            padding: 28px 22px 34px;
        }

        .hist-content {
            font-size: 15.8px;
            line-height: 1.85;
        }
    }

    @media (max-width: 480px) {
        .hist-page {
            padding-top: 38px;
        }

        .hist-card {
            border-radius: 24px;
        }

        .hist-image-frame {
            min-height: 250px;
        }
    }
</style>
@endpush

@section('content')
<section class="hist-page">
    <div class="hist-container">
        <div class="hist-header">
            <div class="hist-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

            <p class="hist-kicker">Profil Sekolah</p>

            <h1 class="hist-title">Sejarah Sekolah</h1>

            <div class="hist-divider"></div>

            <p class="hist-subtitle">
                Perjalanan SMP Darul Mustofa dalam membangun pendidikan yang berkualitas,
                berkarakter, dan berlandaskan nilai-nilai islami.
            </p>
        </div>

        <article class="hist-card">
            <div class="hist-cover">
                <div class="hist-image-frame">
                    <div class="hist-image-title">
                        <h2>SMP Darul Mustofa</h2>
                        <p>
                            Sejarah menjadi pondasi penting dalam menumbuhkan semangat,
                            identitas, dan arah perkembangan sekolah.
                        </p>
                    </div>
                </div>
            </div>

            <div class="hist-body">
                @if(empty($profile->history) || $profile->history === 'Sejarah sekolah belum diatur.')
                    <div class="hist-empty">
                        <div class="hist-empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>

                        <h3 class="hist-empty-title">Sejarah Belum Diatur</h3>
                        <p class="hist-empty-text">
                            Data sejarah sekolah akan tampil setelah diperbarui oleh administrator.
                        </p>
                    </div>
                @else
                    <div class="hist-content">
                        {!! nl2br(e($profile->history)) !!}
                    </div>
                @endif

                <div class="hist-footer">
                    <span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                        </svg>
                        Dokumentasi Profil Sekolah
                    </span>

                    <span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13"></path>
                        </svg>
                        Sistem Informasi SMP Darul Mustofa
                    </span>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection