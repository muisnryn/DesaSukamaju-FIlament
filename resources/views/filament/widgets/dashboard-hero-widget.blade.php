<x-filament::section class="border-l-4 border-primary-500">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between sm:gap-x-6">
        {{-- Ikon / Avatar --}}
        <div class="flex items-center gap-x-4">
            <div class="hidden h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary-50 text-primary-600 dark:bg-primary-900/20 dark:text-primary-400 md:flex">
                <x-heroicon-o-home-modern class="h-10 w-10" />
            </div>

            {{-- Ucapan Selamat Datang Dinamis --}}
            <div>
                <h2 class="text-xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-2xl">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Anda sedang mengakses <span class="font-medium text-primary-600 dark:text-primary-400">Panel Admin Desa Sukamaju</span>.
                    Semoga harimu menyenangkan dan produktif.
                </p>
            </div>
        </div>

        {{-- Jam / Tanggal (Opsional) --}}
        <div class="text-left sm:shrink-0 sm:text-right">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hari ini</p>
            <p class="text-xl font-bold text-gray-950 dark:text-white">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
    </div>
</x-filament::section>