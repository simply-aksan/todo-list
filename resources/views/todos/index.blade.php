@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')

    @php
        $total = $todos->count();
        $completedCount = $todos->where('is_completed', true)->count();
        $pendingCount = $total - $completedCount;
    @endphp

    <!-- Header & Summary Stats -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 pb-7 border-b border-white/5 anim-fade-up">
        <div>
            <div class="flex items-center gap-3 mb-1.5">
                <span class="w-2.5 h-8 rounded-full bg-gradient-to-b from-rose-500 to-rose-700 inline-block"></span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Daftar Tugas
                </h1>
            </div>
            <p class="text-sm text-gray-400 pl-5">
                Kelola dan pantau aktivitas harianmu dengan rapi & produktif.
            </p>
        </div>

        <!-- Quick Summary Cards -->
        <div class="flex items-center gap-3">
            <div class="bg-white/5 border border-white/10 rounded-2xl px-4 py-2.5 text-center min-w-[80px]">
                <div class="text-xl font-bold text-white leading-tight">{{ $total }}</div>
                <div class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Total</div>
            </div>
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl px-4 py-2.5 text-center min-w-[80px]">
                <div class="text-xl font-bold text-emerald-400 leading-tight">{{ $completedCount }}</div>
                <div class="text-[11px] uppercase tracking-wider text-emerald-300/80 font-semibold">Selesai</div>
            </div>
            <div class="bg-rose-500/10 border border-rose-500/20 rounded-2xl px-4 py-2.5 text-center min-w-[80px]">
                <div class="text-xl font-bold text-rose-400 leading-tight">{{ $pendingCount }}</div>
                <div class="text-[11px] uppercase tracking-wider text-rose-300/80 font-semibold">Tertunda</div>
            </div>
        </div>
    </div>

    <!-- List Tugas -->
    <div class="space-y-3.5">
        @forelse ($todos as $todo)
            <article class="card-dark rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 anim-fade-up group">
                
                <!-- Kiri: Tombol Toggle Cepat + Info -->
                <div class="flex items-start sm:items-center gap-4 flex-1 min-w-0">
                    
                    <!-- Quick Toggle Checkbox Form -->
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="flex-shrink-0 mt-0.5 sm:mt-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                title="{{ $todo->is_completed ? 'Klik untuk tandai belum selesai' : 'Klik untuk tandai selesai' }}"
                                class="w-7 h-7 rounded-lg flex items-center justify-center transition-all duration-200 border cursor-pointer
                                       {{ $todo->is_completed 
                                          ? 'bg-emerald-500/20 border-emerald-500 text-emerald-400 hover:bg-emerald-500/30 shadow-sm shadow-emerald-500/20' 
                                          : 'bg-white/5 border-white/20 text-transparent hover:border-rose-400 hover:text-rose-400/40' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 {{ $todo->is_completed ? '' : 'stroke-current' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </form>

                    <!-- Info Judul & Badge -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-base font-semibold truncate transition-colors duration-150 {{ $todo->is_completed ? 'line-through text-gray-500' : 'text-gray-100 group-hover:text-rose-300' }}">
                                <a href="{{ route('todos.show', $todo) }}">
                                    {{ $todo->title }}
                                </a>
                            </h2>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-400">
                            @if ($todo->is_completed)
                                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-rose-400 bg-rose-500/10 px-2 py-0.5 rounded-md border border-rose-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-ping"></span>
                                    Belum Selesai
                                </span>
                            @endif

                            <span>&bull;</span>
                            <span>{{ $todo->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                </div>

                <!-- Kanan: Tombol Tindakan -->
                <div class="flex items-center gap-2 self-end sm:self-center pl-11 sm:pl-0">
                    <a href="{{ route('todos.show', $todo) }}"
                       class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        Detail
                    </a>

                    <a href="{{ route('todos.edit', $todo) }}"
                       class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-amber-500/10 border border-amber-500/20 text-amber-300 hover:bg-amber-500/20 transition-colors">
                        Edit
                    </a>

                    <form action="{{ route('todos.destroy', $todo) }}"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-300 hover:bg-rose-500/20 transition-colors cursor-pointer">
                            Hapus
                        </button>
                    </form>
                </div>

            </article>
        @empty
            <!-- Empty State -->
            <div class="text-center py-16 px-4 rounded-3xl border border-dashed border-white/10 bg-white/[0.02] anim-fade-up">
                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center bg-rose-500/10 border border-rose-500/20 text-rose-400 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-white mb-1.5">
                    Belum Ada Tugas
                </h3>
                <p class="text-sm text-gray-400 max-w-sm mx-auto mb-6">
                    Aktivitasmu masih kosong. Yuk buat tugas pertama sekarang agar hari-harimu lebih tertata!
                </p>

                <a href="{{ route('todos.create') }}"
                   class="btn-gradient text-white px-6 py-3 rounded-xl font-semibold inline-flex items-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Tugas Baru
                </a>
            </div>
        @endforelse
    </div>

@endsection
