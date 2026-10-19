<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Demografi;
use App\Models\Umkm;
use Filament\Widgets\Concerns\InteractsWithPageFilters; // <--- Import ini
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters; // <--- Gunakan Trait ini

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Gunakan null coalescing yang lebih aman
        $tahun = $this->filters['tahun'] ?? date('Y');

        $demografi = Demografi::where('tahun', $tahun)->first();
        $totalPenduduk = $demografi->total_penduduk ?? 0;

        $beritaCount = Berita::whereYear('created_at', $tahun)
            ->where('status', 'published')
            ->count();

        return [
            Stat::make('Total Penduduk', (string) $totalPenduduk)
                ->description("Data Tahun $tahun")
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 10, 5, 15, 8, 20]),

            Stat::make('UMKM Terdaftar', Umkm::count())
                ->description('Total Akumulasi')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('primary'),

            Stat::make('Kabar Desa', $beritaCount)
                ->description("Artikel di tahun $tahun")
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),
        ];
    }
}