<x-filament::section class="border-l-4 border-primary-500">
    <div class="flex items-center gap-x-4">
        {{-- Ikon / Avatar --}}
        <div class="hidden md:flex h-16 w-16 items-center justify-center rounded-full bg-primary-50 text-primary-600 dark:bg-primary-900/20 dark:text-primary-400">
            <x-heroicon-o-home-modern class="h-10 w-10" />
        </div>

        <div class="flex-1">
            {{-- Ucapan Selamat Datang Dinamis --}}
            <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                Selamat Datang, {{ auth()->user()->name }}!
            </h2>
            
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Anda sedang mengakses <span class="font-medium text-primary-600 dark:text-primary-400">Panel Admin Desa Sukamaju</span>. 
                Semoga harimu menyenangkan dan produktif.
            </p>
        </div>
        
        {{-- Jam / Tanggal (Opsional) --}}
        <div class="hidden text-right sm:block">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hari ini</p>
            <p class="text-xl font-bold text-gray-950 dark:text-white">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
    </div>
</x-filament::section>