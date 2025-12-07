@extends('layouts.frontend')

@section('title', 'Berita & Pengumuman')

@section('content')
<style>
/* Premium Background & Base Styles */
.premium-bg {
    background: linear-gradient(-45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
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
    pointer-events: none;
}

.particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
    animation: float 20s infinite linear;
}

.particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; animation-duration: 25s; }
.particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; animation-duration: 20s; }
.particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; animation-duration: 30s; }
.particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; animation-duration: 22s; }
.particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 8s; animation-duration: 26s; }
.particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: 10s; animation-duration: 18s; }
.particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 12s; animation-duration: 28s; }
.particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 14s; animation-duration: 24s; }
.particle:nth-child(9) { width: 6px; height: 6px; left: 90%; animation-delay: 16s; animation-duration: 21s; }

@keyframes float {
    0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
}

/* Glassmorphism Container */
.glass-container {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

/* Premium Typography with Gradient */
.gradient-title {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #e2e8f0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% { filter: brightness(1) saturate(1); }
    100% { filter: brightness(1.1) saturate(1.2); }
}

/* Premium News Cards */
.news-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow:
        0 20px 40px -12px rgba(0, 0, 0, 0.2),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

.news-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.8s ease;
}

.news-card:hover::before {
    left: 100%;
}

.news-card:hover {
    transform: translateY(-12px) rotateX(5deg) rotateY(5deg);
    box-shadow:
        0 35px 80px -12px rgba(0, 0, 0, 0.35),
        0 0 0 1px rgba(255, 255, 255, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.25);
}

.news-card img {
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.news-card:hover img {
    transform: scale(1.05);
    filter: brightness(1.1) saturate(1.2);
}

/* Content Styling */
.card-content {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.card-title {
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.card-title:hover {
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.card-date {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.card-excerpt {
    color: rgba(255, 255, 255, 0.85);
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    line-height: 1.6;
}

.read-more {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 12px;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px -8px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
}

.read-more::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.read-more:hover::before {
    left: 100%;
}

.read-more:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 15px 40px -8px rgba(102, 126, 234, 0.6);
    background: linear-gradient(135deg, #764ba2, #f093fb);
}

/* Empty State */
.empty-state {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.1rem;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
}

/* Pagination Styling */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 4rem;
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

/* Stagger animation delay */
.news-card:nth-child(1) { animation-delay: 0.1s; }
.news-card:nth-child(2) { animation-delay: 0.2s; }
.news-card:nth-child(3) { animation-delay: 0.3s; }
.news-card:nth-child(4) { animation-delay: 0.4s; }
.news-card:nth-child(5) { animation-delay: 0.5s; }
.news-card:nth-child(6) { animation-delay: 0.6s; }
.news-card:nth-child(7) { animation-delay: 0.7s; }
.news-card:nth-child(8) { animation-delay: 0.8s; }
.news-card:nth-child(9) { animation-delay: 0.9s; }

/* Responsive Design */
@media (max-width: 768px) {
    .news-card:hover {
        transform: translateY(-8px);
    }

    .glass-container {
        margin: 1rem;
        padding: 2rem 1rem;
    }

    .gradient-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 640px) {
    .gradient-title {
        font-size: 2rem;
    }

    .news-card {
        margin-bottom: 1.5rem;
    }
}

/* Enhanced Focus States for Accessibility */
.news-card:focus-within,
.read-more:focus {
    outline: 2px solid rgba(255, 255, 255, 0.5);
    outline-offset: 4px;
}
</style>

<div class="min-h-screen premium-bg py-20">
    <!-- Particle Animation Background -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Premium Glass Container -->
        <div class="glass-container p-8 md:p-12">
            <!-- Premium Title with Gradient -->
            <h1 class="text-5xl md:text-6xl font-bold text-center mb-16 gradient-title animate-fade-in">
                Berita & Pengumuman
            </h1>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                {{-- Loop dari data post asli --}}
                @forelse ($posts as $post)
                <article class="news-card flex flex-col animate-fade-in">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden p-4 pb-0">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block">
                            <img src="{{ $post->featured_image_path ? asset('storage/' . $post->featured_image_path) : 'https://placehold.co/600x400/e2e8f0/6366f1?text=Berita' }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-48 object-cover">
                        </a>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content p-6 flex flex-col flex-grow">
                        <!-- Date -->
                        <span class="card-date text-sm mb-3">
                            {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </span>

                        <!-- Title -->
                        <h3 class="card-title font-bold text-xl mb-4 flex-grow leading-tight">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:no-underline">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="card-excerpt mb-6 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                        </p>

                        <!-- Read More Button -->
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="read-more inline-flex items-center justify-center text-center mt-auto">
                            Baca Selengkapnya
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full empty-state animate-fade-in">
                    <svg class="mx-auto w-16 h-16 mb-4 opacity-60" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="font-semibold">Belum ada berita yang dipublikasikan.</p>
                    <p class="mt-2 opacity-75">Silakan kembali lagi nanti untuk update terbaru.</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
            <div class="pagination-container">
                <div class="glass-container p-4">
                    {{ $posts->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
// Enhanced smooth scrolling and performance optimizations
document.addEventListener('DOMContentLoaded', function() {
    // Add intersection observer for better animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-fade-in').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });

    // Smooth hover effects with requestAnimationFrame
    let ticking = false;

    document.querySelectorAll('.news-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;

                    card.style.transform = `translateY(-12px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    ticking = false;
                });
                ticking = true;
            }
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
        });
    });

    // Preload images for better performance
    document.querySelectorAll('img[data-src]').forEach(img => {
        img.src = img.dataset.src;
    });
});
</script>
@endsection
