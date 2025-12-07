@extends('layouts.frontend')

@section('title', 'Struktur Organisasi')

@push('styles')
<style>
    /* Import Premium Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        --gradient-secondary: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
        --gradient-text: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-premium: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --shadow-glow: 0 0 40px rgba(102, 126, 234, 0.3);
    }

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Animated Background with Particles */
    .premium-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--gradient-primary);
        z-index: -2;
        overflow: hidden;
    }

    .premium-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(120, 219, 226, 0.3) 0%, transparent 50%);
        animation: backgroundShift 20s ease-in-out infinite;
    }

    @keyframes backgroundShift {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.1) rotate(1deg); }
    }

    /* Particle Animation */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: float 15s infinite linear;
    }

    .particle:nth-child(odd) {
        animation-delay: -7s;
        animation-duration: 20s;
    }

    @keyframes float {
        0% {
            transform: translateY(100vh) translateX(0px) scale(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(100px) scale(1);
            opacity: 0;
        }
    }

    /* Container Styling */
    .org-container {
        position: relative;
        min-height: 100vh;
        backdrop-filter: blur(0px);
        padding: 2rem 0;
    }

    /* Premium Typography */
    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        line-height: 1.1;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
        text-shadow: 0 0 40px rgba(255, 255, 255, 0.5);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        max-width: 600px;
        margin: 0 auto 4rem;
        line-height: 1.6;
    }

    /* Premium Glassmorphism Cards */
    .org-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 2rem;
        text-align: center;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: var(--shadow-premium);
        min-width: 220px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0);
        cursor: pointer;
    }

    .org-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    /* Premium Hover Effects */
    .org-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow:
            var(--shadow-premium),
            var(--shadow-glow),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.15);
    }

    .org-card:hover::before {
        opacity: 1;
    }

    .org-card:hover .org-avatar {
        transform: scale(1.05);
        box-shadow: 0 0 30px rgba(102, 126, 234, 0.4);
    }

    .org-card:hover .org-name {
        background: var(--gradient-text);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Avatar Styling */
    .org-avatar {
        width: 5rem;
        height: 5rem;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 1;
    }

    .org-avatar::before {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 50%;
        background: var(--gradient-secondary);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .org-card:hover .org-avatar::before {
        opacity: 1;
    }

    /* Text Styling */
    .org-position {
        font-size: 0.75rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .org-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        transition: all 0.4s ease;
        line-height: 1.4;
    }

    /* Connection Lines */
    .connector-line {
        width: 2px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
        border-radius: 1px;
        position: relative;
    }

    .connector-line::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.4; transform: translate(-50%, -50%) scale(1); }
        50% { opacity: 1; transform: translate(-50%, -50%) scale(1.2); }
    }

    /* Layout Improvements */
    .org-level {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
        gap: 2rem;
        margin: 2rem 0;
    }

    .org-level-single {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
    }

    .org-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
    }

    /* Loading Animation */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .org-card {
        animation: slideUp 0.6s ease-out forwards;
    }

    .org-card:nth-child(1) { animation-delay: 0.1s; }
    .org-card:nth-child(2) { animation-delay: 0.2s; }
    .org-card:nth-child(3) { animation-delay: 0.3s; }
    .org-card:nth-child(4) { animation-delay: 0.4s; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .org-container {
            padding: 1rem;
        }

        .org-card {
            min-width: 180px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .org-level {
            gap: 1rem;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            margin-bottom: 3rem;
        }
    }

    @media (max-width: 480px) {
        .org-card {
            min-width: 160px;
            padding: 1.25rem;
        }

        .org-avatar {
            width: 4rem;
            height: 4rem;
        }

        .hero-title {
            font-size: 2rem;
        }
    }

    /* Scroll Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(60px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-on-scroll {
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }
</style>
@endpush

@section('content')
<!-- Premium Background -->
<div class="premium-background"></div>

<!-- Animated Particles -->
<div class="particles">
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 16s;"></div>
</div>

<div class="org-container">
    <div class="container mx-auto px-6">
        <!-- Premium Hero Section -->
        <div class="text-center mb-16">
            <h1 class="hero-title">Struktur Organisasi Sekolah</h1>
            <p class="hero-subtitle">Hirarki kepemimpinan yang membangun masa depan pendidikan dengan visi dan misi yang jelas</p>
        </div>

        <div class="flex flex-col items-center">
            <!-- Kepala Sekolah -->
            @if(isset($organization['KEPALA SEKOLAH']))
                <div class="org-level-single animate-on-scroll">
                    @foreach($organization['KEPALA SEKOLAH'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Connection Line -->
            <div class="h-16 connector-line"></div>

            <!-- Second Level: Komite, Tata Usaha, Wakil Kepala -->
            <div class="org-level animate-on-scroll">
                <!-- Komite Sekolah -->
                @if(isset($organization['KOMITE SEKOLAH']))
                    @foreach($organization['KOMITE SEKOLAH'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                @endif

                <!-- Kepala Tata Usaha & Staf -->
                <div class="org-group">
                    @if(isset($organization['KEPALA TATA USAHA']))
                        @foreach($organization['KEPALA TATA USAHA'] as $member)
                        <div class="org-card">
                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                            <h3 class="org-position">{{ $member->position }}</h3>
                            <p class="org-name">{{ $member->name }}</p>
                        </div>
                        @endforeach
                    @endif
                    @if(isset($organization['STAF TATA USAHA']))
                        @foreach($organization['STAF TATA USAHA'] as $member)
                        <div class="org-card">
                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                            <h3 class="org-position">{{ $member->position }}</h3>
                            <p class="org-name">{{ $member->name }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>

                <!-- Wakil Kepala Sekolah -->
                @if(isset($organization['WAKIL KEPALA SEKOLAH']))
                    @foreach($organization['WAKIL KEPALA SEKOLAH'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Connection Line -->
            <div class="h-16 connector-line"></div>

            <!-- Third Level: WAKA -->
            <div class="org-level animate-on-scroll">
                @if(isset($organization['WAKA KURIKULUM']))
                    @foreach($organization['WAKA KURIKULUM'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                @endif

                @if(isset($organization['WAKA KESISWAAN']))
                    @foreach($organization['WAKA KESISWAAN'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                @endif

                @if(isset($organization['WAKA SARPRAS']))
                    @foreach($organization['WAKA SARPRAS'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Connection Line -->
            <div class="h-16 connector-line"></div>

            <!-- Fourth Level: WAKA HUMAS -->
            @if(isset($organization['WAKA HUMAS']))
                <div class="org-level-single animate-on-scroll">
                    @foreach($organization['WAKA HUMAS'] as $member)
                    <div class="org-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->name }}" class="org-avatar">
                        <h3 class="org-position">{{ $member->position }}</h3>
                        <p class="org-name">{{ $member->name }}</p>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll Animation Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Create additional particles dynamically
    const particlesContainer = document.querySelector('.particles');
    for (let i = 0; i < 20; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 20 + 's';
        particle.style.animationDuration = (15 + Math.random() * 10) + 's';
        particlesContainer.appendChild(particle);
    }
});
</script>
@endsection
