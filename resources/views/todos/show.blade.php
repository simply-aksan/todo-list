@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')

    <div class="max-w-2xl mx-auto anim-fade-up">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('todos.index') }}"
               class="inline-flex items-center gap-2 text-xs font-semibold mb-4 text-gray-400 hover:text-rose-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-2 text-xs font-bold tracking-wider uppercase text-rose-500 mb-2">
                <span>ID #{{ $todo->id }}</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-white break-words tracking-tight leading-snug">
                {{ $todo->title }}
            </h1>
        </div>

        <!-- Status Card -->
        <div class="mb-6 p-4 rounded-2xl bg-white/[0.03] border border-white/10 flex items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold mb-1">
                    Status Pengerjaan
                </p>
                @if ($todo->is_completed)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/20 text-rose-400 border border-rose-500/30">
                        <span class="w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
                        Belum Selesai
                    </span>
                @endif
            </div>

            <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="px-3.5 py-2 rounded-xl text-xs font-semibold transition-all border cursor-pointer
                               {{ $todo->is_completed 
                                  ? 'bg-white/5 border-white/10 text-gray-300 hover:bg-white/10' 
                                  : 'bg-emerald-500/20 border-emerald-500/30 text-emerald-300 hover:bg-emerald-500/30' }}">
                    {{ $todo->is_completed ? 'Tandai Belum Selesai' : 'Tandai Selesai' }}
                </button>
            </form>
        </div>

        <!-- Deskripsi Card -->
        <div class="mb-6">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2.5">
                Deskripsi
            </h3>

            <div class="rounded-2xl p-5 bg-white/[0.02] border border-white/10 min-h-28">
                <p class="leading-relaxed whitespace-pre-line break-words text-sm {{ $todo->description ? 'text-gray-200' : 'text-gray-500 italic' }}">
                    {{ $todo->description ?: 'Tidak ada rincian deskripsi untuk tugas ini.' }}
                </p>
            </div>
        </div>

        <!-- Metadata Tanggal -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
            <div class="rounded-2xl p-4 bg-white/[0.02] border border-white/5">
                <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold mb-1">
                    Dibuat Pada
                </p>
                <p class="text-sm font-medium text-gray-200">
                    {{ $todo->created_at->translatedFormat('d F Y, H:i') }}
                </p>
            </div>

            <div class="rounded-2xl p-4 bg-white/[0.02] border border-white/5">
                <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold mb-1">
                    Terakhir Diperbarui
                </p>
                <p class="text-sm font-medium text-gray-200">
                    {{ $todo->updated_at->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 pt-6 border-t border-white/5">
            <a
                href="{{ route('todos.edit', $todo) }}"
                class="px-5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm inline-flex items-center gap-2 bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Tugas
            </a>

            <form action="{{ route('todos.destroy', $todo) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 transition-all cursor-pointer">
                    Hapus
                </button>
            </form>

            <a
                href="{{ route('todos.index') }}"
                class="ml-auto px-4 py-2.5 rounded-xl text-xs sm:text-sm font-medium text-gray-400 hover:text-white transition-colors">
                ← Kembali
            </a>
        </div>

    </div>

@endsection
