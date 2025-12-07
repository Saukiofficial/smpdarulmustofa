<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-touch-fullscreen" content="yes">

    <title>@yield('title', 'SMP DARUL MUSTAFA')</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />


    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <style>

        * {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        html {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;

            cursor: auto;

            padding: env(safe-area-inset-top) env(safe-area-inset-right) env(safe-area-inset-bottom) env(safe-area-inset-left);
        }


        @media (min-width: 1024px) {
            body {
                cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><circle cx="16" cy="16" r="10" stroke="%23667eea" stroke-width="2" fill="none"/></svg>') 16 16, auto;
            }

            a, button, input[type="submit"], .stat-item, [onclick] {
                cursor: url("{{ asset('images/cursor-pointer.png') }}") 4 0, pointer !important;
            }
        }


        @media (max-width: 768px) {

            .principal-card {
                transform: none !important;
            }

            .principal-image {
                transform: none !important;
            }


            .stat-card,
            .program-card,
            .testimonial-card,
            .principal-card {
                background: rgba(255, 255, 255, 0.9) !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
            }


            .luxury-hero {
                overflow: hidden;
                min-height: auto !important;
            }


            .hero-particles,
            .testimonial-card::before {
                display: none !important;
            }


            .hero-title {
                -webkit-text-fill-color: white !important;
                background: none !important;
                color: white !important;
            }

            .highlight-text {
                -webkit-text-fill-color: #ffd89b !important;
                background: none !important;
                color: #ffd89b !important;
            }

            .stat-number {
                -webkit-text-fill-color: #667eea !important;
                background: none !important;
                color: #667eea !important;
            }
        }


        @media (max-width: 480px) {

            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }


            .luxury-hero {
                padding: 3rem 0 2rem !important;
            }

            .hero-title {
                font-size: 2rem !important;
                line-height: 1.2 !important;
                margin-bottom: 1rem !important;
            }

            .hero-subtitle {
                font-size: 1rem !important;
                margin-bottom: 2rem !important;
            }


            .hero-buttons {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }

            .btn-primary,
            .btn-secondary {
                width: 100% !important;
                max-width: none !important;
                padding: 0.875rem 1.5rem !important;
                font-size: 0.9rem !important;
            }

                   .stat-card,
            .program-card,
            .news-card,
            .testimonial-card {
                margin-bottom: 1rem !important;
                border-radius: 1rem !important;
                padding: 1.5rem !important;
            }


            .grid {
                gap: 1rem !important;
            }

            .section-title {
                font-size: 1.875rem !important;
                line-height: 1.3 !important;
            }

            .section-subtitle {
                font-size: 1rem !important;
                line-height: 1.5 !important;
            }


            .stat-number {
                font-size: 2.5rem !important;
            }

            .stat-label {
                font-size: 0.9rem !important;
            }


            .program-icon {
                width: 60px !important;
                height: 60px !important;
                font-size: 1.5rem !important;
            }


            .news-image {
                height: 200px !important;
            }
        }


        @supports (padding: env(safe-area-inset-top)) {
            body {
                padding-top: env(safe-area-inset-top);
                padding-bottom: env(safe-area-inset-bottom);
            }

            .luxury-hero {
                padding-top: calc(3rem + env(safe-area-inset-top));
            }
        }


        @media (max-width: 768px) {
            .loading-shimmer {
                animation: none !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-inter text-gray-800">

    @include('layouts.partials.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.partials.footer')


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);

            if (isIOS) {

                document.body.classList.add('ios-device');


                const setViewportHeight = () => {
                    document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`);
                };

                setViewportHeight();
                window.addEventListener('resize', setViewportHeight);
                window.addEventListener('orientationchange', setViewportHeight);


                let lastTouchEnd = 0;
                document.addEventListener('touchend', function (event) {
                    const now = (new Date()).getTime();
                    if (now - lastTouchEnd <= 300) {
                        event.preventDefault();
                    }
                    lastTouchEnd = now;
                }, false);
            }


            const counters = document.querySelectorAll('.counter');
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {

                counters.forEach(counter => {
                    const target = counter.getAttribute('data-target');
                    const isPercent = counter.innerText.includes('%');
                    counter.innerText = target + (isPercent ? '%' : '');
                });
            } else {

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
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
