@extends('layouts.frontend')

@section('title', 'Visi & Misi Sekolah')

@section('content')
<style>
/* Premium Variables */
:root {
    --primary: #6366f1;
    --secondary: #8b5cf6;
    --accent: #ec4899;
    --dark: #0f172a;
    --light: #f8fafc;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%),
                url('{{ asset('images/gedung-sekolah2.png') }}') center center;
    background-size: cover;
    background-attachment: fixed;
    position: relative;
    overflow: hidden;
    padding: 6rem 0 8rem;
}

.hero-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.15;
    background-image:
        radial-gradient(circle at 20% 50%, white 1px, transparent 1px),
        radial-gradient(circle at 80% 80%, white 1px, transparent 1px);
    background-size: 50px 50px;
}

.hero-gradient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    animation: float-orb 20s infinite ease-in-out;
}

.orb-1 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, #f093fb 0%, transparent 70%);
    top: -10%;
    left: -10%;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, #4facfe 0%, transparent 70%);
    bottom: -10%;
    right: -10%;
    animation-delay: -10s;
}

@keyframes float-orb {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -30px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(20px, 30px) scale(1.05); }
}

/* Hero Content */
.hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
    animation: fadeInDown 1s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.school-logo {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: white;
    border-radius: 50%;
    padding: 0.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: pulse-logo 3s infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.school-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

@keyframes pulse-logo {
    0%, 100% { transform: scale(1); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); }
    50% { transform: scale(1.05); box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4); }
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 900;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto;
    font-weight: 400;
}

/* Main Content Section */
.content-section {
    margin-top: -4rem;
    position: relative;
    z-index: 20;
    padding-bottom: 6rem;
}

/* Cards Container */
.cards-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 3rem;
}

/* Premium Card Design */
.vision-mission-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: slideUp 0.8s ease-out forwards;
    opacity: 0;
}

.vision-mission-card:nth-child(1) {
    animation-delay: 0.2s;
}

.vision-mission-card:nth-child(2) {
    animation-delay: 0.4s;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.vision-mission-card:hover {
    transform: translateY(-10px);
    box-shadow:
        0 30px 80px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(99, 102, 241, 0.2);
}

/* Card Icon (Top of Card) */
.card-icon-wrapper {
    display: flex;
    justify-content: center;
    padding: 2.5rem 0 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.card-icon-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.2;
    background-image:
        repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255, 255, 255, 0.1) 10px, rgba(255, 255, 255, 0.1) 20px);
}

.card-icon {
    width: 80px;
    height: 80px;
    background: white;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.card-icon::before {
    content: '';
    position: absolute;
    inset: -3px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.vision-mission-card:hover .card-icon::before {
    opacity: 1;
}

.vision-mission-card:hover .card-icon {
    transform: scale(1.1) rotate(5deg);
}

.card-icon svg {
    width: 40px;
    height: 40px;
    fill: url(#icon-gradient);
}

/* Card Body */
.card-body {
    padding: 2.5rem;
    background: white;
}

.card-title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1.5rem;
    text-align: center;
    letter-spacing: -0.02em;
}

.card-divider {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
    margin: 0 auto 2rem;
}

.card-content {
    color: #475569;
    font-size: 1.05rem;
    line-height: 1.8;
    text-align: left;
}

/* Decorative Elements */
.floating-shapes {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 1;
    overflow: hidden;
}

.shape {
    position: absolute;
    opacity: 0.05;
}

.shape-1 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    top: 20%;
    left: -100px;
    animation: float-shape 20s infinite ease-in-out;
}

.shape-2 {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #764ba2, #f093fb);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    bottom: 10%;
    right: -50px;
    animation: float-shape 25s infinite ease-in-out reverse;
}

@keyframes float-shape {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(30px, -50px) rotate(90deg); }
    50% { transform: translate(-30px, -30px) rotate(180deg); }
    75% { transform: translate(50px, 30px) rotate(270deg); }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .cards-grid {
        grid-template-columns: 1fr;
        gap: 2.5rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0 6rem;
        background-attachment: scroll;
    }

    .school-logo {
        width: 100px;
        height: 100px;
        padding: 0.4rem;
    }

    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .content-section {
        margin-top: -3rem;
    }

    .cards-wrapper {
        padding: 0 1rem;
    }

    .cards-grid {
        gap: 2rem;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        font-size: 1.75rem;
    }
}

@media (max-width: 480px) {
    .card-icon-wrapper {
        padding: 2rem 0 1.25rem;
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
    }

    .card-icon svg {
        width: 30px;
        height: 30px;
    }

    .card-body {
        padding: 2rem 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
    }

    .card-content {
        font-size: 1rem;
    }
}

/* Print Styles */
@media print {
    .hero-section {
        background: white;
        color: black;
    }

    .vision-mission-card {
        box-shadow: none;
        border: 1px solid #e5e7eb;
        break-inside: avoid;
    }
}
</style>

<!-- SVG Gradients Definition -->
<svg width="0" height="0" style="position: absolute;">
    <defs>
        <linearGradient id="logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="icon-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
        </linearGradient>
    </defs>
</svg>

<!-- Floating Shapes Background -->
<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-pattern"></div>
    <div class="hero-gradient-orb orb-1"></div>
    <div class="hero-gradient-orb orb-2"></div>

    <div class="hero-content">
        <div class="container mx-auto px-4">
            <!-- School Logo -->
            <div class="school-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah">
            </div>

            <h1 class="hero-title">Visi & Misi</h1>
            <p class="hero-subtitle">Komitmen kami untuk menciptakan pendidikan berkualitas dan masa depan cemerlang</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section">
    <div class="cards-wrapper">
        <div class="cards-grid">
            <!-- Visi Card -->
            <article class="vision-mission-card">
                <div class="card-icon-wrapper">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="card-title">Visi</h2>
                    <div class="card-divider"></div>
                    <div class="card-content">
                        {{ $profile->vision ?? 'Visi sekolah belum diatur.' }}
                    </div>
                </div>
            </article>

            <!-- Misi Card -->
            <article class="vision-mission-card">
                <div class="card-icon-wrapper">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM6 20V4H13V9H18V20H6ZM8 12H16V14H8V12ZM8 16H13V18H8V16Z"/>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="card-title">Misi</h2>
                    <div class="card-divider"></div>
                    <div class="card-content">
                        {!! nl2br(e($profile->mission ?? 'Misi sekolah belum diatur.')) !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe cards
    const cards = document.querySelectorAll('.vision-mission-card');
    cards.forEach(card => observer.observe(card));

    // Enhanced parallax effect
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero-gradient-orb');

        parallaxElements.forEach((el, index) => {
            const speed = 0.5 + (index * 0.2);
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Card tilt effect on mouse move
    cards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * 5;
            const rotateY = ((centerX - x) / centerX) * 5;

            card.style.transform = `translateY(-10px) perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'translateY(0) perspective(1000px) rotateX(0deg) rotateY(0deg)';
        });
    });

    // Performance optimization
    let ticking = false;

    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                ticking = false;
            });
            ticking = true;
        }
    });
});
</script>
@endsection
