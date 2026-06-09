<header x-data="{ open: false }" class="dm-header">
    <style>
        :root {
            --dm-navy: #061b36;
            --dm-navy-2: #09284d;
            --dm-gold: #dba52d;
            --dm-gold-2: #f0c45a;
            --dm-white: #ffffff;
            --dm-text: #10213d;
            --dm-muted: #516174;
            --dm-border: rgba(6, 27, 54, 0.10);
        }

        .dm-header {
            position: sticky;
            top: 0;
            z-index: 999;
            background: #ffffff;
            box-shadow: 0 14px 40px rgba(6, 27, 54, 0.10);
        }

        .dm-header-container {
            width: min(100% - 36px, 1500px);
            margin-inline: auto;
        }

        .dm-topbar {
            background: linear-gradient(90deg, #061b36 0%, #09284d 50%, #061b36 100%);
            color: #ffffff;
            border-bottom: 1px solid rgba(219, 165, 45, 0.20);
        }

        .dm-topbar-inner {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            font-size: 14px;
        }

        .dm-topbar-left,
        .dm-topbar-right,
        .dm-topbar-item,
        .dm-socials {
            display: flex;
            align-items: center;
        }

        .dm-topbar-left {
            gap: 28px;
        }

        .dm-topbar-right {
            gap: 18px;
        }

        .dm-topbar-item {
            gap: 9px;
            color: rgba(255, 255, 255, 0.94);
            white-space: nowrap;
        }

        .dm-topbar-item svg {
            width: 16px;
            height: 16px;
            color: #ffffff;
        }

        .dm-accreditation {
            color: rgba(255, 255, 255, 0.96);
            font-weight: 500;
            white-space: nowrap;
        }

        .dm-socials {
            gap: 12px;
        }

        .dm-social-link {
            display: inline-grid;
            place-items: center;
            width: 18px;
            height: 18px;
            color: #ffffff;
            opacity: 0.95;
            transition: 0.25s ease;
        }

        .dm-social-link:hover {
            color: var(--dm-gold-2);
            transform: translateY(-2px);
        }

        .dm-social-link svg {
            width: 17px;
            height: 17px;
        }

        .dm-navbar {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(6, 27, 54, 0.08);
        }

        .dm-nav-inner {
            min-height: 128px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .dm-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 330px;
            flex-shrink: 0;
        }

        .dm-logo-wrap {
            position: relative;
            width: 78px;
            height: 78px;
            display: grid;
            place-items: center;
        }

        .dm-logo-glow {
            position: absolute;
            inset: 8px;
            border-radius: 999px;
            background: rgba(219, 165, 45, 0.20);
            filter: blur(16px);
            opacity: 0.85;
        }

        .dm-logo {
            position: relative;
            z-index: 2;
            width: 72px;
            height: 72px;
            object-fit: contain;
            filter: drop-shadow(0 8px 14px rgba(6, 27, 54, 0.18));
        }

        .dm-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.12;
        }

        .dm-brand-title {
            color: var(--dm-navy);
            font-size: clamp(22px, 1.7vw, 31px);
            font-weight: 900;
            letter-spacing: -0.7px;
            white-space: nowrap;
        }

        .dm-brand-subtitle {
            color: #405cff;
            font-size: clamp(14px, 0.95vw, 17px);
            font-weight: 500;
            margin-top: 6px;
            white-space: nowrap;
        }

        .dm-desktop-menu {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 22px;
            flex: 1;
        }

        .dm-nav-link,
        .dm-nav-button {
            position: relative;
            min-height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 14px;
            border-radius: 8px;
            color: var(--dm-text);
            font-size: 16px;
            font-weight: 600;
            line-height: 1;
            transition: 0.25s ease;
            border: 0;
            background: transparent;
            cursor: pointer;
            white-space: nowrap;
        }

        .dm-nav-link:hover,
        .dm-nav-button:hover {
            color: var(--dm-gold);
        }

        .dm-nav-link.is-active,
        .dm-nav-button.is-active {
            color: #ffffff;
            background: linear-gradient(180deg, #082241 0%, #061b36 100%);
            box-shadow: 0 12px 24px rgba(6, 27, 54, 0.22);
        }

        .dm-nav-link.is-active::after,
        .dm-nav-button.is-active::after {
            content: "";
            position: absolute;
            left: 8px;
            right: 8px;
            bottom: -4px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--dm-gold), var(--dm-gold-2));
            box-shadow: 0 6px 12px rgba(219, 165, 45, 0.35);
        }

        .dm-chevron {
            width: 15px;
            height: 15px;
            transition: 0.25s ease;
        }

        .dm-dropdown {
            position: relative;
        }

        .dm-dropdown-panel {
            position: absolute;
            top: calc(100% + 14px);
            left: 0;
            width: 260px;
            padding: 10px;
            background: #ffffff;
            border: 1px solid rgba(6, 27, 54, 0.08);
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(6, 27, 54, 0.18);
            overflow: hidden;
            z-index: 1000;
        }

        .dm-dropdown-panel.right {
            left: auto;
            right: 0;
        }

        .dm-dropdown-title {
            padding: 10px 12px 12px;
            color: var(--dm-gold);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid rgba(6, 27, 54, 0.08);
            margin-bottom: 8px;
        }

        .dm-dropdown-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            border-radius: 12px;
            color: var(--dm-text);
            font-size: 14px;
            font-weight: 600;
            transition: 0.22s ease;
        }

        .dm-dropdown-link svg {
            width: 18px;
            height: 18px;
            color: var(--dm-gold);
            flex-shrink: 0;
        }

        .dm-dropdown-link:hover {
            color: var(--dm-navy);
            background: rgba(219, 165, 45, 0.12);
            transform: translateX(3px);
        }

        .dm-login-desktop {
            flex-shrink: 0;
        }

        .dm-login-btn {
            min-width: 150px;
            min-height: 68px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 0 28px;
            border-radius: 12px;
            color: #ffffff;
            background: linear-gradient(180deg, #082241 0%, #061b36 100%);
            border: 1px solid rgba(219, 165, 45, 0.78);
            font-size: 18px;
            font-weight: 800;
            box-shadow:
                0 16px 32px rgba(6, 27, 54, 0.26),
                0 0 0 1px rgba(219, 165, 45, 0.18);
            transition: 0.28s ease;
        }

        .dm-login-btn svg {
            width: 19px;
            height: 19px;
            color: var(--dm-gold);
        }

        .dm-login-btn:hover {
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow:
                0 22px 42px rgba(6, 27, 54, 0.34),
                0 0 0 1px rgba(219, 165, 45, 0.32);
            border-color: var(--dm-gold-2);
        }

        .dm-mobile-toggle {
            display: none;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            border: 1px solid rgba(6, 27, 54, 0.12);
            background: #ffffff;
            color: var(--dm-navy);
            align-items: center;
            justify-content: center;
            transition: 0.25s ease;
        }

        .dm-mobile-toggle:hover {
            background: rgba(219, 165, 45, 0.12);
            color: var(--dm-gold);
        }

        .dm-hamburger {
            width: 24px;
            height: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dm-hamburger span {
            display: block;
            height: 2px;
            width: 100%;
            border-radius: 999px;
            background: currentColor;
            transition: 0.25s ease;
        }

        .dm-mobile-menu {
            display: none;
            padding: 10px 0 22px;
            border-top: 1px solid rgba(6, 27, 54, 0.08);
            background: #ffffff;
        }

        .dm-mobile-list {
            display: grid;
            gap: 6px;
        }

        .dm-mobile-link,
        .dm-mobile-section-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            border-radius: 12px;
            color: var(--dm-text);
            font-size: 15px;
            font-weight: 700;
            transition: 0.22s ease;
        }

        .dm-mobile-link svg {
            width: 20px;
            height: 20px;
            color: var(--dm-gold);
        }

        .dm-mobile-link:hover,
        .dm-mobile-section-link:hover,
        .dm-mobile-link.is-active {
            background: rgba(219, 165, 45, 0.13);
            color: var(--dm-navy);
        }

        .dm-mobile-section {
            padding-top: 12px;
        }

        .dm-mobile-heading {
            padding: 8px 16px;
            color: var(--dm-gold);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .dm-mobile-section-link {
            padding-left: 34px;
            font-size: 14px;
            color: var(--dm-muted);
        }

        .dm-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: var(--dm-gold);
        }

        .dm-mobile-login {
            margin-top: 16px;
        }

        .dm-mobile-login .dm-login-btn {
            width: 100%;
            min-height: 54px;
            font-size: 16px;
        }

        .dm-mobile-socials {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid rgba(6, 27, 54, 0.08);
        }

        .dm-mobile-social-title {
            color: var(--dm-muted);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 12px;
        }

        .dm-mobile-social-row {
            display: flex;
            gap: 10px;
        }

        .dm-mobile-social-link {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            color: var(--dm-navy);
            background: rgba(219, 165, 45, 0.12);
            transition: 0.22s ease;
        }

        .dm-mobile-social-link:hover {
            color: var(--dm-gold);
            background: rgba(6, 27, 54, 0.06);
        }

        .dm-mobile-social-link svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 1280px) {
            .dm-header-container {
                width: min(100% - 28px, 1240px);
            }

            .dm-nav-inner {
                gap: 20px;
            }

            .dm-brand {
                min-width: 300px;
            }

            .dm-logo-wrap {
                width: 68px;
                height: 68px;
            }

            .dm-logo {
                width: 64px;
                height: 64px;
            }

            .dm-brand-title {
                font-size: 24px;
            }

            .dm-brand-subtitle {
                font-size: 14px;
            }

            .dm-desktop-menu {
                gap: 10px;
            }

            .dm-nav-link,
            .dm-nav-button {
                font-size: 14px;
                padding: 0 10px;
            }

            .dm-login-btn {
                min-width: 132px;
                min-height: 58px;
                font-size: 16px;
                padding: 0 22px;
            }
        }

        @media (max-width: 1024px) {
            .dm-topbar {
                display: none;
            }

            .dm-nav-inner {
                min-height: 92px;
            }

            .dm-brand {
                min-width: 0;
            }

            .dm-logo-wrap {
                width: 60px;
                height: 60px;
            }

            .dm-logo {
                width: 56px;
                height: 56px;
            }

            .dm-brand-title {
                font-size: 20px;
            }

            .dm-brand-subtitle {
                font-size: 13px;
            }

            .dm-desktop-menu,
            .dm-login-desktop {
                display: none;
            }

            .dm-mobile-toggle {
                display: inline-flex;
            }

            .dm-mobile-menu {
                display: block;
            }
        }

        @media (max-width: 640px) {
            .dm-header-container {
                width: min(100% - 22px, 1500px);
            }

            .dm-nav-inner {
                min-height: 82px;
            }

            .dm-logo-wrap {
                width: 54px;
                height: 54px;
            }

            .dm-logo {
                width: 50px;
                height: 50px;
            }

            .dm-brand {
                gap: 10px;
            }

            .dm-brand-title {
                font-size: 17px;
                letter-spacing: -0.3px;
            }

            .dm-brand-subtitle {
                font-size: 12px;
                margin-top: 4px;
            }

            .dm-mobile-toggle {
                width: 42px;
                height: 42px;
            }
        }

        @media (max-width: 390px) {
            .dm-brand-title {
                font-size: 15px;
            }

            .dm-brand-subtitle {
                font-size: 11px;
            }

            .dm-logo-wrap {
                width: 48px;
                height: 48px;
            }

            .dm-logo {
                width: 46px;
                height: 46px;
            }
        }
    </style>

    <!-- Top Bar -->
    <div class="dm-topbar">
        <div class="dm-header-container">
            <div class="dm-topbar-inner">
                <div class="dm-topbar-left">
                    <div class="dm-topbar-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>(031) 3099995</span>
                    </div>

                    <div class="dm-topbar-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>smpdarulmustofa@gmail.com</span>
                    </div>
                </div>

                <div class="dm-topbar-right">
                    <span class="dm-accreditation">Akreditasi: A</span>

                    <div class="dm-socials">
                        <a href="#" class="dm-social-link" aria-label="Facebook">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        <a href="#" class="dm-social-link" aria-label="Instagram">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 5.838c-2.209 0-4 1.791-4 4s1.791 4 4 4 4-1.79 4-4-1.791-4-4-4zm6.406-1.683c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>

                        <a href="#" class="dm-social-link" aria-label="YouTube">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="dm-navbar">
        <div class="dm-header-container">
            <div class="dm-nav-inner">
                <!-- Logo dan Nama Sekolah -->
                <a href="{{ route('home') }}" class="dm-brand">
                    <div class="dm-logo-wrap">
                        <div class="dm-logo-glow"></div>
                        <img src="{{ asset('images/logo.png') }}"
                             onerror="this.src='https://placehold.co/72x72/061b36/dba52d?text=DM'"
                             alt="Logo SMP Darul Mustofa"
                             class="dm-logo">
                    </div>

                    <div class="dm-brand-text">
                        <span class="dm-brand-title">SMP DARUL MUSTOFA</span>
                        <span class="dm-brand-subtitle">Excellence in Education</span>
                    </div>
                </a>

                <!-- Navigasi Desktop -->
                <div class="dm-desktop-menu">
                    <a href="{{ route('home') }}"
                       class="dm-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">
                        Home
                    </a>

                    <!-- Dropdown Profil -->
                    <div x-data="{ dropdownOpen: false }" class="dm-dropdown">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="dm-nav-button {{ request()->routeIs('profile.*') ? 'is-active' : '' }}">
                            Profil
                            <svg class="dm-chevron" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen"
                             @click.away="dropdownOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                             class="dm-dropdown-panel right"
                             style="display: none;">
                            <div class="dm-dropdown-title">Tentang Kami</div>

                            <a href="{{ route('profile.vision-mission') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Visi & Misi
                            </a>

                            <a href="{{ route('profile.history') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Sejarah
                            </a>

                            <a href="{{ route('profile.organization') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"></path>
                                </svg>
                                Struktur Organisasi
                            </a>

                            <a href="{{ route('profile.facilities') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M5 21V7l8-4 8 4v14"></path>
                                </svg>
                                Fasilitas
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown Kesiswaan -->
                    <div x-data="{ dropdownOpen: false }" class="dm-dropdown">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="dm-nav-button {{ request()->routeIs('pages.*') ? 'is-active' : '' }}">
                            Kesiswaan
                            <svg class="dm-chevron" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen"
                             @click.away="dropdownOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                             class="dm-dropdown-panel"
                             style="display: none;">
                            <div class="dm-dropdown-title">Siswa & Organisasi</div>

                            <a href="{{ route('pages.teachers') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"></path>
                                </svg>
                                Dewan Guru
                            </a>

                            <a href="{{ route('pages.osis') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengurus OSIS
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('academic.calendar') }}"
                       class="dm-nav-link {{ request()->routeIs('academic.*') ? 'is-active' : '' }}">
                        Akademik
                    </a>

                    <a href="{{ route('posts.index') }}"
                       class="dm-nav-link {{ request()->routeIs('posts.*') ? 'is-active' : '' }}">
                        Berita
                    </a>

                    <a href="{{ route('gallery.index') }}"
                       class="dm-nav-link {{ request()->routeIs('gallery.*') ? 'is-active' : '' }}">
                        Galeri
                    </a>

                    <!-- Dropdown Alumni -->
                    <div x-data="{ dropdownOpen: false }" class="dm-dropdown">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="dm-nav-button {{ request()->routeIs('alumni.*') || request()->routeIs('pages.alumni-board') ? 'is-active' : '' }}">
                            Alumni
                            <svg class="dm-chevron" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen"
                             @click.away="dropdownOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                             class="dm-dropdown-panel"
                             style="display: none;">
                            <div class="dm-dropdown-title">Komunitas Alumni</div>

                            <a href="{{ route('alumni.index') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0"></path>
                                </svg>
                                Jejak Alumni
                            </a>

                            <a href="{{ route('pages.alumni-board') }}" class="dm-dropdown-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1"></path>
                                </svg>
                                Pengurus Alumni
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('contact.index') }}"
                       class="dm-nav-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}">
                        Kontak
                    </a>
                </div>

                <!-- Login Desktop -->
                <div class="dm-login-desktop">
                    <a href="{{ route('login') }}" class="dm-login-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a4 4 0 118 0v4m-9 0h10a1 1 0 011 1v8a1 1 0 01-1 1H11a1 1 0 01-1-1v-8a1 1 0 011-1z"></path>
                        </svg>
                        Login
                    </a>
                </div>

                <!-- Mobile Toggle -->
                <button @click="open = !open" class="dm-mobile-toggle" aria-label="Menu">
                    <span class="dm-hamburger">
                        <span :class="{ 'rotate-45 translate-y-2': open }"></span>
                        <span :class="{ 'opacity-0': open }"></span>
                        <span :class="{ '-rotate-45 -translate-y-2': open }"></span>
                    </span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="dm-mobile-menu"
                 style="display: none;">
                <div class="dm-mobile-list">
                    <a href="{{ route('home') }}" class="dm-mobile-link {{ request()->routeIs('home') ? 'is-active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3"></path>
                        </svg>
                        Home
                    </a>

                    <div class="dm-mobile-section">
                        <div class="dm-mobile-heading">Profil Sekolah</div>

                        <a href="{{ route('profile.vision-mission') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Visi & Misi
                        </a>

                        <a href="{{ route('profile.history') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Sejarah
                        </a>

                        <a href="{{ route('profile.organization') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Struktur Organisasi
                        </a>

                        <a href="{{ route('profile.facilities') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Fasilitas
                        </a>
                    </div>

                    <div class="dm-mobile-section">
                        <div class="dm-mobile-heading">Kesiswaan</div>

                        <a href="{{ route('pages.teachers') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Dewan Guru
                        </a>

                        <a href="{{ route('pages.osis') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Pengurus OSIS
                        </a>
                    </div>

                    <a href="{{ route('academic.calendar') }}" class="dm-mobile-link {{ request()->routeIs('academic.*') ? 'is-active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13M4 19.5A2.5 2.5 0 016.5 17H20"></path>
                        </svg>
                        Akademik
                    </a>

                    <a href="{{ route('posts.index') }}" class="dm-mobile-link {{ request()->routeIs('posts.*') ? 'is-active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10"></path>
                        </svg>
                        Berita
                    </a>

                    <a href="{{ route('gallery.index') }}" class="dm-mobile-link {{ request()->routeIs('gallery.*') ? 'is-active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"></path>
                        </svg>
                        Galeri
                    </a>

                    <div class="dm-mobile-section">
                        <div class="dm-mobile-heading">Alumni</div>

                        <a href="{{ route('alumni.index') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Jejak Alumni
                        </a>

                        <a href="{{ route('pages.alumni-board') }}" class="dm-mobile-section-link">
                            <span class="dm-dot"></span>
                            Pengurus Alumni
                        </a>
                    </div>

                    <a href="{{ route('contact.index') }}" class="dm-mobile-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"></path>
                        </svg>
                        Kontak
                    </a>

                    <div class="dm-mobile-login">
                        <a href="{{ route('login') }}" class="dm-login-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a4 4 0 118 0v4m-9 0h10a1 1 0 011 1v8a1 1 0 01-1 1H11a1 1 0 01-1-1v-8a1 1 0 011-1z"></path>
                            </svg>
                            Login
                        </a>
                    </div>

                    <div class="dm-mobile-socials">
                        <p class="dm-mobile-social-title">Ikuti Kami</p>

                        <div class="dm-mobile-social-row">
                            <a href="#" class="dm-mobile-social-link" aria-label="Facebook">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669"></path>
                                </svg>
                            </a>

                            <a href="#" class="dm-mobile-social-link" aria-label="Instagram">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919"></path>
                                </svg>
                            </a>

                            <a href="#" class="dm-mobile-social-link" aria-label="YouTube">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>