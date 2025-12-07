@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
        min-height: 100vh;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e2e8f0' fill-opacity='0.3'%3E%3Ccircle cx='40' cy='40' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 1;
    }

    .py-16 {
        position: relative;
        z-index: 2;
        padding: 4rem 0;
    }

    .professional-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.5);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .professional-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: rgba(99, 102, 241, 0.2);
    }

    .lg\\:col-span-2.professional-card {
        padding: 3rem;
    }

    .professional-card h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: #1e293b;
        background: linear-gradient(135deg, #1e293b 0%, #3730a3 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .meta-info {
        color: #64748b !important;
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .meta-info span {
        background: #f1f5f9;
        color: #475569;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .meta-info span:hover {
        background: #e2e8f0;
        transform: translateY(-1px);
    }

    .professional-card img:not(.sidebar img) {
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
    }

    .professional-card img:hover:not(.sidebar img) {
        transform: scale(1.02);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .prose {
        color: #374151 !important;
        font-size: 1.125rem;
        line-height: 1.7;
    }

    .prose p {
        margin-bottom: 1.5rem;
    }

    .prose strong {
        color: #1f2937;
        font-weight: 600;
    }

    .prose h2, .prose h3, .prose h4 {
        color: #1e293b;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .prose a {
        color: #3730a3;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.2s ease;
    }

    .prose a:hover {
        border-bottom-color: #3730a3;
    }

    .lg\\:col-span-1 .professional-card {
        padding: 2rem;
    }

    .sidebar h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
        color: #1e293b;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sidebar li {
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
        cursor: pointer;
        padding: 1rem;
    }

    .sidebar li:hover {
        background: #f1f5f9;
        transform: translateX(4px);
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .sidebar img {
        width: 5rem;
        height: 5rem;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }

    .sidebar li:hover img {
        transform: scale(1.05);
    }

    .sidebar .font-semibold {
        color: #1e293b !important;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .sidebar li:hover .font-semibold {
        color: #3730a3 !important;
    }

    .sidebar .text-sm {
        color: #64748b !important;
        font-size: 0.875rem;
    }

    .sidebar a {
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar a:hover {
        color: inherit;
    }

    @media (max-width: 1024px) {
        .grid-cols-1.lg\\:grid-cols-3 {
            gap: 2rem;
        }
        .professional-card {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .py-16 {
            padding: 2rem 0;
        }
        .professional-card {
            padding: 1.5rem !important;
            border-radius: 12px;
        }
        .professional-card h1 {
            font-size: 2rem;
        }
        .meta-info {
            flex-direction: column;
            gap: 0.5rem;
        }
        .sidebar li {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }
        .sidebar img {
            width: 100%;
            height: 8rem;
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .professional-card {
            padding: 1rem !important;
        }
        .professional-card h1 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        .prose {
            font-size: 1rem;
        }
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #64748b, #475569);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #475569, #334155);
    }

    .professional-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .lg\\:col-span-2 {
        animation-delay: 0.1s;
    }

    .lg\\:col-span-1 {
        animation-delay: 0.2s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .professional-card:focus-within {
        outline: 2px solid #3730a3;
        outline-offset: 2px;
    }

    .sidebar a:focus,
    .sidebar li:focus {
        outline: 2px solid #3730a3;
        outline-offset: 2px;
        border-radius: 8px;
    }

    @media print {
        body::before,
        .sidebar {
            display: none;
        }
        .professional-card {
            box-shadow: none;
            border: 1px solid #000;
        }
        .lg\\:col-span-2 {
            grid-column: span 3;
        }
    }
</style>

<div class="py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Konten Utama Berita --}}
            <div class="lg:col-span-2 professional-card">
                <h1>{{ $post->title }}</h1>
                <div class="meta-info mb-6">
                    <span>Dipublikasikan pada: {{ \Carbon\Carbon::parse($post->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                    <span>Oleh: {{ $post->author->name }}</span>
                </div>
                @if($post->featured_image_path)
                <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="{{ $post->title }}" class="w-full rounded-md mb-8">
                @endif
                <div class="prose max-w-none">
                    {!! $post->content !!}
                </div>
            </div>

            {{-- Sidebar Berita Terbaru --}}
            <div class="lg:col-span-1 sidebar">
                <div class="professional-card">
                    <h3 class="text-2xl font-bold mb-6 border-b pb-4">Berita Lainnya</h3>
                    <ul class="space-y-4">
                        @forelse ($latestPosts as $latestPost)
                        <li class="flex items-center space-x-4">
                             <a href="{{ route('posts.show', $latestPost->slug) }}">
                                <img src="{{ $latestPost->featured_image_path ? asset('storage/' . $latestPost->featured_image_path) : 'https://placehold.co/100x100/e2e8f0/6366f1?text=Thumb' }}" class="w-20 h-20 rounded-md object-cover">
                            </a>
                            <div>
                                <a href="{{ route('posts.show', $latestPost->slug) }}" class="font-semibold text-gray-800 hover:text-indigo-600">{{ $latestPost->title }}</a>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($latestPost->published_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
                            </div>
                        </li>
                        @empty
                        <p class="text-gray-500">Tidak ada berita lain.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
