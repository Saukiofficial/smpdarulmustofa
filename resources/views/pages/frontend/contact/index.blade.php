@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@push('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .contact-page {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        min-height: 100vh;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.8; }
        50% { transform: translateY(-20px) rotate(180deg); opacity: 1; }
    }

    .contact-content {
        position: relative;
        z-index: 2;
    }

    .page-header {
        text-align: center;
        margin-bottom: 4rem;
        animation: fadeInUp 1s ease-out;
    }

    .page-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .contact-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 32px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow:
            0 32px 64px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        overflow: hidden;
        animation: slideInUp 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        transform-style: preserve-3d;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .contact-container:hover {
        transform: translateY(-8px) rotateX(2deg);
        box-shadow:
            0 40px 80px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }

    .form-section {
        padding: 3rem;
        position: relative;
    }

    .form-section::after {
        content: '';
        position: absolute;
        top: 10%;
        right: 0;
        width: 1px;
        height: 80%;
        background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .form-group:nth-child(2) { animation-delay: 0.1s; }
    .form-group:nth-child(3) { animation-delay: 0.2s; }
    .form-group:nth-child(4) { animation-delay: 0.3s; }
    .form-group:nth-child(5) { animation-delay: 0.4s; }
    .form-group:nth-child(6) { animation-delay: 0.5s; }

    .form-label {
        display: block;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        letter-spacing: 0.025em;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        color: white;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        outline: none;
    }

    .form-input::placeholder, .form-textarea::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-input:focus, .form-textarea:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow:
            0 0 0 4px rgba(255, 255, 255, 0.1),
            0 8px 32px rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .submit-btn {
        width: 100%;
        padding: 1.25rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 16px;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:active {
        transform: translateY(-1px);
    }

    .info-section {
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        padding: 3rem;
        display: flex;
        flex-direction: column;
    }

    .contact-info {
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        animation: fadeInRight 0.8s ease-out forwards;
        opacity: 0;
        transform: translateX(30px);
    }

    .info-item:nth-child(1) { animation-delay: 0.2s; }
    .info-item:nth-child(2) { animation-delay: 0.3s; }
    .info-item:nth-child(3) { animation-delay: 0.4s; }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(-5px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .info-icon {
        width: 24px;
        height: 24px;
        margin-right: 1rem;
        color: #67e8f9;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-text {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        flex: 1;
    }

    .map-section {
        flex: 1;
    }

    .map-title {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1.5s ease-out;
        height: 300px;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        filter: contrast(1.1) saturate(1.2);
        transition: filter 0.4s ease;
    }

    .map-container:hover iframe {
        filter: contrast(1.2) saturate(1.3);
    }

    /* Success Alert Styling */
    .success-alert {
        background: rgba(16, 185, 129, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: rgba(255, 255, 255, 0.9);
        padding: 1rem 1.25rem;
        border-radius: 16px;
        margin-bottom: 1.5rem;
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(60px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .form-section::after {
            display: none;
        }

        .form-section, .info-section {
            padding: 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .form-section, .info-section {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="contact-page py-16">
    <div class="particles" id="particles"></div>

    <div class="contact-content">
        <div class="container mx-auto px-6">
            <div class="page-header">
                <h1 class="page-title">Hubungi Kami</h1>
                <p class="page-subtitle">Terhubung dengan tim kami untuk pertanyaan, dukungan, atau kolaborasi yang menginspirasi.</p>
            </div>

            <div class="contact-container">
                <div class="contact-grid">
                    {{-- Form Kontak --}}
                    <div class="form-section">
                        <h2 class="section-title">Kirim Pesan</h2>

                        {{-- Notifikasi Sukses --}}
                        @if (session('success'))
                            <div class="success-alert" role="alert">
                                <strong class="font-bold">Sukses!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-input" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" id="email" name="email" class="form-input" placeholder="nama@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="form-label">Subjek</label>
                                <input type="text" id="subject" name="subject" class="form-input" placeholder="Subjek pesan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Pesan Anda</label>
                                <textarea id="message" name="message" rows="5" class="form-textarea" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Info & Peta --}}
                    <div class="info-section">
                        <h2 class="section-title">Informasi Kontak</h2>
                        <div class="contact-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt info-icon"></i>
                                <span class="info-text">Jln. KH MOCH CHOLIL no 1 TUNJUNG BURNEH BANGKALAN</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone info-icon"></i>
                                <span class="info-text">0313099995 / 082334423433</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope info-icon"></i>
                                <span class="info-text">smpdarulmustofa@gmail.com</span>
                            </div>
                        </div>
                        <div class="map-section">
                            <h3 class="map-title">Lokasi Kami</h3>
                            <div class="map-container">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18787.91053082581!2d112.7577623096664!3d-7.045510091539838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd80500627bda49%3A0xd95f72716314d014!2sPondok%20Pesantren%20Darul%20Mustofa!5e1!3m2!1sid!2sid!4v1759541693015!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';


                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';


                particle.style.animationDelay = Math.random() * 6 + 's';


                const size = Math.random() * 3 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                particlesContainer.appendChild(particle);
            }
        }

        createParticles();


        const inputs = document.querySelectorAll('.form-input, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'translateY(0)';
            });
        });


        const submitBtn = document.querySelector('.submit-btn');
        submitBtn.addEventListener('click', function(e) {

            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i>Mengirim...';
            this.disabled = true;


            setTimeout(() => {
                this.disabled = false;
            }, 100);
        });


        const contactContainer = document.querySelector('.contact-container');
        contactContainer.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;

            const rotateX = (y - 0.5) * 10;
            const rotateY = (x - 0.5) * -10;

            this.style.transform = `translateY(-8px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        contactContainer.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0deg) rotateY(0deg)';
        });
    });
</script>
@endpush
