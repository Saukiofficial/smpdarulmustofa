@extends('layouts.frontend')

@section('title', 'Pengurus Ikatan Alumni')

@push('styles')
<style>
    /* Premium Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Premium Background with Gradient */
    .premium-bg {
        background: linear-gradient(135deg,
            #667eea 0%,
            #764ba2 25%,
            #f093fb 50%,
            #f5576c 75%,
            #4facfe 100%
        );
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        position: relative;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Particle Animation Background */
    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
        }
    }

    /* Glassmorphism Container */
    .glass-container {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow:
            0 8px 32px 0 rgba(31, 38, 135, 0.37),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        position: relative;
        z-index: 2;
    }

    /* Premium Typography */
    .gradient-text {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #e2e8f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        letter-spacing: -0.025em;
        line-height: 1.1;
    }

    .subtitle-text {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 400;
        letter-spacing: 0.025em;
    }

    /* Premium Board Cards */
    .board-card {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
        overflow: hidden;
        box-shadow:
            0 10px 40px rgba(0, 0, 0, 0.1),
            0 4px 25px rgba(0, 0, 0, 0.07);
    }

    .board-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.4) 0%,
            rgba(255, 255, 255, 0.1) 100%
        );
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .board-card:hover::before {
        opacity: 1;
    }

    /* 3D Hover Animations */
    .board-card:hover {
        transform: translateY(-12px) rotateX(5deg) rotateY(5deg);
        box-shadow:
            0 25px 60px rgba(0, 0, 0, 0.2),
            0 15px 35px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Premium Photo Styling */
    .premium-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.6);
        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.15),
            0 5px 15px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        position: relative;
    }

    .premium-photo:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.8);
        box-shadow:
            0 20px 45px rgba(0, 0, 0, 0.2),
            0 8px 20px rgba(0, 0, 0, 0.12),
            inset 0 2px 0 rgba(255, 255, 255, 0.9);
    }

    /* Premium Text Styling */
    .position-text {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .name-text {
        color: white;
        font-weight: 700;
        font-size: 1.25rem;
        letter-spacing: -0.025em;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        line-height: 1.3;
    }

    /* Premium Section Divider */
    .premium-divider {
        width: 2px;
        height: 80px;
        background: linear-gradient(
            to bottom,
            transparent 0%,
            rgba(255, 255, 255, 0.8) 50%,
            transparent 100%
        );
        margin: 3rem auto;
        position: relative;
    }

    .premium-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    }

    /* Section Title Styling */
    .section-title {
        background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 2rem;
        letter-spacing: -0.025em;
        margin-bottom: 3rem;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Loading Animation */
    .loading-shimmer {
        background: linear-gradient(
            90deg,
            rgba(255, 255, 255, 0.1) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0.1) 100%
        );
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    /* Empty State Styling */
    .empty-state {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow:
            0 8px 32px rgba(31, 38, 135, 0.37),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }

    .empty-state-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.125rem;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .premium-photo {
            width: 100px;
            height: 100px;
        }

        .board-card {
            padding: 1.5rem;
        }

        .gradient-text {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 640px) {
        .board-card:hover {
            transform: translateY(-8px);
        }

        .gradient-text {
            font-size: 2rem;
        }
    }

    /* Period Badge */
    .period-badge {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 0.75rem 2rem;
        display: inline-block;
        margin-top: 1rem;
        color: rgba(255, 255, 255, 0.95);
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.025em;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="premium-bg min-h-screen py-24 relative">
    <!-- Particle Background -->
    <div class="particles">
        <div class="particle" style="left: 10%; width: 6px; height: 6px; animation-delay: -2s;"></div>
        <div class="particle" style="left: 20%; width: 4px; height: 4px; animation-delay: -4s;"></div>
        <div class="particle" style="left: 30%; width: 8px; height: 8px; animation-delay: -6s;"></div>
        <div class="particle" style="left: 40%; width: 3px; height: 3px; animation-delay: -8s;"></div>
        <div class="particle" style="left: 50%; width: 5px; height: 5px; animation-delay: -10s;"></div>
        <div class="particle" style="left: 60%; width: 7px; height: 7px; animation-delay: -12s;"></div>
        <div class="particle" style="left: 70%; width: 4px; height: 4px; animation-delay: -14s;"></div>
        <div class="particle" style="left: 80%; width: 6px; height: 6px; animation-delay: -16s;"></div>
        <div class="particle" style="left: 90%; width: 5px; height: 5px; animation-delay: -18s;"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl lg:text-7xl gradient-text mb-4">
                Struktur Pengurus
            </h1>
            <h2 class="text-3xl md:text-4xl gradient-text">
                Ikatan Alumni
            </h2>
            <div class="period-badge">
                Periode 2024 - 2027
            </div>
        </div>

        <!-- Content Section -->
        <div class="glass-container p-8 md:p-12">
            {{-- Menampilkan data pengurus alumni dari database --}}
            @if(isset($alumniBoards) && $alumniBoards->isNotEmpty())
                <!-- Jajaran Inti -->
                <div class="flex flex-wrap justify-center gap-8 lg:gap-12 mb-16">
                    @foreach($alumniBoards->whereIn('position', ['Ketua Umum', 'Wakil Ketua', 'Sekretaris', 'Bendahara']) as $member)
                    <div class="board-card w-full sm:w-80">
                        <img src="{{ asset('storage/' . $member->photo_path) }}"
                             alt="{{ $member->name }}"
                             class="premium-photo">
                        <h3 class="position-text">{{ $member->position }}</h3>
                        <p class="name-text">{{ $member->name }}</p>
                    </div>
                    @endforeach
                </div>

                <!-- Premium Divider -->
                <div class="premium-divider"></div>

                <!-- Bidang-Bidang -->
                <div class="text-center mb-12">
                    <h2 class="section-title">Bidang-Bidang</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-12">
                    @foreach($alumniBoards->filter(fn($m) => str_starts_with($m->position, 'Bidang')) as $member)
                    <div class="board-card">
                        <img src="{{ asset('storage/' . $member->photo_path) }}"
                             alt="{{ $member->name }}"
                             class="premium-photo">
                        <h3 class="position-text">{{ $member->position }}</h3>
                        <p class="name-text">{{ $member->name }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="text-6xl mb-6">👥</div>
                    <p class="empty-state-text">
                        Data pengurus alumni belum tersedia.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Add smooth loading animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const cards = document.querySelectorAll('.board-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Add dynamic particle generation
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.width = (Math.random() * 6 + 2) + 'px';
        particle.style.height = particle.style.width;
        particle.style.animationDelay = '-' + (Math.random() * 20) + 's';

        document.querySelector('.particles').appendChild(particle);

        setTimeout(() => {
            particle.remove();
        }, 20000);
    }

    // Generate particles periodically
    setInterval(createParticle, 3000);
});
</script>
@endsection
