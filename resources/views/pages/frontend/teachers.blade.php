@extends('layouts.frontend')
@section('title', 'Dewan Guru')

@push('styles')
<style>
    /* Luxury Background with Dynamic Patterns */
    .teachers-luxury-bg {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 35%, #db2777 70%, #f59e0b 100%);
        position: relative;
        overflow: hidden;
        min-height: 100vh;
    }

    .teachers-luxury-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 0%, transparent 50%),
            radial-gradient(circle at 75% 25%, rgba(255,255,255,0.03) 0%, transparent 50%),
            radial-gradient(circle at 25% 75%, rgba(255,255,255,0.08) 0%, transparent 50%);
        animation: backgroundShift 15s ease-in-out infinite;
    }

    @keyframes backgroundShift {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(-10px, -10px) scale(1.02); }
        66% { transform: translate(10px, -5px) scale(0.98); }
    }

    /* Premium Teacher Cards */
    .teacher-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 28px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow:
            0 32px 64px -12px rgba(0, 0, 0, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            inset 0 -1px 0 rgba(0, 0, 0, 0.1);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        transform-style: preserve-3d;
    }

    /* Card Hover Effects */
    .teacher-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg,
            rgba(255, 255, 255, 0.3),
            rgba(255, 255, 255, 0.1),
            rgba(255, 255, 255, 0.3)
        );
        border-radius: 28px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .teacher-card:hover::before {
        opacity: 1;
    }

    .teacher-card:hover {
        transform: translateY(-12px) rotateX(5deg) rotateY(2deg);
        box-shadow:
            0 40px 80px -12px rgba(0, 0, 0, 0.5),
            0 0 0 1px rgba(255, 255, 255, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.18);
    }

    /* Shimmer Effect on Hover */
    .teacher-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        transition: left 0.7s ease;
    }

    .teacher-card:hover::after {
        left: 100%;
    }

    /* Premium Photo Styling */
    .teacher-photo {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 0 auto 2rem;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow:
            0 25px 50px rgba(0, 0, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            0 0 0 8px rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .teacher-card:hover .teacher-photo {
        transform: scale(1.08);
        border-color: rgba(255, 255, 255, 0.6);
        box-shadow:
            0 35px 70px rgba(0, 0, 0, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.3),
            0 0 0 8px rgba(255, 255, 255, 0.15);
    }

    /* Fallback Avatar Styling */
    .teacher-avatar-fallback {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 0 auto 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.2),
            rgba(255, 255, 255, 0.1)
        );
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow:
            0 25px 50px rgba(0, 0, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .teacher-card:hover .teacher-avatar-fallback {
        transform: scale(1.08);
        border-color: rgba(255, 255, 255, 0.6);
        background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.3),
            rgba(255, 255, 255, 0.15)
        );
    }

    /* Typography */
    .teacher-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.75rem;
        text-shadow: 0 3px 6px rgba(0, 0, 0, 0.4);
        line-height: 1.3;
        position: relative;
    }

    .teacher-subject {
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.85);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: inline-block;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .teacher-card:hover .teacher-subject {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px);
    }

    /* Header Styling */
    .main-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
        z-index: 10;
    }

    .main-title {
        background: linear-gradient(135deg, #ffffff, #f8fafc, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 1rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        line-height: 1.1;
        position: relative;
    }

    .main-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 4px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
        border-radius: 2px;
    }

    .subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 300;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        letter-spacing: 0.5px;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Grid Layout */
    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        padding: 2rem 0;
        position: relative;
        z-index: 10;
    }

    /* Empty State Styling */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Loading Animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .teacher-card.loading {
        animation: pulse 2s infinite;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.8rem;
        }

        .teachers-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 1.5rem 0;
        }

        .teacher-card {
            padding: 2rem 1.5rem;
        }

        .teacher-photo,
        .teacher-avatar-fallback {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 480px) {
        .main-title {
            font-size: 2.2rem;
        }

        .subtitle {
            font-size: 1.1rem;
        }

        .teacher-card {
            padding: 1.5rem 1rem;
        }

        .teacher-photo,
        .teacher-avatar-fallback {
            width: 100px;
            height: 100px;
            margin-bottom: 1.5rem;
        }

        .teacher-name {
            font-size: 1.2rem;
        }

        .teacher-subject {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
        }
    }

    /* Special Effects for High-End Browsers */
    @supports (backdrop-filter: blur(25px)) {
        .teacher-card {
            backdrop-filter: blur(25px);
        }
    }

    @supports not (backdrop-filter: blur(25px)) {
        .teacher-card {
            background: rgba(255, 255, 255, 0.2);
        }
    }
</style>
@endpush

@section('content')
<div class="teachers-luxury-bg py-32">
    <div class="container mx-auto px-6 relative z-10">
        <div class="main-header">
            <h1 class="main-title">Dewan Guru SMP Darul Mustofa</h1>
            <p class="subtitle">Para pendidik profesional dan berdedikasi kami yang membimbing masa depan bangsa</p>
        </div>

        <div class="teachers-grid">
            @forelse ($teachers as $teacher)
            <div class="teacher-card">
                @if($teacher->user->profile_photo_path)
                    <img src="{{ asset('storage/' . $teacher->user->profile_photo_path) }}"
                         alt="Foto {{ $teacher->user->name }}"
                         class="teacher-photo">
                @else
                    <div class="teacher-avatar-fallback">
                        {{ substr($teacher->user->name, 0, 1) }}
                    </div>
                @endif

                <h3 class="teacher-name">{{ $teacher->user->name }}</h3>
                <div class="teacher-subject">{{ $teacher->mapel }}</div>
            </div>
            @empty
            <div class="empty-state">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <p>Data guru sedang dalam proses pembaruan.</p>
                <p class="text-sm mt-2 opacity-75">Silakan kembali lagi nanti untuk melihat informasi terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
