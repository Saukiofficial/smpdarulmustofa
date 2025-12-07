@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
   
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-7xl mx-auto mb-8">

        <!-- Card Total Berita -->
        <div class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-blue-100">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <p class="text-blue-700 text-xs font-semibold tracking-wide uppercase">Total Berita</p>
                    </div>
                    <p class="text-3xl lg:text-4xl font-bold text-blue-900 mb-1">{{ $postCount ?? 0 }}</p>
                    <p class="text-xs text-blue-600">Artikel yang dipublikasi</p>
                </div>
                <div class="bg-blue-500 bg-opacity-10 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl p-3 ml-4">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card Pendaftar Baru -->
        <div class="group bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                        <p class="text-orange-700 text-xs font-semibold tracking-wide uppercase">Pendaftar Baru</p>
                    </div>
                    <p class="text-3xl lg:text-4xl font-bold text-orange-900 mb-1">{{ $pendingAdmissionCount ?? 0 }}</p>
                    <p class="text-xs text-orange-600">Calon siswa bulan ini</p>
                </div>
                <div class="bg-orange-500 bg-opacity-10 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl p-3 ml-4">
                    <i class="fas fa-user-plus text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Guru -->
        <div class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-green-100">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <p class="text-green-700 text-xs font-semibold tracking-wide uppercase">Jumlah Guru</p>
                    </div>
                    <p class="text-3xl lg:text-4xl font-bold text-green-900 mb-1">{{ $teacherCount ?? 0 }}</p>
                    <p class="text-xs text-green-600">Tenaga pengajar aktif</p>
                </div>
                <div class="bg-green-500 bg-opacity-10 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl p-3 ml-4">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Siswa -->
        <div class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-purple-100">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        <p class="text-purple-700 text-xs font-semibold tracking-wide uppercase">Jumlah Siswa</p>
                    </div>
                    <p class="text-3xl lg:text-4xl font-bold text-purple-900 mb-1">{{ $studentCount ?? 0 }}</p>
                    <p class="text-xs text-purple-600">Siswa terdaftar</p>
                </div>
                <div class="bg-purple-500 bg-opacity-10 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl p-3 ml-4">
                    <i class="fas fa-user-graduate text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto space-y-6">

        <div class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 rounded-3xl p-8 shadow-2xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-1">Analytics Dashboard</h2>
                        <p class="text-purple-200">Statistik dan Data Siswa Real-time</p>
                    </div>
                </div>
                <div class="relative">
                    <select id="classroomFilter" class="bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent block w-full px-4 py-3 pr-10 appearance-none">
                        <option selected value="all" class="bg-slate-800">🏫 Semua Kelas</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom }}" class="bg-slate-800">📚 {{ $classroom }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-white/60"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">

            <div id="barChartContainer" class="xl:col-span-3">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-bar text-white text-sm"></i>
                            </div>
                            <h3 id="barChartTitle" class="text-lg font-semibold text-white">Distribusi Siswa per Kelas</h3>
                        </div>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-gray-50 to-white">
                        <div class="relative h-80">
                            <canvas id="studentsByClassChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <div id="genderChartContainer" class="xl:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 h-full">
                    <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-venus-mars text-white text-sm"></i>
                            </div>
                            <h3 id="genderChartTitle" class="text-lg font-semibold text-white">Komposisi Gender</h3>
                        </div>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-gray-50 to-white flex-1">
                        <div class="relative h-80">
                            <canvas id="genderChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Siswa Aktif</p>
                        <p id="totalStudentsDisplay" class="text-3xl font-bold mt-1">{{ $studentCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium">Siswa Laki-laki</p>
                        <p id="maleStudentsDisplay" class="text-3xl font-bold mt-1">{{ $maleCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-male text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm font-medium">Siswa Perempuan</p>
                        <p id="femaleStudentsDisplay" class="text-3xl font-bold mt-1">{{ $femaleCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-female text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        let allStudents = @json($allStudents);
        const classrooms = @json($classrooms);


        allStudents = allStudents.map(student => {
            let normalizedGender = null;
            if (student.gender && typeof student.gender === 'string') {
                const lowerCaseGender = student.gender.toLowerCase().trim();

                if (lowerCaseGender === 'l' || lowerCaseGender.startsWith('laki')) {
                    normalizedGender = 'Laki-laki';
                } else if (lowerCaseGender === 'p' || lowerCaseGender.startsWith('perempuan')) {
                    normalizedGender = 'Perempuan';
                }
            }

            return { ...student, gender: normalizedGender };
        });


        const initialMaleCount = allStudents.filter(s => s.gender === 'Laki-laki').length;
        const initialFemaleCount = allStudents.filter(s => s.gender === 'Perempuan').length;


        document.getElementById('maleStudentsDisplay').textContent = initialMaleCount;
        document.getElementById('femaleStudentsDisplay').textContent = initialFemaleCount;


        const createGradient = (ctx, colorStart, colorEnd) => {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, colorStart);
            gradient.addColorStop(1, colorEnd);
            return gradient;
        };

        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['👨‍🎓 Laki-laki', '👩‍🎓 Perempuan'],
                datasets: [{
                    label: 'Jenis Kelamin',
                    data: [initialMaleCount, initialFemaleCount],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.9)', // blue-500
                        'rgba(236, 72, 153, 0.9)', // pink-500
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(236, 72, 153, 1)',
                    ],
                    borderWidth: 3,
                    hoverOffset: 8,
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 13, weight: '600' },
                            color: '#374151'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#F9FAFB',
                        bodyColor: '#F9FAFB',
                        borderColor: 'rgba(209, 213, 219, 0.2)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                if (total === 0) return `${context.label}: 0 siswa (0%)`;
                                const percentage = ((context.parsed * 100) / total).toFixed(1);
                                return `${context.label}: ${context.parsed} siswa (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: { animateRotate: true, duration: 2000, easing: 'easeInOutQuart' }
            }
        });

        // --- Konfigurasi Diagram Siswa per Kelas (Bar Chart) ---
        const studentsByClassCtx = document.getElementById('studentsByClassChart').getContext('2d');
        const studentsByClassChart = new Chart(studentsByClassCtx, {
            type: 'bar',
            data: {
                labels: classrooms,
                datasets: [{
                    label: '👥 Jumlah Siswa',
                    data: [],
                    backgroundColor: function(context) {
                        const {ctx, chartArea} = context.chart;
                        if (!chartArea) return null;
                        return createGradient(ctx, 'rgba(99, 102, 241, 0.9)', 'rgba(139, 92, 246, 0.9)');
                    },
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        titleColor: '#F9FAFB',
                        bodyColor: '#F9FAFB',
                        borderColor: 'rgba(209, 213, 219, 0.2)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        callbacks: {
                            title: function(context) { return `Kelas ${context[0].label}`; },
                            label: function(context) { return `Jumlah siswa: ${context.parsed.y} orang`; }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { if (value % 1 === 0) return value; },
                            color: '#6B7280',
                            font: { size: 12, weight: '500' }
                        },
                        grid: { color: 'rgba(209, 213, 219, 0.3)', drawBorder: false }
                    },
                    x: {
                        ticks: { color: '#6B7280', font: { size: 12, weight: '600' } },
                        grid: { display: false, drawBorder: false }
                    }
                },
                animation: { duration: 2000, easing: 'easeInOutQuart' },
                interaction: { intersect: false, mode: 'index' }
            }
        });


        function updateCharts(filter) {
            let filteredStudents = allStudents;
            if (filter !== 'all') {
                filteredStudents = allStudents.filter(student => student.classroom === filter);
            }

            // Update summary cards
            const maleCount = filteredStudents.filter(s => s.gender === 'Laki-laki').length;
            const femaleCount = filteredStudents.filter(s => s.gender === 'Perempuan').length;
            document.getElementById('totalStudentsDisplay').textContent = filteredStudents.length;
            document.getElementById('maleStudentsDisplay').textContent = maleCount;
            document.getElementById('femaleStudentsDisplay').textContent = femaleCount;

            // Update gender chart
            genderChart.data.datasets[0].data = [maleCount, femaleCount];
            document.getElementById('genderChartTitle').textContent = `Komposisi Gender (${filter === 'all' ? 'Semua' : filter})`;
            genderChart.update();

            // Update bar chart
            const barChartTitle = document.getElementById('barChartTitle');
            if (filter === 'all') {
                barChartTitle.textContent = 'Distribusi Siswa per Kelas';
                const studentCountsByClass = classrooms.map(classroom => {
                    return allStudents.filter(student => student.classroom === classroom).length;
                });
                studentsByClassChart.data.labels = classrooms;
                studentsByClassChart.data.datasets[0].data = studentCountsByClass;
            } else {
                barChartTitle.textContent = `Distribusi Siswa Kelas ${filter}`;
                studentsByClassChart.data.labels = [filter];
                studentsByClassChart.data.datasets[0].data = [filteredStudents.length];
            }
            studentsByClassChart.update();
        }


        document.getElementById('classroomFilter').addEventListener('change', function(e) {
            updateCharts(e.target.value);
        });


        updateCharts('all');
    });
</script>

<style>

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

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }


    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }


    .chart-container {
        transition: all 0.3s ease;
    }

    .chart-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
