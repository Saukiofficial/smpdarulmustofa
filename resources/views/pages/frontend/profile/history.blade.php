@extends('layouts.frontend')

@section('title', 'Sejarah Sekolah')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .premium-bg {
        background: linear-gradient(-45deg, #1e293b, #334155, #475569, #64748b);
        background-size: 400% 400%;
        animation: gradientShift 18s ease infinite;
        position: relative;
        overflow: hidden;
    }

    .premium-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 50%, rgba(236, 72, 153, 0.1) 100%);
        animation: overlayShift 12s ease infinite alternate;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes overlayShift {
        0% { opacity: 0.3; }
        100% { opacity: 0.7; }
    }

    .timeline-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .timeline-particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        animation: timelineFloat 25s infinite linear;
    }

    .timeline-particle:nth-child(1) { width: 3px; height: 3px; left: 15%; animation-delay: 0s; }
    .timeline-particle:nth-child(2) { width: 5px; height: 5px; left: 25%; animation-delay: 3s; }
    .timeline-particle:nth-child(3) { width: 4px; height: 4px; left: 35%; animation-delay: 6s; }
    .timeline-particle:nth-child(4) { width: 6px; height: 6px; left: 45%; animation-delay: 9s; }
    .timeline-particle:nth-child(5) { width: 3px; height: 3px; left: 55%; animation-delay: 12s; }
    .timeline-particle:nth-child(6) { width: 7px; height: 7px; left: 65%; animation-delay: 15s; }
    .timeline-particle:nth-child(7) { width: 4px; height: 4px; left: 75%; animation-delay: 18s; }
    .timeline-particle:nth-child(8) { width: 5px; height: 5px; left: 85%; animation-delay: 21s; }

    @keyframes timelineFloat {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 32px;
        box-shadow:
            0 16px 40px rgba(0, 0, 0, 0.15),
            0 4px 20px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .glass-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.8), transparent);
        animation: scanLine 3s ease-in-out infinite;
    }

    @keyframes scanLine {
        0%, 100% { left: -100%; }
        50% { left: 100%; }
    }

    .image-container {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .image-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), transparent, rgba(236, 72, 153, 0.1));
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .image-container:hover::after {
        opacity: 1;
    }

    .image-container:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.2),
            0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .school-image {
        width: 100%;
        height: auto;
        display: block;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        filter: brightness(1.1) contrast(1.1) saturate(1.2);
    }

    .image-container:hover .school-image {
        transform: scale(1.05);
        filter: brightness(1.2) contrast(1.2) saturate(1.3);
    }

    .gradient-title {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 30%, #e2e8f0 60%, #cbd5e1 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 300% 300%;
        animation: gradientMove 4s ease infinite;
        position: relative;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .history-content {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        font-weight: 400;
        letter-spacing: 0.01em;
        font-size: 17px;
    }

    .history-content p {
        margin-bottom: 20px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .history-content p:nth-child(1) { animation-delay: 0.2s; }
    .history-content p:nth-child(2) { animation-delay: 0.4s; }
    .history-content p:nth-child(3) { animation-delay: 0.6s; }
    .history-content p:nth-child(4) { animation-delay: 0.8s; }
    .history-content p:nth-child(n+5) { animation-delay: 1s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .decorative-line {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        margin: 32px 0;
        position: relative;
    }

    .decorative-line::before {
        content: '';
        position: absolute;
        top: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #7c3aed, #ec4899);
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(124, 58, 237, 0.5);
        animation: pulse 2s ease infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: translateX(-50%) scale(1); }
        50% { transform: translateX(-50%) scale(1.2); }
    }

    .loading-shimmer {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.05) 75%);
        background-size: 200% 100%;
        animation: shimmer 2.5s infinite;
        border-radius: 8px;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .entrance-animation {
        opacity: 0;
        transform: translateY(40px);
        animation: entranceSlide 1s ease-out forwards;
    }

    .entrance-animation:nth-child(1) { animation-delay: 0.1s; }
    .entrance-animation:nth-child(2) { animation-delay: 0.3s; }
    .entrance-animation:nth-child(3) { animation-delay: 0.5s; }

    @keyframes entranceSlide {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .floating-icon {
        animation: floatingIcon 4s ease-in-out infinite;
    }

    @keyframes floatingIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .glass-container {
            border-radius: 24px;
            margin: 16px;
        }

        .premium-bg {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .history-content {
            font-size: 16px;
        }
    }

    @media (max-width: 640px) {
        .glass-container {
            padding: 24px !important;
            margin: 12px;
        }

        .image-container {
            border-radius: 16px;
        }
    }

    /* Enhanced focus states */
    .glass-container:focus-within {
        outline: 2px solid rgba(255, 255, 255, 0.3);
        outline-offset: 4px;
    }

    /* Print styles */
    @media print {
        .premium-bg {
            background: white !important;
        }

        .history-content {
            color: black !important;
        }

        .gradient-title {
            -webkit-text-fill-color: black !important;
        }
    }
</style>

<div class="premium-bg min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <!-- Animated Timeline Particles -->
    <div class="timeline-particles">
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
        <div class="timeline-particle"></div>
    </div>

    <div class="container mx-auto max-w-6xl relative z-10">
        <!-- Premium Header Section -->
        <div class="text-center mb-16 entrance-animation">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-slate-600/20 to-slate-800/20 backdrop-blur-sm border border-white/10 mb-8 floating-icon">
                <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 gradient-title leading-tight">
                Sejarah Sekolah
            </h1>

            <p class="text-xl md:text-2xl text-white/70 font-light max-w-3xl mx-auto leading-relaxed">
                Perjalanan panjang dalam membangun tradisi pendidikan yang berkualitas dan berkarakter
            </p>
        </div>

        <!-- Premium Content Container -->
        <div class="glass-container p-8 md:p-12 lg:p-16 entrance-animation">

            <!-- Image Section -->
            <div class="image-container mb-12 entrance-animation">
                <img src="{{ asset('images/gedung-sekolah2.png') }}"
                     alt="Sejarah Sekolah"
                     class="school-image"
                     loading="lazy">
            </div>

            <!-- Decorative Separator -->
            <div class="decorative-line"></div>

            <!-- History Content Section -->
            <div class="history-content prose prose-lg max-w-none">
                @if(empty($profile->history) || $profile->history === 'Sejarah sekolah belum diatur.')
                    <!-- Loading Shimmer Effect -->
                    <div class="space-y-6 mb-8">
                        <div class="h-5 loading-shimmer"></div>
                        <div class="h-5 loading-shimmer" style="width: 95%"></div>
                        <div class="h-5 loading-shimmer" style="width: 90%"></div>
                        <div class="h-5 loading-shimmer" style="width: 85%"></div>
                        <div class="h-5 loading-shimmer" style="width: 92%"></div>
                        <div class="h-5 loading-shimmer" style="width: 88%"></div>
                    </div>

                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500/20 to-orange-600/20 backdrop-blur-sm border border-white/10 mb-6">
                            <svg class="w-8 h-8 text-amber-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <p class="text-white/70 text-lg italic">
                            Sejarah sekolah belum diatur.
                        </p>
                        <p class="text-white/50 text-sm mt-2">
                            Data akan segera ditampilkan setelah diperbarui oleh administrator.
                        </p>
                    </div>
                @else
                    <!-- Display actual history content -->
                    <div class="space-y-6">
                        {!! nl2br(e($profile->history)) !!}
                    </div>
                @endif
            </div>

            <!-- Bottom Decorative Section -->
            <div class="mt-16 pt-8 border-t border-white/10">
                <div class="flex items-center justify-center space-x-4 text-white/50 text-sm">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-gradient-to-r from-slate-400 to-slate-600 rounded-full animate-pulse"></div>
                        <span class="font-medium">Dokumentasi Sejarah</span>
                    </div>
                    <div class="w-px h-4 bg-white/20"></div>
                    <div class="flex items-center space-x-2">
                        <span class="font-medium">Sistem Informasi Sekolah</span>
                        <div class="w-2 h-2 bg-gradient-to-r from-slate-600 to-slate-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="fixed bottom-8 right-8 opacity-50 hover:opacity-100 transition-opacity duration-300">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white/70 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for entrance animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all entrance animation elements
    document.querySelectorAll('.entrance-animation').forEach(el => {
        observer.observe(el);
    });

    // Enhanced image loading with fade-in effect
    const schoolImage = document.querySelector('.school-image');
    if (schoolImage) {
        schoolImage.addEventListener('load', function() {
            this.style.opacity = '0';
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transition = 'all 0.8s cubic-bezier(0.23, 1, 0.32, 1)';
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            }, 100);
        });

        // Fallback for cached images
        if (schoolImage.complete) {
            schoolImage.style.opacity = '1';
        }
    }

    // Smooth parallax effect for background
    let ticking = false;
    function updateBackground() {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.3;

        const bg = document.querySelector('.premium-bg');
        if (bg) {
            bg.style.transform = `translate3d(0, ${parallax}px, 0)`;
        }

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateBackground);
            ticking = true;
        }
    }

    // Throttled scroll event
    window.addEventListener('scroll', requestTick);

    // Enhanced hover effects for glass container
    const glassContainer = document.querySelector('.glass-container');
    if (glassContainer) {
        glassContainer.addEventListener('mouseenter', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            this.style.setProperty('--mouse-x', `${x}px`);
            this.style.setProperty('--mouse-y', `${y}px`);
        });
    }

    // Smooth scroll for scroll indicator
    const scrollIndicator = document.querySelector('.fixed.bottom-8.right-8');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Progressive content loading animation
    const historyContent = document.querySelector('.history-content');
    if (historyContent) {
        const paragraphs = historyContent.querySelectorAll('p, div');
        paragraphs.forEach((p, index) => {
            p.style.animationDelay = `${0.2 + (index * 0.1)}s`;
        });
    }
});

// Optimize performance
window.addEventListener('load', function() {
    // Remove loading states
    document.querySelectorAll('.loading-shimmer').forEach(el => {
        el.classList.remove('loading-shimmer');
    });
});
</script>
@endsection
