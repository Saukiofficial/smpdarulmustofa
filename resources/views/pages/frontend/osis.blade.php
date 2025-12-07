
@extends('layouts.frontend')

@section('title', 'Pengurus OSIS')

@push('styles')
<style>
    /* Luxury Background Gradient */
    .luxury-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        position: relative;
        overflow: hidden;
    }

    .luxury-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="25" r="1" fill="white" opacity="0.03"/><circle cx="25" cy="75" r="1" fill="white" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(1deg); }
    }

    /* Glassmorphism Cards */
    .osis-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        padding: 2rem;
        text-align: center;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        min-width: 280px;
    }

    .osis-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .osis-card:hover::before {
        left: 100%;
    }

    .osis-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow:
            0 35px 70px -12px rgba(0, 0, 0, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.2);
    }

    /* Premium Photo Styling */
    .premium-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        position: relative;
    }

    .osis-card:hover .premium-photo {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow:
            0 25px 50px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Typography */
    .position-title {
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .member-name {
        font-weight: 600;
        color: white;
        font-size: 1.25rem;
        margin-bottom: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        line-height: 1.3;
    }

    /* Luxury Connectors */
    .line-connector {
        width: 3px;
        background: linear-gradient(to bottom,
            rgba(255, 255, 255, 0),
            rgba(255, 255, 255, 0.6),
            rgba(255, 255, 255, 0)
        );
        position: relative;
    }

    .line-connector::before,
    .line-connector::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .line-connector::before { top: -6px; }
    .line-connector::after { bottom: -6px; }

    /* Header Styling */
    .main-title {
        background: linear-gradient(135deg, #ffffff, #f8fafc, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 3.5rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 1rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
        font-weight: 400;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: 1px;
    }

    /* Coordinator Section */
    .coordinator-card {
        background: linear-gradient(135deg, #1e3a8a, #3730a3, #7c3aed);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 2rem 3rem;
        border-radius: 24px;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .coordinator-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { transform: rotate(0deg) scale(1); opacity: 0.5; }
        50% { transform: rotate(180deg) scale(1.1); opacity: 0.8; }
    }

    .coordinator-title {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        position: relative;
        z-index: 1;
    }

    /* Responsive Grid */
    .sekbid-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        justify-items: center;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.5rem;
        }

        .osis-card {
            min-width: 260px;
            padding: 1.5rem;
        }

        .premium-photo {
            width: 100px;
            height: 100px;
        }

        .sekbid-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .main-title {
            font-size: 2rem;
        }

        .osis-card {
            min-width: 240px;
            padding: 1.25rem;
        }

        .coordinator-card {
            padding: 1.5rem 2rem;
        }

        .coordinator-title {
            font-size: 1.2rem;
            letter-spacing: 2px;
        }
    }
</style>
@endpush

@section('content')
<div class="luxury-bg py-32">
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="main-title">Struktur Kepengurusan OSIS</h1>
        <p class="subtitle max-w-2xl mx-auto">Masa Bakti 2025/2026</p>

        <div class="mt-20 flex flex-col items-center">
            <!-- Ketua & Wakil -->
            <div class="flex flex-wrap justify-center gap-8 mb-8">
                @foreach($osisMembers->where('position', 'Ketua OSIS') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
                @foreach($osisMembers->where('position', 'Wakil Ketua OSIS') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
            </div>

            <div class="h-16 line-connector mb-8"></div>

            <!-- Sekretaris & Bendahara -->
            <div class="flex flex-wrap justify-center gap-8 mb-8">
                @foreach($osisMembers->where('position', 'Sekretaris') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
                @foreach($osisMembers->where('position', 'Wakil Sekretaris') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
                @foreach($osisMembers->where('position', 'Bendahara') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
                @foreach($osisMembers->where('position', 'Wakil Bendahara') as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
            </div>
            <div class="h-16 line-connector mb-8"></div>

            <!-- Koordinator Seksi Bidang -->
            <div class="coordinator-card mb-8">
                <h3 class="coordinator-title">KOORDINATOR SEKSI BIDANG</h3>
            </div>

            <div class="h-16 line-connector mb-8"></div>

            <!-- Seksi Bidang -->
            <div class="sekbid-grid w-full">
                @foreach($osisMembers->filter(fn($m) => str_starts_with($m->position, 'Sekbid')) as $member)
                <div class="osis-card">
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="premium-photo">
                    <h3 class="position-title">{{ $member->position }}</h3>
                    <p class="member-name">{{ $member->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
