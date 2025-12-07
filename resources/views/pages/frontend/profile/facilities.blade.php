@extends('layouts.frontend')

@section('title', 'Fasilitas Sekolah')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .premium-bg {
        background: linear-gradient(-45deg, #0f172a, #1e293b, #334155, #475569);
        background-size: 400% 400%;
        animation: gradientShift 20s ease infinite;
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
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(147, 51, 234, 0.08) 50%, rgba(236, 72, 153, 0.08) 100%);
        animation: overlayPulse 15s ease infinite alternate;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes overlayPulse {
        0% { opacity: 0.4; }
        100% { opacity: 0.8; }
    }

    .facility-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .facility-particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
        animation: facilityFloat 30s infinite linear;
    }

    .facility-particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
    .facility-particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 4s; }
    .facility-particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 8s; }
    .facility-particle:nth-child(4) { width: 8px; height: 8px; left: 40%; animation-delay: 12s; }
    .facility-particle:nth-child(5) { width: 5px; height: 5px; left: 50%; animation-delay: 16s; }
    .facility-particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: 20s; }
    .facility-particle:nth-child(7) { width: 4px; height: 4px; left: 70%; animation-delay: 24s; }
    .facility-particle:nth-child(8) { width: 6px; height: 6px; left: 80%; animation-delay: 28s; }
    .facility-particle:nth-child(9) { width: 3px; height: 3px; left: 90%; animation-delay: 32s; }
    .facility-particle:nth-child(10) { width: 5px; height: 5px; left: 95%; animation-delay: 36s; }

    @keyframes facilityFloat {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        5% { opacity: 1; }
        95% { opacity: 1; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }

    .gradient-title {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 25%, #e2e8f0 50%, #cbd5e1 75%, #94a3b8 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 400% 400%;
        animation: gradientMove 5s ease infinite;
        position: relative;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .facility-card {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.12),
            0 2px 16px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        opacity: 0;
        transform: translateY(40px);
        animation: cardEnter 0.8s ease-out forwards;
    }

    .facility-card:nth-child(1) { animation-delay: 0.1s; }
    .facility-card:nth-child(2) { animation-delay: 0.2s; }
    .facility-card:nth-child(3) { animation-delay: 0.3s; }
    .facility-card:nth-child(4) { animation-delay: 0.4s; }
    .facility-card:nth-child(5) { animation-delay: 0.5s; }
    .facility-card:nth-child(6) { animation-delay: 0.6s; }
    .facility-card:nth-child(n+7) { animation-delay: 0.7s; }

    @keyframes cardEnter {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .facility-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        transition: left 0.6s ease;
        z-index: 1;
    }

    .facility-card:hover::before {
        left: 100%;
    }

    .facility-card:hover {
        transform: translateY(-12px) scale(1.03);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow:
            0 32px 64px rgba(0, 0, 0, 0.25),
            0 16px 32px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .image-container {
        position: relative;
        height: 240px;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    }

    .image-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }

    .facility-card:hover .image-container::after {
        opacity: 1;
    }

    .facility-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        filter: brightness(1.1) contrast(1.05) saturate(1.1);
    }

    .facility-card:hover .facility-image {
        transform: scale(1.08);
        filter: brightness(1.2) contrast(1.1) saturate(1.2);
    }

    .card-content {
        padding: 24px;
        position: relative;
        z-index: 3;
    }

    .facility-title {
        color: #ffffff;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.3;
        letter-spacing: -0.01em;
        transition: all 0.3s ease;
    }

    .facility-card:hover .facility-title {
        transform: translateY(-2px);
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .facility-description {
        color: rgba(255, 255, 255, 0.8);
        font-size: 15px;
        line-height: 1.6;
        font-weight: 400;
        letter-spacing: 0.01em;
        transition: all 0.3s ease;
    }

    .facility-card:hover .facility-description {
        color: rgba(255, 255, 255, 0.9);
        transform: translateY(-1px);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 20px;
        color: rgba(255, 255, 255, 0.6);
        animation: fadeIn 1s ease-out;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .pagination-container {
        margin-top: 48px;
        display: flex;
        justify-content: center;
    }

    .pagination-container nav {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .pagination-container a, .pagination-container span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        margin: 0 4px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.7);
    }

    .pagination-container a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-1px);
    }

    .pagination-container .current {
        background: linear-gradient(135deg, #3b82f6, #9333ea);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .floating-icon {
        animation: floatingIcon 6s ease-in-out infinite;
    }

    @keyframes floatingIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .entrance-animation {
        opacity: 0;
        transform: translateY(30px);
        animation: entranceSlide 1s ease-out forwards;
    }

    .entrance-animation:nth-child(1) { animation-delay: 0.1s; }
    .entrance-animation:nth-child(2) { animation-delay: 0.3s; }

    @keyframes entranceSlide {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Loading shimmer for images */
    .image-loading {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0.05) 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .facility-card {
            border-radius: 20px;
        }
    }

    @media (max-width: 768px) {
        .premium-bg {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .facility-card {
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .facility-card:hover {
            transform: translateY(-6px) scale(1.02);
        }

        .card-content {
            padding: 20px;
        }

        .image-container {
            height: 200px;
        }
    }

    @media (max-width: 640px) {
        .card-content {
            padding: 16px;
        }

        .facility-title {
            font-size: 18px;
        }

        .facility-description {
            font-size: 14px;
        }

        .image-container {
            height: 180px;
        }
    }

    /* Focus states for accessibility */
    .facility-card:focus-within {
        outline: 2px solid rgba(59, 130, 246, 0.5);
        outline-offset: 2px;
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .facility-card {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .facility-title, .facility-description {
            color: white;
        }
    }
</style>

<div class="premium-bg min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <!-- Animated Facility Particles -->
    <div class="facility-particles">
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
        <div class="facility-particle"></div>
    </div>

    <div class="container mx-auto max-w-7xl relative z-10">
        <!-- Premium Header Section -->
        <div class="text-center mb-16 entrance-animation">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-blue-600/20 to-purple-600/20 backdrop-blur-sm border border-white/10 mb-8 floating-icon">
                <svg class="w-10 h-10 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 gradient-title leading-tight">
                Fasilitas Sekolah
            </h1>

            <p class="text-xl md:text-2xl text-white/70 font-light max-w-3xl mx-auto leading-relaxed">
                Fasilitas modern dan lengkap untuk mendukung proses pembelajaran yang optimal dan berkualitas tinggi
            </p>
        </div>

        <!-- Facilities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 entrance-animation">
            @forelse ($facilities as $facility)
            <div class="facility-card group">
                <div class="image-container">
                    <img src="{{ asset('storage/' . $facility->image_path) }}"
                         alt="{{ $facility->name }}"
                         class="facility-image"
                         loading="lazy"
                         onerror="this.parentElement.classList.add('image-loading'); this.style.display='none';">
                </div>

                <div class="card-content">
                    <h3 class="facility-title">{{ $facility->name }}</h3>
                    <p class="facility-description">{{ $facility->description }}</p>

                    <!-- Hover indicator -->
                    <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-600/20 backdrop-blur-sm border border-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg class="w-10 h-10 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold mb-4 text-white/60">Belum Ada Fasilitas</h3>
                <p class="text-lg text-white/50 max-w-md mx-auto leading-relaxed">
                    Data fasilitas belum ditambahkan. Silakan hubungi administrator untuk menambahkan informasi fasilitas sekolah.
                </p>

                <div class="mt-8">
                    <div class="inline-flex items-center space-x-2 text-white/40 text-sm">
                        <div class="w-2 h-2 bg-blue-400/30 rounded-full animate-pulse"></div>
                        <span>Sistem Informasi Sekolah</span>
                        <div class="w-2 h-2 bg-purple-400/30 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Enhanced Pagination -->
        @if($facilities->hasPages())
        <div class="pagination-container">
            {{ $facilities->links() }}
        </div>
        @endif

        <!-- Bottom Statistics -->
        @if($facilities->count() > 0)
        <div class="mt-16 pt-8 border-t border-white/10">
            <div class="text-center">
                <div class="inline-flex items-center justify-center space-x-8 text-white/50 text-sm">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full animate-pulse"></div>
                        <span class="font-medium">{{ $facilities->total() }} Total Fasilitas</span>
                    </div>

                    <div class="w-px h-4 bg-white/20"></div>

                    <div class="flex items-center space-x-2">
                        <span class="font-medium">Halaman {{ $facilities->currentPage() }} dari {{ $facilities->lastPage() }}</span>
                        <div class="w-2 h-2 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for entrance animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -30px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';

                // Special handling for grid container
                if (entry.target.classList.contains('entrance-animation')) {
                    const cards = entry.target.querySelectorAll('.facility-card');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.style.animationPlayState = 'running';
                        }, index * 100);
                    });
                }
            }
        });
    }, observerOptions);

    // Observe entrance animation elements
    document.querySelectorAll('.entrance-animation').forEach(el => {
        observer.observe(el);
    });

    // Enhanced image loading with error handling
    document.querySelectorAll('.facility-image').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '0';
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            }, 100);
        });

        img.addEventListener('error', function() {
            const container = this.parentElement;
            container.innerHTML = `
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-700/50 to-slate-800/50">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-white/40 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-white/50 text-sm">Gambar tidak tersedia</p>
                    </div>
                </div>
            `;
        });

        // Handle cached images
        if (img.complete && img.naturalHeight !== 0) {
            img.style.opacity = '1';
        }
    });

    // Enhanced card hover effects with 3D tilt
    document.querySelectorAll('.facility-card').forEach(card => {
        card.addEventListener('mouseenter', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            this.style.transform = `translateY(-12px) scale(1.03) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1) rotateX(0deg) rotateY(0deg)';
        });

        // Touch devices
        card.addEventListener('touchstart', function() {
            this.style.transform = 'translateY(-6px) scale(1.02)';
        });

        card.addEventListener('touchend', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Smooth parallax scrolling
    let ticking = false;
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;

        const bg = document.querySelector('.premium-bg');
        if (bg) {
            bg.style.transform = `translate3d(0, ${rate}px, 0)`;
        }

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick, { passive: true });

    // Enhanced pagination styling
    const paginationLinks = document.querySelectorAll('.pagination-container a');
    paginationLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 4px 12px rgba(59, 130, 246, 0.2)';
        });

        link.addEventListener('mouseleave', function() {
            this.style.boxShadow = '';
        });
    });
});

// Performance optimization
window.addEventListener('load', function() {
    // Remove any loading states
    document.querySelectorAll('.image-loading').forEach(el => {
        el.classList.remove('image-loading');
    });

    // Preload next page images if pagination exists
    const nextPageLink = document.querySelector('.pagination-container a[rel="next"]');
    if (nextPageLink && 'IntersectionObserver' in window) {
        const preloadObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Preload logic could be implemented here
                    preloadObserver.unobserve(entry.target);
                }
            });
        });

        preloadObserver.observe(nextPageLink);
    }
});
</script>
@endsection
