
<footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-blue-900 text-white relative overflow-hidden">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-600/20 to-transparent"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-blue-400/10 rounded-full"></div>
    </div>

    <div class="container mx-auto px-6 py-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">

            <div class="lg:col-span-2 space-y-6">

                <div class="flex items-center space-x-4 mb-6">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/logo.png') }}" alt="SMP DARUL MUSTOFA Logo"
                             class="h-16 w-16 object-contain bg-white/10 rounded-full p-2 backdrop-blur-sm">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">SMP DARUL MUSTOFA</h2>
                        <p class="text-blue-300 font-medium">Unggul dalam Prestasi, Berkarakter Mulia</p>
                    </div>
                </div>


                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10">
                    <h3 class="text-xl font-semibold mb-4 text-blue-300">Tentang Sekolah</h3>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        SMP DARUL MUSTOFA berkomitmen untuk menyediakan pendidikan kejuruan berkualitas yang menginspirasi
                        siswa untuk mencapai potensi penuh mereka. Dengan fasilitas modern, teknologi terkini, dan
                        staf pengajar yang berdedikasi tinggi.
                    </p>
                    <div class="flex items-center text-sm text-blue-300">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        <span>Menciptakan lulusan yang kompeten dan siap kerja</span>
                    </div>
                </div>


                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-blue-300">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="group relative">
                            <div class="bg-blue-600 hover:bg-blue-500 p-3 rounded-full transition-all duration-300
                                      group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-blue-500/25">
                                <i class="fab fa-facebook-f text-white"></i>
                            </div>
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400
                                       opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Facebook</span>
                        </a>
                        <a href="#" class="group relative">
                            <div class="bg-pink-600 hover:bg-pink-500 p-3 rounded-full transition-all duration-300
                                      group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-pink-500/25">
                                <i class="fab fa-instagram text-white"></i>
                            </div>
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400
                                       opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Instagram</span>
                        </a>
                        <a href="#" class="group relative">
                            <div class="bg-red-600 hover:bg-red-500 p-3 rounded-full transition-all duration-300
                                      group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-red-500/25">
                                <i class="fab fa-youtube text-white"></i>
                            </div>
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400
                                       opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">YouTube</span>
                        </a>
                        <a href="#" class="group relative">
                            <div class="bg-blue-400 hover:bg-blue-300 p-3 rounded-full transition-all duration-300
                                      group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-blue-400/25">
                                <i class="fab fa-twitter text-white"></i>
                            </div>
                            <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400
                                       opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Twitter</span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="space-y-6">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10 h-fit">
                    <h3 class="text-xl font-semibold mb-6 text-blue-300 flex items-center">
                        <i class="fas fa-link mr-2"></i>
                        Tautan Cepat
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('profile.facilities') }}"
                               class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-building mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Fasilitas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}"
                               class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-newspaper mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Berita Terbaru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admission.index') }}"
                               class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-user-plus mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Pendaftaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}"
                               class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-envelope mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Hubungi Kami</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-users mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Alumni</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-blue-300 transition-all duration-300
                                      group hover:translate-x-2">
                                <i class="fas fa-calendar-alt mr-3 text-blue-400 group-hover:text-blue-300"></i>
                                <span>Agenda Sekolah</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="space-y-6">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10 h-fit">
                    <h3 class="text-xl font-semibold mb-6 text-blue-300 flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </h3>
                    <ul class="space-y-4">
                        <li class="group">
                            <div class="flex items-start text-gray-300 group-hover:text-blue-300 transition-colors">
                                <div class="bg-blue-600/20 p-2 rounded-lg mr-3 mt-1 group-hover:bg-blue-600/30 transition-colors">
                                    <i class="fas fa-map-marker-alt text-blue-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-300 mb-1">Alamat</p>
                                    <p class="text-sm leading-relaxed">
                                      JL. KH MOCH CHOLIL no 1 TUNJUNG BURNEH BANGKALAN
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="group">
                            <div class="flex items-center text-gray-300 group-hover:text-blue-300 transition-colors">
                                <div class="bg-blue-600/20 p-2 rounded-lg mr-3 group-hover:bg-blue-600/30 transition-colors">
                                    <i class="fas fa-phone text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-blue-300">Telepon</p>
                                    <a href="tel:081232916758" class="text-sm hover:underline"> 0313099995 / 082334423433</a>
                                </div>
                            </div>
                        </li>
                        <li class="group">
                            <div class="flex items-center text-gray-300 group-hover:text-blue-300 transition-colors">
                                <div class="bg-blue-600/20 p-2 rounded-lg mr-3 group-hover:bg-blue-600/30 transition-colors">
                                    <i class="fas fa-envelope text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-blue-300">Email</p>
                                    <a href="mailto:kontak@SMP DARUL MUSTOFAch.id" class="text-sm hover:underline">smpdarulmustofa@gmail.com</a>
                                </div>
                            </div>
                        </li>
                        <li class="group">
                            <div class="flex items-center text-gray-300 group-hover:text-blue-300 transition-colors">
                                <div class="bg-blue-600/20 p-2 rounded-lg mr-3 group-hover:bg-blue-600/30 transition-colors">
                                    <i class="fas fa-clock text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-blue-300">Jam Operasional</p>
                                    <p class="text-sm">Senin - sabtu: 07:00 - 13.00</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="border-t border-white/10 bg-black/20 backdrop-blur-sm">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-center md:text-left">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} SMP DARUL MUSTOFA. Semua Hak Cipta Dilindungi.
                    </p>
                    <p class="text-gray-500 text-xs mt-1">
                        Developed by kyysolutions
                    </p>
                </div>
                <div class="flex items-center space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-400 hover:text-blue-300 transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .float-animation {
        animation: float 6s ease-in-out infinite;
    }

    .nav-link {
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 50%;
        background: linear-gradient(90deg, #3B82F6, #1E40AF);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
</style>
