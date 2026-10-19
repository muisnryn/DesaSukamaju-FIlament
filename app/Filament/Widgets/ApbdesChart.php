<?php

namespace App\Filament\Widgets;

use App\Models\Apbdes;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\ChartWidget;

class ApbdesChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 3;

    // Set ke 1 agar ukuran simetris dengan grafik gender
    protected int | string | array $columnSpan = 1;

    public function getHeading(): ?string
    {
        $tahun = $this->filters['tahun'] ?? date('Y');
        return "Realisasi APBDes Tahun $tahun";
    }

    protected function getData(): array
    {
        $tahun = $this->filters['tahun'] ?? date('Y');
        $apbdes = Apbdes::where('tahun', $tahun)->first();
        
        // Casting ke integer agar Chart.js tidak bingung
        $pendapatan = (int) ($apbdes->total_pendapatan ?? 0);
        $belanja = (int) ($apbdes->total_belanja ?? 0);

        return [
            'datasets' => [
                [
                    'label' => 'Nominal (Rupiah)',
                    'data' => [$pendapatan, $belanja],
                    'backgroundColor' => ['#22c55e', '#ef4444'],
                    'borderRadius' => 8,
                ],
            ],
            'labels' => ['Total Pendapatan', 'Total Belanja'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}