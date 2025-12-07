@extends('layouts.frontend')

@section('title', 'Data Alumni & Testimoni')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    /* Custom Gradient Background */
    .luxury-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 75%, #f5576c 100%);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Glassmorphism Effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    }

    .glass-card-strong {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .glass-table {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* 3D Hover Effects */
    .card-3d {
        transform-style: preserve-3d;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .card-3d:hover {
        transform: rotateY(3deg) rotateX(3deg) translateY(-15px) scale(1.02);
        box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2);
    }

    .testimonial-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Premium Shadows */
    .premium-shadow {
        box-shadow:
            0 4px 8px rgba(0, 0, 0, 0.04),
            0 8px 16px rgba(0, 0, 0, 0.06),
            0 16px 32px rgba(0, 0, 0, 0.08),
            0 32px 64px rgba(0, 0, 0, 0.10);
    }

    /* Particle Animation */
    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) scale(1); opacity: 0.7; }
        50% { transform: translateY(-20px) scale(1.1); opacity: 1; }
    }

    /* Quote Icon Animation */
    .quote-icon {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Table Styling */
    .luxury-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .luxury-table thead th {
        background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.2);
        color: white;
        font-weight: 600;
    }

    .luxury-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .luxury-table tbody tr:hover {
        background: rgba(255,255,255,0.1);
        transform: scale(1.01);
    }

    .luxury-table tbody td {
        color: rgba(255,255,255,0.9);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    /* Profile Avatar Effects */
    .profile-avatar {
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 2px solid rgba(255,255,255,0.2);
    }

    .profile-avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        border-color: rgba(255,255,255,0.4);
    }

    /* Fade In Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .card-3d:hover, .testimonial-card:hover {
            transform: translateY(-5px) scale(1.01);
        }

        .luxury-table {
            font-size: 0.875rem;
        }
    }

    /* Laravel Pagination Styling */
    .pagination-wrapper .pagination {
        @apply flex items-center space-x-2;
    }

    .pagination-wrapper .pagination li {
        @apply inline-block;
    }

    .pagination-wrapper .pagination a,
    .pagination-wrapper .pagination span {
        @apply w-10 h-10 flex items-center justify-center rounded-xl text-white/70 transition-all duration-300;
        background: rgba(255, 255, 255, 0.1);
    }

    .pagination-wrapper .pagination a:hover {
        @apply text-white;
        background: rgba(255, 255, 255, 0.2);
    }

    .pagination-wrapper .pagination .active span {
        @apply text-white font-bold;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    /* Empty State Styling */
    .empty-state {
        background: rgba(255, 255, 255, 0.05);
        border: 2px dashed rgba(255, 255, 255, 0.2);
    }

    /* Section Divider */
    .section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        margin: 4rem 0;
    }
</style>
@endpush

@section('content')
<!-- Background with Particles -->
<div class="min-h-screen luxury-gradient relative overflow-hidden">
    <!-- Floating Particles -->
    <div class="particle" style="top: 15%; left: 15%; width: 4px; height: 4px; animation-delay: 0s;"></div>
    <div class="particle" style="top: 25%; left: 85%; width: 6px; height: 6px; animation-delay: 1.5s;"></div>
    <div class="particle" style="top: 65%; left: 25%; width: 3px; height: 3px; animation-delay: 3s;"></div>
    <div class="particle" style="top: 75%; left: 75%; width: 5px; height: 5px; animation-delay: 4.5s;"></div>
    <div class="particle" style="top: 35%; left: 65%; width: 4px; height: 4px; animation-delay: 2s;"></div>
    <div class="particle" style="top: 55%; left: 45%; width: 6px; height: 6px; animation-delay: 6s;"></div>

    <!-- Main Content -->
    <div class="relative z-10 py-20">
        <div class="container mx-auto px-6">
            <!-- Title Section -->
            <div class="text-center mb-16 fade-in">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold gradient-text mb-6">
                    Alumni & Testimoni
                </h1>
                <p class="text-xl md:text-2xl text-white/80 font-light">
                    Jejak Prestasi dan Kesuksesan Lulusan Kami
                </p>
            </div>

            {{-- Bagian Testimoni --}}
            @if(isset($testimonials) && $testimonials->isNotEmpty())
            <div class="mb-20 fade-in" style="animation-delay: 0.2s">
                <div class="text-center mb-12">
                    <div class="quote-icon w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Apa Kata Mereka?</h2>
                    <p class="text-white/70 text-lg">Testimoni langsung dari alumni yang telah sukses</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="glass-card rounded-3xl p-8 testimonial-card premium-shadow fade-in" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s">
                        <!-- Quote Icon -->
                        <div class="mb-6">
                            <svg class="w-8 h-8 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <!-- Testimonial Content -->
                        <p class="text-white/90 italic leading-relaxed mb-6 text-lg">
                            "{{ $testimonial->content }}"
                        </p>

                        <!-- Alumni Info -->
                        <div class="flex items-center">
                            <div class="relative">
                                <img src="{{ $testimonial->alumnus->photo_path ? asset('storage/' . $testimonial->alumnus->photo_path) : 'https://placehold.co/60x60/e2e8f0/6366f1?text='.substr($testimonial->alumnus->name, 0, 1) }}"
                                     alt="Foto {{ $testimonial->alumnus->name }}"
                                     class="w-14 h-14 rounded-full mr-4 object-cover profile-avatar">
                                <!-- Status indicator -->
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-gradient-to-r from-green-400 to-blue-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div>
                                <p class="font-bold text-white text-lg">{{ $testimonial->alumnus->name }}</p>
                                <p class="text-white/70 text-sm">{{ $testimonial->alumnus->occupation }}</p>
                                <p class="text-white/50 text-xs">Lulusan {{ $testimonial->alumnus->graduation_year }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Divider -->
            <div class="section-divider"></div>
            @endif

            {{-- Bagian Daftar Alumni --}}
            <div class="fade-in" style="animation-delay: 0.4s">
                <div class="text-center mb-12">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Jejak Alumni</h2>
                    <p class="text-white/70 text-lg">Database lengkap alumni yang telah berkiprah di berbagai bidang</p>
                </div>

                <div class="glass-table rounded-3xl overflow-hidden premium-shadow">
                    <div class="overflow-x-auto">
                        <table class="min-w-full luxury-table">
                            <thead>
                                <tr>
                                    <th class="text-left py-4 px-6 font-semibold">Nama Lengkap</th>
                                    <th class="text-left py-4 px-6 font-semibold">Tahun Lulus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($alumni))
                                    @forelse($alumni as $item)
                                    <tr class="hover:bg-white/5 transition-all duration-300">
                                        <td class="py-4 px-6 flex items-center">
                                            <div class="relative mr-4">
                                                <img src="{{ $item->photo_path ? asset('storage/' . $item->photo_path) : 'https://placehold.co/50x50/e2e8f0/6366f1?text='.substr($item->name, 0, 1) }}"
                                                     alt="Foto {{ $item->name }}"
                                                     class="w-12 h-12 rounded-full object-cover profile-avatar">
                                                <!-- Online status indicator -->
                                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full border-2 border-white/20"></div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-white">{{ $item->name }}</span>
                                                @if($item->email)
                                                <p class="text-xs text-white/50">{{ $item->email }}</p>
                                                @endif
                                            </div>
                                        </td>
