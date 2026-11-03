<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daftar Tugas') — Todo App</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        crimson: {
                            50:  '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                        },
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ── Glass & Cards ── */
        .glass-panel {
            background: rgba(18, 18, 20, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .card-dark {
            background: linear-gradient(145deg, rgba(26, 26, 30, 0.9), rgba(18, 18, 20, 0.95));
            border: 1px solid rgba(255, 255, 255, 0.07);
            transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
        }
        .card-dark:hover {
            border-color: rgba(244, 63, 94, 0.4);
            box-shadow: 0 10px 30px -10px rgba(225, 29, 72, 0.2), 0 0 1px 1px rgba(244, 63, 94, 0.2);
            transform: translateY(-2px);
        }

        /* ── Modern Gradient Buttons ── */
        .btn-gradient {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%);
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35);
            transition: all 0.25s cubic-bezier(.4,0,.2,1);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #fb7185 0%, #f43f5e 50%, #e11d48 100%);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.5);
            transform: translateY(-1px) scale(1.01);
        }
        .btn-gradient:active {
            transform: translateY(0) scale(0.98);
        }

        /* ── Input Styling ── */
        .input-dark {
            background-color: rgba(24, 24, 28, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f3f4f6;
            transition: all 0.2s ease;
        }
        .input-dark:focus {
            border-color: #f43f5e;
            box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.2);
            outline: none;
        }

        /* ── Animated Background Glow ── */
        .ambient-glow {
            position: fixed;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 350px;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.15) 0%, rgba(225, 29, 72, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Top Bar Animation ── */
        @keyframes stripeSlide {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .stripe-anim {
            background: linear-gradient(90deg, #f43f5e, #be123c, #fb7185, #e11d48);
            background-size: 300% 300%;
            animation: stripeSlide 5s ease infinite;
        }

        /* ── Animations ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim-fade-up {
            animation: fadeSlideUp 0.4s cubic-bezier(.4, 0, .2, 1) both;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col relative text-gray-200 antialiased" style="background-color: #0b0b0e;">

    <!-- Background decorative glow -->
    <div class="ambient-glow"></div>

    <!-- Top accent rainbow/gradient stripe -->
    <div class="stripe-anim h-1 w-full relative z-10"></div>

    <!-- Navbar -->
    <header class="sticky top-0 z-30 glass-panel border-b border-white/5">
        <div class="max-w-5xl mx-auto px-5 sm:px-8 py-3.5 flex items-center justify-between">
            <a href="{{ route('todos.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center btn-gradient text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <span class="text-lg font-bold text-white tracking-tight group-hover:text-rose-400 transition-colors">
                        TodoList
                    </span>
                    <span class="text-xs text-gray-400 block -mt-0.5 font-medium">Herd Local &bull; Laravel</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('todos.create') }}"
                   class="btn-gradient text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Tugas</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 w-full max-w-5xl mx-auto px-5 sm:px-8 py-8 relative z-10">

        <!-- Flash Messages -->
        @if (session('success'))
            <div role="status"
                 class="mb-6 rounded-2xl px-5 py-4 text-sm font-medium flex items-center gap-3 anim-fade-up bg-emerald-950/60 border border-emerald-500/30 text-emerald-300 shadow-lg shadow-emerald-950/30">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center flex-shrink-0 text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="flex-1">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div role="alert"
                 class="mb-6 rounded-2xl px-5 py-4 text-sm anim-fade-up bg-rose-950/60 border border-rose-500/30 text-rose-300 shadow-lg shadow-rose-950/30">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-rose-500/20 flex items-center justify-center flex-shrink-0 text-rose-400 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <strong class="font-semibold block mb-1">Periksa isian formulir:</strong>
                        <ul class="list-disc list-inside space-y-1 text-xs sm:text-sm text-rose-200/90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Card Container -->
        <div class="glass-panel rounded-3xl p-6 sm:p-9 shadow-2xl relative overflow-hidden">
            @yield('content')
        </div>

    </main>

    <!-- Footer -->
    <footer class="glass-panel border-t border-white/5 py-5 text-center relative z-10 mt-auto">
        <div class="max-w-5xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 font-medium">
            <p>&copy; {{ date('Y') }} Todo List App &middot; Herd Local Dev</p>
            <p class="flex items-center gap-1.5">
                <span>Built with</span>
                <span class="text-rose-500">&hearts;</span>
                <span>Laravel & Tailwind CSS</span>
            </p>
        </div>
    </footer>

    <div class="stripe-anim h-0.5 w-full relative z-10"></div>

</body>
</html>
