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
       HERO SECTION
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
       PRINCIPAL SECTION
    ========================================================= */

    .dm-principal {
        padding: 95px 0;
        background:
            linear-gradient(135deg, rgba(6, 27, 54, 0.96), rgba(9, 40, 77, 0.94)),
            url('{{ asset('images/gedung-sekolah.jpg') }}') center / cover fixed;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .dm-principal::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 12% 18%, rgba(219, 165, 45, 0.18), transparent 32%),
            radial-gradient(circle at 88% 72%, rgba(255, 255, 255, 0.08), transparent 30%);
    }

    .dm-principal-grid {
        position: relative;
        display: grid;
        grid-template-columns: 0.82fr 1.18fr;
        gap: 58px;
        align-items: center;
    }

    .dm-principal-photo-wrap {
        position: relative;
    }

    .dm-principal-photo-wrap::before {
        content: "";
        position: absolute;
        inset: 24px -20px -20px 24px;
        border-radius: 24px;
        border: 1px solid rgba(219, 165, 45, 0.65);
    }

    .dm-principal-photo {
        position: relative;
        width: 100%;
        display: block;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.24);
        box-shadow: 0 28px 70px rgba(0, 0, 0, 0.32);
        object-fit: cover;
    }

    .dm-section-kicker {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 999px;
        color: var(--dm-gold-2);
        background: rgba(219, 165, 45, 0.12);
        border: 1px solid rgba(219, 165, 45, 0.30);
        font-weight: 800;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 18px;
    }

    .dm-section-title {
        margin: 0 0 18px;
        font-size: clamp(30px, 3.3vw, 52px);
        line-height: 1.12;
        font-weight: 900;
        letter-spacing: -1.2px;
    }

    .dm-section-title.dark {
        color: var(--dm-navy);
    }

    .dm-principal-quote {
        position: relative;
        margin: 26px 0 28px;
        padding: 26px 28px;
        border-left: 4px solid var(--dm-gold);
        border-radius: 0 18px 18px 0;
        background: rgba(255, 255, 255, 0.08);
        color: rgba(255, 255, 255, 0.88);
        font-size: 18px;
        line-height: 1.85;
        backdrop-filter: blur(14px);
    }

    .dm-principal-info {
        display: inline-block;
        padding: 18px 24px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.16);
        backdrop-filter: blur(14px);
    }

    .dm-principal-name {
        margin: 0 0 5px;
        color: #ffffff;
        font-size: 20px;
        font-weight: 900;
    }

    .dm-principal-role {
        margin: 0;
        color: rgba(255, 255, 255, 0.68);
        font-size: 15px;
    }

    /* =========================================================
       NEWS SECTION
    ========================================================= */

    .dm-news {
        padding: 95px 0;
        background: #ffffff;
    }

    .dm-section-head {
        max-width: 800px;
        margin: 0 auto 48px;
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
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .dm-news-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 24px;
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

    .dm-news-img-link {
        display: block;
        height: 250px;
        overflow: hidden;
        background: #eef2f7;
    }

    .dm-news-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.48s ease;
    }

    .dm-news-card:hover .dm-news-img {
        transform: scale(1.08);
    }

    .dm-news-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 26px;
    }

    .dm-news-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--dm-gold);
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .dm-news-title {
        margin: 0 0 12px;
        font-size: 22px;
        line-height: 1.35;
        font-weight: 900;
        letter-spacing: -0.3px;
    }

    .dm-news-title a {
        color: var(--dm-navy);
        transition: 0.25s ease;
    }

    .dm-news-card:hover .dm-news-title a {
        color: var(--dm-gold);
    }

    .dm-news-excerpt {
        flex: 1;
        color: var(--dm-muted);
        font-size: 15.5px;
        line-height: 1.75;
        margin: 0 0 22px;
    }

    .dm-news-link {
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
        text-align: center;
        margin-top: 46px;
    }

    .dm-empty {
        max-width: 760px;
        margin: 0 auto;
        padding: 60px 30px;
        text-align: center;
        border-radius: 24px;
        background: var(--dm-soft);
        border: 1px dashed rgba(6, 27, 54, 0.18);
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
       Agar hero tidak kepotong di layar MacBook / laptop
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

        .dm-principal-photo-wrap {
            max-width: 520px;
            margin-inline: auto;
        }

        .dm-principal-content {
            text-align: center;
        }

        .dm-principal-quote {
            text-align: left;
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
            font-size: 32px;
        }

        .dm-news-img-link {
            height: 220px;
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
            <div class="dm-principal-grid">

                <div class="dm-principal-photo-wrap">
                    <img src="{{ asset('images/kepalasekolah.jpg') }}"
                         alt="Kepala Sekolah SMP Darul Mustofa"
                         class="dm-principal-photo">
                </div>

                <div class="dm-principal-content">
                    <div class="dm-section-kicker">
                        <i class="fas fa-quote-left"></i>
                        Sambutan Kepala Sekolah
                    </div>

                    <h2 class="dm-section-title">
                        Visi Kepemimpinan untuk Pendidikan Berkualitas
                    </h2>

                    <p class="dm-principal-quote">
                        Mewujudkan generasi berkarakter unggul, melek teknologi,
                        mandiri, dan berwawasan global, yang dilandasi nilai-nilai
                        luhur dan lingkungan, untuk siap menghadapi tantangan masa depan.
                    </p>

                    <div class="dm-principal-info">
                        <p class="dm-principal-name">WIWIN WIDIYA WATI, S.Pd</p>
                        <p class="dm-principal-role">Kepala Sekolah SMP Darul Mustofa</p>
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