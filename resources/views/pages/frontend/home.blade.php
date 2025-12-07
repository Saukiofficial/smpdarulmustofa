@extends('layouts.frontend')

@section('title', 'Selamat Datang di SMP DARUL MUSTOFA')

@push('styles')
<style>
    /* ========================================
       MODERN INTERNATIONAL SCHOOL DESIGN
       Professional & Clean UI
    ======================================== */

    :root {
        --primary: #1e40af;
        --primary-dark: #1e3a8a;
        --secondary: #059669;
        --accent: #f59e0b;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-light: #f9fafb;
        --bg-white: #ffffff;
        --border-color: #e5e7eb;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        overflow-x: hidden;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* ========================================
       HERO SECTION - Background Image Only
    ======================================== */
    .luxury-hero {
        position: relative;
        min-height: 85vh;
        background-image: url('{{ asset('images/gedung-sekolah.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.3) 100%);
    }

    .hero-particles {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 10% 20%, rgba(255,255,255,0.05) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(255,255,255,0.03) 0%, transparent 50%);
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 800;
        color: #ffffff;
        line-height: 1.15;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-title .highlight-text {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    .hero-subtitle {
        font-size: clamp(1.1rem, 2vw, 1.35rem);
        color: rgba(255, 255, 255, 0.95);
        line-height: 1.7;
        margin-bottom: 2.5rem;
        max-width: 600px;
        font-weight: 400;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: #ffffff;
        color: #1e40af;
        font-weight: 600;
        padding: 1.1rem 2.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: none;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        background: #f8fafc;
    }

    .btn-secondary {
        background: transparent;
        color: #ffffff;
        font-weight: 600;
        padding: 1.1rem 2.5rem;
        border-radius: 12px;
        border: 2px solid rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        font-size: 1rem;
        backdrop-filter: blur(10px);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
    }

    .hero-character {
        position: relative;
        animation: floatAnimation 6s ease-in-out infinite;
        max-width: 700px;
        width: 100%;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
    }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* Mobile Hero Optimization */
    @media (max-width: 768px) {
        .luxury-hero {
            min-height: auto;
            padding: 3rem 0 2rem;
        }

        .hero-bg-overlay {
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-title {
            font-size: 2rem;
            text-align: center;
        }

        .hero-subtitle {
            font-size: 1rem;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            justify-content: center;
            flex-direction: column;
        }

        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
            max-width: 300px;
            margin: 0 auto;
        }

        .hero-character {
            max-width: 280px;
            margin: 2rem auto 0;
            display: block;
        }
    }

    /* ========================================
       STATISTICS SECTION - Clean & Professional
    ======================================== */
    .stats-section {
        background: #ffffff;
        padding: 5rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1e40af, #3b82f6);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-color: #3b82f6;
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        color: #1e40af;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .stats-section {
            padding: 3rem 0;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }

    /* ========================================
       PRINCIPAL SECTION - Executive Style
    ======================================== */
    .principal-section {
        background: var(--bg-light);
        padding: 6rem 0;
    }

    .principal-card {
        background: #ffffff;
        border-radius: 5px;
        padding: 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .principal-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .principal-content {
        padding: 3rem;
    }

    .section-badge {
        background: #eff6ff;
        color: #1e40af;
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .principal-quote {
        font-size: 1.125rem;
        line-height: 1.8;
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-style: italic;
        position: relative;
        padding-left: 1.5rem;
        border-left: 4px solid #1e40af;
    }

    .principal-info {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 12px;
        border-left: 4px solid #059669;
    }

    .principal-name {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .principal-title {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .principal-section {
            padding: 4rem 0;
        }

        .principal-content {
            padding: 2rem;
        }
    }

    /* ========================================
       NEWS SECTION - Magazine Style
    ======================================== */
    .news-section {
        background: #ffffff;
        padding: 6rem 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
        max-width: 700px;
        margin: 1rem auto 0;
        line-height: 1.7;
    }

    .news-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .news-image-container {
        overflow: hidden;
        height: 240px;
        background: var(--bg-light);
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .news-card:hover .news-image {
        transform: scale(1.08);
    }

    .news-content {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .news-date {
        color: var(--secondary);
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .news-title {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-card:hover .news-title {
        color: #1e40af;
    }

    .news-excerpt {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-link {
        color: #1e40af;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .news-link:hover {
        gap: 0.75rem;
        color: #1e3a8a;
    }

    .news-link i {
        transition: transform 0.3s ease;
    }

    .news-card:hover .news-link i {
        transform: translateX(4px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-light);
        border-radius: 16px;
        border: 2px dashed var(--border-color);
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .view-all-btn {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: #ffffff;
        font-weight: 600;
        padding: 1.1rem 3rem;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.2);
        font-size: 1rem;
    }

    .view-all-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(30, 64, 175, 0.3);
    }

    .view-all-btn i {
        transition: transform 0.3s ease;
    }

    .view-all-btn:hover i {
        transform: translateX(4px);
    }

    @media (max-width: 768px) {
        .news-section {
            padding: 4rem 0;
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .news-content {
            padding: 1.5rem;
        }
    }

    /* ========================================
       UTILITY CLASSES
    ======================================== */
    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 1.5rem;
        }
    }

    /* Grid System */
    .grid {
        display: grid;
        gap: 2rem;
    }

    .grid-cols-1 {
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Focus Styles for Accessibility */
    a:focus, button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="luxury-hero">
        <div class="hero-bg-overlay"></div>
        <div class="hero-particles"></div>

        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2" style="align-items: center;">
                <!-- Content -->
                <div class="hero-content">
                    <h1 class="hero-title">
                        Iman, Ilmu, dan <span class="highlight-text">Ahlak</span><br>
                        Untuk Membentuk Karakter Generasi Emas
                    </h1>
                    <p class="hero-subtitle">
                        Membangun generasi unggul melalui pendidikan berkualitas yang mengintegrasikan nilai-nilai islami dengan pembelajaran modern.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('admission.index') }}" class="btn-primary">
                            <span>Daftar Sekarang</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('profile.vision-mission') }}" class="btn-secondary">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                <!-- Character Image -->
                <div style="justify-content: center; display: flex;">
                    <img src="{{ asset('images/siswasiswi.png') }}"
                         alt="Siswa SMP Darul Mustofa"
                         class="hero-character">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div class="stat-card">
                    <div class="stat-number counter" data-target="{{ $studentCount ?? 0 }}">0</div>
                    <p class="stat-label">Siswa Aktif</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number counter" data-target="{{ $teacherCount ?? 0 }}">0</div>
                    <p class="stat-label">Tenaga Pendidik</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number counter" data-target="{{ $extracurricularCount ?? 0 }}">0</div>
                    <p class="stat-label">Ekstrakurikuler</p>
                </div>
                <div class="stat-card">
                    <div class="stat-number counter" data-target="98">0%</div>
                    <p class="stat-label">Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Principal Message Section -->
    <section class="principal-section">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2" style="gap: 3rem; align-items: center;">
                <!-- Image -->
                <div>
                    <div class="principal-card">
                        <img src="{{ asset('images/kepalasekolah.jpg') }}"
                             alt="Kepala Sekolah SMP Darul Mustofa"
                             class="principal-image">
                    </div>
                </div>

                <!-- Content -->
                <div class="principal-content" style="padding: 0;">
                    <span class="section-badge">Sambutan Kepala Sekolah</span>
                    <h2 class="section-title">Visi Kepemimpinan untuk Pendidikan Berkualitas</h2>

                    <p class="principal-quote">
                        Mewujudkan generasi berkarakter unggul, melek teknologi, mandiri, dan berwawasan global, yang dilandasi nilai-nilai luhur dan lingkungan, untuk siap menghadapi tantangan masa depan.
                    </p>

                    <div class="principal-info">
                        <p class="principal-name">WIWIN WIDIYA WATI, S.Pd</p>
                        <p class="principal-title">Kepala Sekolah SMP Darul Mustofa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Berita & Informasi</span>
                <h2 class="section-title">Kabar Terbaru dari Sekolah</h2>
                <p class="section-subtitle">
                    Ikuti perkembangan kegiatan, prestasi, dan informasi terkini dari SMP Darul Mustofa
                </p>
            </div>

            @if($latestPosts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($latestPosts as $post)
                    <article class="news-card">
                        <a href="{{ route('posts.show', $post->slug) }}" class="news-image-container">
                            <img src="{{ $post->featured_image_path ? asset('storage/' . $post->featured_image_path) : 'https://placehold.co/600x400/e5e7eb/1e40af?text=SMP+Darul+Mustofa' }}"
                                 alt="{{ $post->title }}"
                                 class="news-image">
                        </a>
                        <div class="news-content">
                            <time class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </time>
                            <h3 class="news-title">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="news-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="news-link">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div style="text-align: center; margin-top: 3rem;">
                    <a href="{{ route('posts.index') }}" class="view-all-btn">
                        Lihat Semua Berita
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="far fa-newspaper"></i>
                    <p class="empty-state-title">Belum Ada Berita</p>
                    <p class="empty-state-text">Informasi terbaru akan segera hadir di sini</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 100;

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const isPercent = counter.innerText.includes('%');
            let count = 0;

            const updateCount = () => {
                const increment = target / speed;
                count += increment;

                if (count < target) {
                    counter.innerText = Math.ceil(count) + (isPercent ? '%' : '');
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target + (isPercent ? '%' : '');
                }
            };
            updateCount();
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Smooth scroll untuk semua anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endpush
