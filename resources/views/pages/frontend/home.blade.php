@extends('layouts.frontend')

@section('title', 'Selamat Datang di SMP DARUL MUSTOFA')

@push('styles')
<style>
    /* =========================================================
       SMP DARUL MUSTOFA - RESPONSIVE ELITE HOMEPAGE
       Navy, Gold, White - Desktop tidak kepotong
    ========================================================= */

    :root {
        --dm-navy: #061b36;
        --dm-navy-2: #09284d;
        --dm-gold: #dba52d;
        --dm-gold-2: #f0c45a;
        --dm-white: #ffffff;
        --dm-soft: #f6f8fb;
        --dm-text: #0d1b2f;
        --dm-muted: #68758a;
        --dm-border: rgba(219, 165, 45, 0.35);
        --dm-radius: 22px;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    body {
        color: var(--dm-text);
    }

    a {
        text-decoration: none;
    }

    .dm-container {
        width: min(100% - 36px, 1500px);
        margin-inline: auto;
    }

    /* =========================================================
       HERO SECTION - TIDAK DIUBAH
    ========================================================= */

    .dm-hero {
        position: relative;
        overflow: hidden;
        isolation: isolate;
        background:
            linear-gradient(
                90deg,
                rgba(3, 18, 38, 0.98) 0%,
                rgba(6, 27, 54, 0.92) 34%,
                rgba(6, 27, 54, 0.62) 61%,
                rgba(6, 27, 54, 0.34) 100%
            ),
            url('{{ asset('images/gedung-sekolah.jpg') }}') center / cover no-repeat;
    }

    .dm-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -2;
        background:
            radial-gradient(circle at 14% 32%, rgba(219, 165, 45, 0.20), transparent 28%),
            radial-gradient(circle at 86% 18%, rgba(255, 255, 255, 0.11), transparent 27%),
            linear-gradient(180deg, rgba(0, 0, 0, 0.04), rgba(0, 0, 0, 0.20));
        pointer-events: none;
    }

    .dm-hero::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 170px;
        z-index: -1;
        background: linear-gradient(180deg, transparent, rgba(3, 18, 38, 0.74));
        pointer-events: none;
    }

    .dm-hero-inner {
        position: relative;
        min-height: clamp(620px, calc(100vh - 128px), 790px);
        display: grid;
        grid-template-columns: minmax(0, 0.95fr) minmax(420px, 1.05fr);
        align-items: end;
        gap: clamp(18px, 3vw, 52px);
        padding: clamp(44px, 5vw, 72px) 0 clamp(26px, 3.5vw, 52px);
    }

    .dm-hero-content {
        position: relative;
        z-index: 5;
        align-self: center;
        max-width: 780px;
        padding-bottom: 8px;
    }

    .dm-badge {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        border: 1px solid var(--dm-border);
        border-radius: 10px;
        background: rgba(6, 27, 54, 0.58);
        color: #eef5ff;
        font-size: 15px;
        line-height: 1;
        backdrop-filter: blur(16px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
        margin-bottom: 24px;
    }

    .dm-badge i {
        color: var(--dm-gold);
        font-size: 20px;
    }

    .dm-hero-title {
        margin: 0;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(48px, 5.2vw, 86px);
        font-weight: 700;
        line-height: 0.98;
        letter-spacing: -2.6px;
        color: #ffffff;
        text-shadow: 0 12px 34px rgba(0, 0, 0, 0.36);
    }

    .dm-hero-title .gold {
        color: var(--dm-gold);
        text-shadow: 0 8px 30px rgba(219, 165, 45, 0.28);
    }

    .dm-title-line {
        width: 300px;
        height: 4px;
        border-radius: 999px;
        margin: 24px 0 22px;
        background: linear-gradient(90deg, var(--dm-gold), rgba(219, 165, 45, 0));
    }

    .dm-hero-subtitle {
        max-width: 670px;
        margin: 0 0 28px;
        color: rgba(255, 255, 255, 0.88);
        font-size: clamp(16px, 1.15vw, 19px);
        line-height: 1.72;
        text-shadow: 0 8px 24px rgba(0, 0, 0, 0.24);
    }

    .dm-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .dm-btn {
        min-height: 58px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 0 32px;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 700;
        transition: 0.28s ease;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .dm-btn-primary {
        color: #ffffff;
        background: linear-gradient(135deg, #c99118, #e2b33c);
        box-shadow: 0 18px 38px rgba(219, 165, 45, 0.28);
    }

    .dm-btn-primary:hover {
        color: #ffffff;
        transform: translateY(-4px);
        box-shadow: 0 24px 48px rgba(219, 165, 45, 0.36);
    }

    .dm-btn-outline {
        color: #ffffff;
        background: rgba(6, 27, 54, 0.34);
        border-color: rgba(219, 165, 45, 0.55);
        backdrop-filter: blur(12px);
    }

    .dm-btn-outline:hover {
        color: #ffffff;
        border-color: var(--dm-gold);
        background: rgba(219, 165, 45, 0.12);
        transform: translateY(-4px);
    }

    .dm-feature-strip {
        width: min(100%, 875px);
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
        border: 1px solid rgba(255, 255, 255, 0.20);
        border-radius: 18px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(18px);
        box-shadow: 0 20px 55px rgba(0, 0, 0, 0.18);
    }

    .dm-feature-item {
        display: grid;
        grid-template-columns: 42px 1fr;
        gap: 12px;
        align-items: center;
        padding: 20px 18px;
        color: #ffffff;
        position: relative;
        min-width: 0;
    }

    .dm-feature-item:not(:last-child)::after {
        content: "";
        position: absolute;
        right: 0;
        top: 24%;
        width: 1px;
        height: 52%;
        background: rgba(255, 255, 255, 0.26);
    }

    .dm-feature-icon {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        color: var(--dm-gold);
        font-size: 24px;
    }

    .dm-feature-title {
        display: block;
        margin-bottom: 4px;
        color: #ffffff;
        font-size: clamp(13px, 0.9vw, 16px);
        font-weight: 800;
        line-height: 1.18;
    }

    .dm-feature-text {
        display: block;
        color: rgba(255, 255, 255, 0.72);
        font-size: clamp(11px, 0.76vw, 13px);
        line-height: 1.35;
    }

    .dm-hero-visual {
        position: relative;
        z-index: 4;
        align-self: end;
        min-width: 0;
        width: 100%;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding-top: 20px;
    }

    .dm-students {
        display: block;
        width: min(100%, 850px);
        height: auto;
        max-height: clamp(490px, 72vh, 720px);
        object-fit: contain;
        object-position: bottom right;
        filter: drop-shadow(0 26px 48px rgba(0, 0, 0, 0.32));
        transform: translateX(18px);
        animation: dmFloat 6s ease-in-out infinite;
    }

    .dm-floating-card {
        position: absolute;
        right: 18px;
        bottom: 26px;
        width: min(430px, 78%);
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 18px 24px;
        border-radius: 16px;
        border: 1px solid rgba(219, 165, 45, 0.75);
        background: rgba(6, 27, 54, 0.86);
        color: #ffffff;
        backdrop-filter: blur(18px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.28);
        z-index: 8;
    }

    .dm-floating-card i {
        color: var(--dm-gold);
        font-size: 42px;
    }

    .dm-floating-card strong {
        display: block;
        color: var(--dm-gold-2);
        font-size: 22px;
        line-height: 1.1;
        margin-bottom: 5px;
    }

    .dm-floating-card span {
        color: #ffffff;
        font-size: 17px;
    }

    @keyframes dmFloat {
        0%, 100% {
            transform: translateX(18px) translateY(0);
        }

        50% {
            transform: translateX(18px) translateY(-12px);
        }
    }

    /* =========================================================
       STATS SECTION
    ========================================================= */

    .dm-stats {
        position: relative;
        padding: 80px 0;
        background: linear-gradient(180deg, #ffffff 0%, #f7f9fc 100%);
    }

    .dm-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .dm-stat-card {
        position: relative;
        overflow: hidden;
        min-height: 190px;
        padding: 30px 28px;
        border-radius: var(--dm-radius);
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        transition: 0.28s ease;
    }

    .dm-stat-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(219, 165, 45, 0.18), transparent 34%),
            linear-gradient(135deg, rgba(6, 27, 54, 0.04), transparent);
        opacity: 0;
        transition: 0.28s ease;
    }

    .dm-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 24px 58px rgba(6, 27, 54, 0.14);
        border-color: rgba(219, 165, 45, 0.30);
    }

    .dm-stat-card:hover::before {
        opacity: 1;
    }

    .dm-stat-icon {
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        background: rgba(219, 165, 45, 0.12);
        color: var(--dm-gold);
        font-size: 26px;
        margin-bottom: 22px;
        position: relative;
    }

    .dm-stat-number {
        position: relative;
        font-size: 46px;
        line-height: 1;
        font-weight: 900;
        color: var(--dm-navy);
        letter-spacing: -1px;
        margin-bottom: 10px;
    }

    .dm-stat-label {
        position: relative;
        color: var(--dm-muted);
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* =========================================================
       PRINCIPAL SECTION - REDESIGN
    ========================================================= */

    .dm-principal {
        position: relative;
        overflow: hidden;
        padding: 105px 0;
        background:
            radial-gradient(circle at 15% 18%, rgba(219, 165, 45, 0.11), transparent 30%),
            radial-gradient(circle at 90% 10%, rgba(6, 27, 54, 0.07), transparent 28%),
            linear-gradient(180deg, #ffffff 0%, #f7f9fc 100%);
        color: var(--dm-text);
    }

    .dm-principal::before,
    .dm-principal::after {
        content: "";
        position: absolute;
        pointer-events: none;
    }

    .dm-principal::before {
        inset: 0;
        opacity: 0.48;
        background-image:
            linear-gradient(rgba(6, 27, 54, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(6, 27, 54, 0.045) 1px, transparent 1px);
        background-size: 36px 36px;
        mask-image: radial-gradient(circle at 20% 10%, #000 0%, transparent 38%);
        -webkit-mask-image: radial-gradient(circle at 20% 10%, #000 0%, transparent 38%);
    }

    .dm-principal::after {
        right: -130px;
        bottom: -160px;
        width: 460px;
        height: 460px;
        border-radius: 999px;
        background: rgba(219, 165, 45, 0.10);
        filter: blur(4px);
    }

    .dm-principal-panel {
        position: relative;
        z-index: 2;
        overflow: hidden;
        border-radius: 34px;
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 28px 80px rgba(6, 27, 54, 0.10);
        backdrop-filter: blur(14px);
    }

    .dm-principal-panel::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 9px;
        background: linear-gradient(90deg, var(--dm-navy), var(--dm-gold), var(--dm-navy));
    }

    .dm-principal-grid {
        position: relative;
        display: grid;
        grid-template-columns: 0.88fr 1.12fr;
        gap: 0;
        align-items: stretch;
    }

    .dm-principal-media {
        position: relative;
        padding: 36px;
        background:
            radial-gradient(circle at 18% 20%, rgba(219, 165, 45, 0.22), transparent 32%),
            linear-gradient(135deg, #09284d 0%, #061b36 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 560px;
    }

    .dm-principal-photo-shell {
        width: min(100%, 430px);
        position: relative;
        padding: 16px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(219, 165, 45, 0.38);
        box-shadow: 0 28px 60px rgba(0, 0, 0, 0.22);
    }

    .dm-principal-photo-shell::before {
        content: "";
        position: absolute;
        inset: 28px -16px -16px 28px;
        border-radius: 30px;
        border: 1px solid rgba(219, 165, 45, 0.65);
        z-index: -1;
    }

    .dm-principal-photo {
        width: 100%;
        aspect-ratio: 4 / 5;
        display: block;
        border-radius: 24px;
        object-fit: cover;
        object-position: center top;
        background: #eef2f7;
        border: 1px solid rgba(255, 255, 255, 0.26);
    }

    .dm-principal-mini-card {
        position: absolute;
        left: 26px;
        right: 26px;
        bottom: 26px;
        padding: 18px 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(219, 165, 45, 0.28);
        box-shadow: 0 18px 40px rgba(6, 27, 54, 0.18);
        text-align: center;
    }

    .dm-principal-mini-name {
        margin: 0 0 4px;
        color: var(--dm-navy);
        font-size: 18px;
        font-weight: 900;
        line-height: 1.25;
    }

    .dm-principal-mini-role {
        margin: 0;
        color: var(--dm-muted);
        font-size: 13.5px;
        font-weight: 700;
    }

    .dm-principal-content {
        position: relative;
        padding: clamp(34px, 5vw, 64px);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dm-section-kicker {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 999px;
        color: var(--dm-gold);
        background: rgba(219, 165, 45, 0.11);
        border: 1px solid rgba(219, 165, 45, 0.24);
        font-weight: 900;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 18px;
    }

    .dm-section-title {
        margin: 0 0 18px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(34px, 3.6vw, 58px);
        line-height: 1.08;
        font-weight: 700;
        letter-spacing: -1.4px;
        color: var(--dm-navy);
    }

    .dm-section-title.dark {
        color: var(--dm-navy);
    }

    .dm-principal-quote-box {
        position: relative;
        margin-top: 24px;
        padding: 34px 34px 30px;
        border-radius: 26px;
        background:
            linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 18px 45px rgba(6, 27, 54, 0.07);
    }

    .dm-principal-quote-icon {
        width: 58px;
        height: 58px;
        display: grid;
        place-items: center;
        border-radius: 18px;
        color: var(--dm-gold);
        background: rgba(219, 165, 45, 0.12);
        border: 1px solid rgba(219, 165, 45, 0.25);
        font-size: 24px;
        margin-bottom: 20px;
    }

    .dm-principal-quote {
        margin: 0;
        color: #3e4b5d;
        font-size: 18px;
        line-height: 1.9;
    }

    .dm-principal-values {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 26px;
    }

    .dm-principal-value {
        min-height: 92px;
        padding: 18px 14px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 12px 30px rgba(6, 27, 54, 0.05);
        text-align: center;
    }

    .dm-principal-value i {
        display: block;
        color: var(--dm-gold);
        font-size: 22px;
        margin-bottom: 10px;
    }

    .dm-principal-value span {
        display: block;
        color: var(--dm-navy);
        font-size: 13.5px;
        line-height: 1.35;
        font-weight: 900;
    }

    /* =========================================================
       NEWS SECTION - REDESIGN + GAMBAR FULL TIDAK KEPOTONG
    ========================================================= */

    .dm-news {
        position: relative;
        overflow: hidden;
        padding: 105px 0;
        background:
            radial-gradient(circle at 10% 8%, rgba(219, 165, 45, 0.10), transparent 28%),
            radial-gradient(circle at 92% 12%, rgba(6, 27, 54, 0.06), transparent 30%),
            linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .dm-news::before,
    .dm-news::after {
        content: "";
        position: absolute;
        width: 520px;
        height: 520px;
        opacity: 0.30;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(6, 27, 54, 0.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(6, 27, 54, 0.055) 1px, transparent 1px);
        background-size: 34px 34px;
        mask-image: radial-gradient(circle, #000 0%, transparent 72%);
        -webkit-mask-image: radial-gradient(circle, #000 0%, transparent 72%);
    }

    .dm-news::before {
        left: -210px;
        top: 20px;
        transform: rotate(14deg);
    }

    .dm-news::after {
        right: -220px;
        bottom: -80px;
        transform: rotate(-12deg);
    }

    .dm-section-head {
        position: relative;
        z-index: 2;
        max-width: 820px;
        margin: 0 auto 52px;
        text-align: center;
    }

    .dm-section-head .dm-section-kicker {
        margin-inline: auto;
    }

    .dm-section-subtitle {
        max-width: 720px;
        margin: 14px auto 0;
        color: var(--dm-muted);
        font-size: 17px;
        line-height: 1.75;
    }

    .dm-news-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        align-items: stretch;
    }

    .dm-news-card {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 28px;
        background: #ffffff;
        border: 1px solid rgba(6, 27, 54, 0.08);
        box-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
        transition: 0.28s ease;
    }

    .dm-news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 70px rgba(6, 27, 54, 0.14);
        border-color: rgba(219, 165, 45, 0.32);
    }

    .dm-news-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 5px;
        background: linear-gradient(90deg, var(--dm-gold), var(--dm-gold-2));
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.28s ease;
    }

    .dm-news-card:hover::after {
        transform: scaleX(1);
    }

    .dm-news-img-link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 265px;
        padding: 16px;
        overflow: hidden;
        background:
            linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
        border-bottom: 1px solid rgba(6, 27, 54, 0.07);
    }

    .dm-news-img-link::before {
        content: "";
        position: absolute;
        inset: 16px;
        border-radius: 18px;
        border: 1px solid rgba(6, 27, 54, 0.06);
        pointer-events: none;
    }

    .dm-news-img {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        border-radius: 16px;
        transition: 0.38s ease;
    }

    .dm-news-card:hover .dm-news-img {
        transform: scale(1.025);
    }

    .dm-news-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 26px 28px 28px;
    }

    .dm-news-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--dm-gold);
        font-size: 14px;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .dm-news-title {
        margin: 0 0 12px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 25px;
        line-height: 1.22;
        font-weight: 700;
        letter-spacing: -0.4px;
    }

    .dm-news-title a {
        color: var(--dm-navy);
        transition: 0.25s ease;
    }

    .dm-news-card:hover .dm-news-title a {
        color: var(--dm-gold);
    }

    .dm-news-small-line {
        width: 54px;
        height: 2px;
        border-radius: 999px;
        background: var(--dm-gold);
        margin-bottom: 16px;
    }

    .dm-news-excerpt {
        flex: 1;
        color: var(--dm-muted);
        font-size: 15.5px;
        line-height: 1.75;
        margin: 0 0 22px;
    }

    .dm-news-link {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--dm-navy);
        font-weight: 900;
        transition: 0.25s ease;
    }

    .dm-news-link:hover {
        color: var(--dm-gold);
        gap: 14px;
    }

    .dm-view-all {
        position: relative;
        z-index: 2;
        text-align: center;
        margin-top: 46px;
    }

    .dm-empty {
        position: relative;
        z-index: 2;
        max-width: 760px;
        margin: 0 auto;
        padding: 60px 30px;
        text-align: center;
        border-radius: 24px;
        background: #ffffff;
        border: 1px dashed rgba(6, 27, 54, 0.18);
        box-shadow: 0 18px 45px rgba(6, 27, 54, 0.08);
    }

    .dm-empty i {
        font-size: 58px;
        color: rgba(6, 27, 54, 0.22);
        margin-bottom: 18px;
    }

    .dm-empty-title {
        margin: 0 0 8px;
        color: var(--dm-navy);
        font-size: 24px;
        font-weight: 900;
    }

    .dm-empty-text {
        margin: 0;
        color: var(--dm-muted);
        font-size: 16px;
    }

    /* =========================================================
       RESPONSIVE DESKTOP
    ========================================================= */

    @media (max-width: 1440px) {
        .dm-hero-inner {
            grid-template-columns: minmax(0, 0.98fr) minmax(390px, 1.02fr);
            min-height: clamp(600px, calc(100vh - 128px), 760px);
            padding-top: 50px;
            padding-bottom: 36px;
        }

        .dm-hero-title {
            font-size: clamp(46px, 5vw, 76px);
        }

        .dm-students {
            width: min(100%, 780px);
            max-height: clamp(470px, 68vh, 660px);
        }

        .dm-floating-card {
            right: 8px;
            bottom: 22px;
        }
    }

    @media (max-width: 1280px) {
        .dm-container {
            width: min(100% - 32px, 1240px);
        }

        .dm-hero-inner {
            grid-template-columns: minmax(0, 1fr) minmax(360px, 0.94fr);
            gap: 22px;
            min-height: auto;
            padding-top: 46px;
            padding-bottom: 34px;
        }

        .dm-hero-title {
            font-size: clamp(42px, 5vw, 66px);
            letter-spacing: -2px;
        }

        .dm-hero-subtitle {
            font-size: 16px;
            line-height: 1.65;
            max-width: 610px;
        }

        .dm-feature-strip {
            grid-template-columns: repeat(2, 1fr);
            max-width: 620px;
        }

        .dm-feature-item:nth-child(2)::after {
            display: none;
        }

        .dm-students {
            width: min(100%, 700px);
            max-height: clamp(430px, 62vh, 610px);
            transform: translateX(10px);
        }

        @keyframes dmFloat {
            0%, 100% {
                transform: translateX(10px) translateY(0);
            }

            50% {
                transform: translateX(10px) translateY(-10px);
            }
        }

        .dm-floating-card {
            width: min(390px, 88%);
            padding: 16px 20px;
        }

        .dm-floating-card strong {
            font-size: 19px;
        }

        .dm-floating-card span {
            font-size: 15px;
        }

        .dm-principal-grid {
            grid-template-columns: 0.95fr 1.05fr;
        }

        .dm-principal-media {
            min-height: 520px;
        }

        .dm-news-img-link {
            height: 240px;
        }
    }

    @media (max-width: 1100px) {
        .dm-hero-inner {
            grid-template-columns: 1fr;
            text-align: center;
            padding-top: 48px;
            padding-bottom: 0;
        }

        .dm-hero-content {
            max-width: 900px;
            margin-inline: auto;
        }

        .dm-badge,
        .dm-title-line,
        .dm-feature-strip {
            margin-inline: auto;
        }

        .dm-hero-subtitle {
            margin-inline: auto;
        }

        .dm-hero-actions {
            justify-content: center;
        }

        .dm-hero-visual {
            justify-content: center;
            margin-top: 16px;
        }

        .dm-students {
            width: min(92vw, 720px);
            max-height: none;
            transform: none;
            animation: none;
        }

        .dm-floating-card {
            left: 50%;
            right: auto;
            transform: translateX(-50%);
            bottom: 26px;
            width: min(430px, 90%);
            text-align: left;
        }
    }

    /* =========================================================
       FIX HERO UNTUK DESKTOP / LAPTOP PENDEK
    ========================================================= */

    @media (min-width: 1101px) and (max-height: 850px) {
        .dm-hero-inner {
            min-height: auto !important;
            grid-template-columns: minmax(0, 0.96fr) minmax(390px, 1.04fr) !important;
            align-items: end !important;
            padding-top: 34px !important;
            padding-bottom: 22px !important;
            gap: 22px !important;
        }

        .dm-badge {
            margin-bottom: 18px !important;
            padding: 10px 16px !important;
            font-size: 14px !important;
        }

        .dm-hero-title {
            font-size: clamp(42px, 4.45vw, 68px) !important;
            line-height: 0.96 !important;
            letter-spacing: -2px !important;
        }

        .dm-title-line {
            margin: 18px 0 16px !important;
            width: 245px !important;
        }

        .dm-hero-subtitle {
            max-width: 640px !important;
            margin-bottom: 20px !important;
            font-size: 15.5px !important;
            line-height: 1.55 !important;
        }

        .dm-hero-actions {
            margin-bottom: 20px !important;
            gap: 14px !important;
        }

        .dm-btn {
            min-height: 50px !important;
            padding: 0 26px !important;
            font-size: 15px !important;
        }

        .dm-feature-strip {
            max-width: 720px !important;
            grid-template-columns: repeat(4, 1fr) !important;
            border-radius: 16px !important;
        }

        .dm-feature-item {
            padding: 14px 14px !important;
            grid-template-columns: 34px 1fr !important;
            gap: 9px !important;
        }

        .dm-feature-icon {
            width: 32px !important;
            height: 32px !important;
            font-size: 20px !important;
        }

        .dm-feature-title {
            font-size: 13px !important;
            line-height: 1.15 !important;
        }

        .dm-feature-text {
            font-size: 11px !important;
            line-height: 1.2 !important;
        }

        .dm-students {
            width: min(100%, 690px) !important;
            max-height: 520px !important;
            transform: translateX(8px) !important;
            animation: none !important;
        }

        .dm-floating-card {
            right: 8px !important;
            bottom: 18px !important;
            width: min(360px, 82%) !important;
            padding: 14px 18px !important;
            gap: 14px !important;
        }

        .dm-floating-card i {
            font-size: 34px !important;
        }

        .dm-floating-card strong {
            font-size: 18px !important;
            margin-bottom: 3px !important;
        }

        .dm-floating-card span {
            font-size: 14px !important;
        }
    }

    @media (min-width: 1101px) and (max-height: 740px) {
        .dm-hero-inner {
            padding-top: 26px !important;
            padding-bottom: 18px !important;
        }

        .dm-badge {
            margin-bottom: 14px !important;
        }

        .dm-hero-title {
            font-size: clamp(38px, 4vw, 60px) !important;
        }

        .dm-title-line {
            margin: 14px 0 13px !important;
        }

        .dm-hero-subtitle {
            margin-bottom: 16px !important;
            font-size: 14.5px !important;
            line-height: 1.45 !important;
        }

        .dm-hero-actions {
            margin-bottom: 16px !important;
        }

        .dm-feature-item {
            padding: 12px 12px !important;
        }

        .dm-students {
            max-height: 455px !important;
        }

        .dm-floating-card {
            bottom: 14px !important;
        }
    }

    /* =========================================================
       TABLET & MOBILE
    ========================================================= */

    @media (max-width: 992px) {
        .dm-hero {
            background:
                linear-gradient(
                    180deg,
                    rgba(3, 18, 38, 0.98) 0%,
                    rgba(6, 27, 54, 0.91) 52%,
                    rgba(6, 27, 54, 0.64) 100%
                ),
                url('{{ asset('images/gedung-sekolah.jpg') }}') center / cover no-repeat;
        }

        .dm-stats-grid,
        .dm-news-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dm-principal-grid {
            grid-template-columns: 1fr;
        }

        .dm-principal-media {
            min-height: auto;
            padding: 32px 24px 84px;
        }

        .dm-principal-photo-shell {
            max-width: 420px;
            margin-inline: auto;
        }

        .dm-principal-content {
            text-align: center;
        }

        .dm-principal-content .dm-section-kicker {
            margin-inline: auto;
        }

        .dm-principal-quote {
            text-align: left;
        }

        .dm-principal-values {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dm-container {
            width: min(100% - 24px, 1500px);
        }

        .dm-hero-inner {
            padding-top: 42px;
        }

        .dm-badge {
            font-size: 13px;
            padding: 10px 14px;
            line-height: 1.35;
        }

        .dm-hero-title {
            font-size: clamp(38px, 12vw, 58px);
            line-height: 1.02;
            letter-spacing: -1.3px;
        }

        .dm-title-line {
            width: 210px;
        }

        .dm-hero-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .dm-btn {
            width: 100%;
        }

        .dm-feature-strip {
            grid-template-columns: 1fr;
        }

        .dm-feature-item {
            grid-template-columns: 42px 1fr;
            padding: 18px 20px;
            text-align: left;
        }

        .dm-feature-item::after {
            display: none !important;
        }

        .dm-hero-visual {
            margin-top: 14px;
        }

        .dm-students {
            width: min(108vw, 560px);
        }

        .dm-floating-card {
            width: calc(100% - 24px);
            padding: 15px 18px;
            gap: 14px;
            bottom: 18px;
        }

        .dm-floating-card i {
            font-size: 34px;
        }

        .dm-floating-card strong {
            font-size: 18px;
        }

        .dm-floating-card span {
            font-size: 14px;
        }

        .dm-stats,
        .dm-principal,
        .dm-news {
            padding: 64px 0;
        }

        .dm-stats-grid,
        .dm-news-grid {
            grid-template-columns: 1fr;
        }

        .dm-stat-card {
            min-height: auto;
        }

        .dm-section-title {
            font-size: 34px;
        }

        .dm-news-img-link {
            height: 230px;
            padding: 14px;
        }

        .dm-news-title {
            font-size: 24px;
        }

        .dm-principal-panel {
            border-radius: 26px;
        }

        .dm-principal-mini-card {
            left: 18px;
            right: 18px;
            bottom: 18px;
        }

        .dm-principal-quote-box {
            padding: 28px 22px;
        }
    }

    @media (max-width: 420px) {
        .dm-hero-title {
            font-size: 37px;
        }

        .dm-hero-subtitle {
            font-size: 15px;
        }

        .dm-students {
            width: 118vw;
        }

        .dm-news-img-link {
            height: 205px;
        }
    }
</style>
@endpush

@section('content')

    {{-- HERO SECTION --}}
    <section class="dm-hero">
        <div class="dm-container">
            <div class="dm-hero-inner">

                <div class="dm-hero-content">
                    <div class="dm-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Sekolah Islam Terpercaya & Berprestasi</span>
                    </div>

                    <h1 class="dm-hero-title">
                        Iman, Ilmu, dan
                        <span class="gold">Akhlak</span> untuk
                        Membentuk Generasi Emas
                    </h1>

                    <div class="dm-title-line"></div>

                    <p class="dm-hero-subtitle">
                        Membangun generasi unggul melalui pendidikan berkualitas yang
                        mengintegrasikan nilai-nilai islami dengan pembelajaran modern
                        untuk masa depan yang gemilang.
                    </p>

                    <div class="dm-hero-actions">
                        <a href="{{ route('admission.index') }}" class="dm-btn dm-btn-primary">
                            <i class="far fa-user"></i>
                            <span>Daftar Sekarang</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <a href="{{ route('profile.vision-mission') }}" class="dm-btn dm-btn-outline">
                            <i class="fas fa-university"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </div>

                    <div class="dm-feature-strip">
                        <div class="dm-feature-item">
                            <div class="dm-feature-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <span class="dm-feature-title">Pendidikan Berkualitas</span>
                                <span class="dm-feature-text">Kurikulum Terintegrasi</span>
                            </div>
                        </div>

                        <div class="dm-feature-item">
                            <div class="dm-feature-icon">
                                <i class="far fa-star"></i>
                            </div>
                            <div>
                                <span class="dm-feature-title">Nilai Islami Kuat</span>
                                <span class="dm-feature-text">Akhlak Mulia</span>
                            </div>
                        </div>

                        <div class="dm-feature-item">
                            <div class="dm-feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <span class="dm-feature-title">Generasi Berprestasi</span>
                                <span class="dm-feature-text">Berkarakter Unggul</span>
                            </div>
                        </div>

                        <div class="dm-feature-item">
                            <div class="dm-feature-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div>
                                <span class="dm-feature-title">Prestasi & Kompetisi</span>
                                <span class="dm-feature-text">Tingkat Nasional</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dm-hero-visual">
                    <img src="{{ asset('images/siswasiswi.png') }}"
                         alt="Siswa SMP Darul Mustofa"
                         class="dm-students">

                    <div class="dm-floating-card">
                        <i class="fas fa-book-reader"></i>
                        <div>
                            <strong>Iman • Ilmu • Akhlak</strong>
                            <span>Kunci Masa Depan Gemilang</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- STATISTICS SECTION --}}
    <section class="dm-stats">
        <div class="dm-container">
            <div class="dm-stats-grid">

                <div class="dm-stat-card">
                    <div class="dm-stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="dm-stat-number counter" data-target="{{ $studentCount ?? 0 }}">0</div>
                    <p class="dm-stat-label">Siswa Aktif</p>
                </div>

                <div class="dm-stat-card">
                    <div class="dm-stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="dm-stat-number counter" data-target="{{ $teacherCount ?? 0 }}">0</div>
                    <p class="dm-stat-label">Tenaga Pendidik</p>
                </div>

                <div class="dm-stat-card">
                    <div class="dm-stat-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <div class="dm-stat-number counter" data-target="{{ $extracurricularCount ?? 0 }}">0</div>
                    <p class="dm-stat-label">Ekstrakurikuler</p>
                </div>

                <div class="dm-stat-card">
                    <div class="dm-stat-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="dm-stat-number counter" data-target="98">0%</div>
                    <p class="dm-stat-label">Tingkat Kelulusan</p>
                </div>

            </div>
        </div>
    </section>

    {{-- PRINCIPAL MESSAGE SECTION --}}
    <section class="dm-principal">
        <div class="dm-container">
            <div class="dm-principal-panel">
                <div class="dm-principal-grid">

                    <div class="dm-principal-media">
                        <div class="dm-principal-photo-shell">
                            <img src="{{ asset('images/kepalasekolah.jpg') }}"
                                 alt="Kepala Sekolah SMP Darul Mustofa"
                                 class="dm-principal-photo">

                            <div class="dm-principal-mini-card">
                                <p class="dm-principal-mini-name">WIWIN WIDIYA WATI, S.Pd</p>
                                <p class="dm-principal-mini-role">Kepala Sekolah SMP Darul Mustofa</p>
                            </div>
                        </div>
                    </div>

                    <div class="dm-principal-content">
                        <div class="dm-section-kicker">
                            <i class="fas fa-quote-left"></i>
                            Sambutan Kepala Sekolah
                        </div>

                        <h2 class="dm-section-title">
                            Visi Kepemimpinan untuk Pendidikan Berkualitas
                        </h2>

                        <div class="dm-principal-quote-box">
                            <div class="dm-principal-quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>

                            <p class="dm-principal-quote">
                                Mewujudkan generasi berkarakter unggul, melek teknologi,
                                mandiri, dan berwawasan global, yang dilandasi nilai-nilai
                                luhur dan lingkungan, untuk siap menghadapi tantangan masa depan.
                            </p>
                        </div>

                        <div class="dm-principal-values">
                            <div class="dm-principal-value">
                                <i class="fas fa-book-open"></i>
                                <span>Pendidikan Bermutu</span>
                            </div>

                            <div class="dm-principal-value">
                                <i class="fas fa-mosque"></i>
                                <span>Akhlak Islami</span>
                            </div>

                            <div class="dm-principal-value">
                                <i class="fas fa-award"></i>
                                <span>Prestasi Unggul</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- NEWS SECTION --}}
    <section class="dm-news">
        <div class="dm-container">
            <div class="dm-section-head">
                <div class="dm-section-kicker">
                    <i class="far fa-newspaper"></i>
                    Berita & Informasi
                </div>

                <h2 class="dm-section-title dark">
                    Kabar Terbaru dari Sekolah
                </h2>

                <p class="dm-section-subtitle">
                    Ikuti perkembangan kegiatan, prestasi, dan informasi terkini
                    dari SMP Darul Mustofa.
                </p>
            </div>

            @if($latestPosts->count() > 0)
                <div class="dm-news-grid">
                    @foreach ($latestPosts as $post)
                        <article class="dm-news-card">
                            <a href="{{ route('posts.show', $post->slug) }}" class="dm-news-img-link">
                                <img src="{{ $post->featured_image_path ? asset('storage/' . $post->featured_image_path) : 'https://placehold.co/600x400/e5e7eb/061b36?text=SMP+Darul+Mustofa' }}"
                                     alt="{{ $post->title }}"
                                     class="dm-news-img">
                            </a>

                            <div class="dm-news-body">
                                <time class="dm-news-date">
                                    <i class="far fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </time>

                                <h3 class="dm-news-title">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <div class="dm-news-small-line"></div>

                                <p class="dm-news-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <a href="{{ route('posts.show', $post->slug) }}" class="dm-news-link">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="dm-view-all">
                    <a href="{{ route('posts.index') }}" class="dm-btn dm-btn-primary">
                        Lihat Semua Berita
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="dm-empty">
                    <i class="far fa-newspaper"></i>
                    <p class="dm-empty-title">Belum Ada Berita</p>
                    <p class="dm-empty-text">Informasi terbaru akan segera hadir di sini.</p>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll('.counter');

        const animateCounter = (counter) => {
            const target = Number(counter.getAttribute('data-target')) || 0;
            const isPercent = counter.textContent.includes('%');
            const duration = 1200;
            const startTime = performance.now();

            const update = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const value = Math.floor(progress * target);

                counter.textContent = value + (isPercent ? '%' : '');

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target + (isPercent ? '%' : '');
                }
            };

            requestAnimationFrame(update);
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.35
        });

        counters.forEach(counter => observer.observe(counter));
    });
</script>
@endpush