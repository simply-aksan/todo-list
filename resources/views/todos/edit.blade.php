@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')

    <div class="max-w-2xl mx-auto anim-fade-up">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('todos.index') }}"
               class="inline-flex items-center gap-2 text-xs font-semibold mb-4 text-gray-400 hover:text-amber-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-3">
                <span class="w-2.5 h-7 rounded-full bg-gradient-to-b from-amber-400 to-amber-600 inline-block"></span>
                <h1 class="text-2xl font-bold text-white tracking-tight">
                    Edit Tugas
                </h1>
            </div>
            <p class="text-sm mt-1.5 pl-5 text-gray-400">
                Perbarui detail judul, catatan tugas, atau status penyelesaian.
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-semibold mb-2 text-gray-200">
                    Judul Tugas <span class="text-rose-500">*</span>
                </label>

                <input
                    id="title"
                    name="title"
                    type="text"
                    maxlength="255"
                    value="{{ old('title', $todo->title) }}"
                    required
                    class="w-full px-4 py-3.5 rounded-2xl input-dark text-sm placeholder-gray-500 transition-all">

                @error('title')
                    <p class="text-xs text-rose-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold mb-2 text-gray-200">
                    Deskripsi
                    <span class="font-normal text-xs text-gray-500">(Opsional)</span>
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    maxlength="5000"
                    placeholder="Tuliskan catatan tugas..."
                    class="w-full px-4 py-3.5 rounded-2xl input-dark text-sm placeholder-gray-500 transition-all resize-y">{{ old('description', $todo->description) }}</textarea>

                @error('description')
                    <p class="text-xs text-rose-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="rounded-2xl p-4 bg-white/[0.03] border border-white/10 hover:border-white/15 transition-colors">
                <input type="hidden" name="is_completed" value="0">
                <label class="flex items-center gap-3.5 cursor-pointer">
                    <input
                        type="checkbox"
                        name="is_completed"
                        value="1"
                        @checked(old('is_completed', $todo->is_completed))
                        class="w-5 h-5 rounded-lg accent-rose-600 cursor-pointer">

                    <div>
                        <span class="block text-sm font-medium text-gray-200">Sudah Selesai</span>
                        <span class="text-xs text-gray-500">Beri centang jika pekerjaan ini telah terselesaikan.</span>
                    </div>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl font-semibold text-sm cursor-pointer inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-white shadow-lg shadow-amber-500/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('todos.index') }}"
                    class="px-5 py-3 rounded-xl text-sm font-medium bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 transition-colors">
                    Batal
                </a>
            </div>

        </form>

    </div>

@endsection