<<<<<<< HEAD
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-white border border-white/20">
                                                {{ $item->graduation_year }}
                                            </span>
                                        </td>
                                        {{--  <td class="py-4 px-6">
=======
                                          <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-white border border-white/20">
                                                {{ $item->graduation_year }}
                                            </span> 
                                        </td>
<!--                                         <td class="py-4 px-6">
>>>>>>> fd657d528f7af3dffbe1b290185acc8574b521e6
                                            <span class="text-white/90">{{ $item->occupation ?? '-' }}</span>
                                            @if($item->company)
                                            <p class="text-xs text-white/50">di {{ $item->company }}</p>
                                            @endif
<<<<<<< HEAD
                                        </td>  --}}
=======
                                        </td> -->
>>>>>>> fd657d528f7af3dffbe1b290185acc8574b521e6
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-12">
                                            <div class="empty-state rounded-2xl p-8 mx-6">
                                                <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <svg class="w-8 h-8 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-white/70 text-lg">Belum ada data alumni yang dipublikasikan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Link Pagination --}}
                @if(isset($alumni) && $alumni->hasPages())
                <div class="mt-12 flex justify-center fade-in" style="animation-delay: 0.6s">
                    <div class="glass-card-strong rounded-2xl p-4 pagination-wrapper">
                        {{ $alumni->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const cards = document.querySelectorAll('.fade-in');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });


        const tableRows = document.querySelectorAll('.luxury-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.zIndex = '10';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.zIndex = '1';
            });
        });


        const avatars = document.querySelectorAll('.profile-avatar');
        avatars.forEach(avatar => {
            avatar.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1) rotate(5deg)';
            });

            avatar.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });


        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;

                this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            });
        });


        const images = document.querySelectorAll('.profile-avatar');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });

            img.addEventListener('error', function() {
                this.style.opacity = '0.7';
                this.style.filter = 'grayscale(100%)';
            });
        });


        document.documentElement.style.scrollBehavior = 'smooth';


        if (window.innerWidth <= 768) {
            testimonialCards.forEach(card => {
                card.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.98)';
                });

                card.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });
        }
    });
</script>

<style>

    @media (max-width: 640px) {
        .luxury-gradient {
            padding: 1rem 0;
        }

        .gradient-text {
            font-size: 2.5rem;
            line-height: 1.1;
        }

        .testimonial-card {
            padding: 1.5rem;
        }

        .glass-table {
            margin: 0 -1rem;
            border-radius: 0;
        }

        .luxury-table th,
        .luxury-table td {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .testimonial-card,
        .profile-avatar,
        .particle {
            animation: none !important;
            transition: none !important;
        }

        .luxury-gradient {
            animation: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    }

    @media (prefers-contrast: high) {
        .glass-card,
        .glass-card-strong,
        .glass-table {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid white;
        }
    }
</style>
@endpush
@endsection
