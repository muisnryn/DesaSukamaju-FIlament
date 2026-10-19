<?php

namespace App\Filament\Widgets;

use App\Models\Demografi;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\ChartWidget;

class GenderChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Komposisi Gender Penduduk';
    protected static ?int $sort = 2;
    
    // Set ke 1 agar sama besar dengan grafik di sebelahnya
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $tahun = $this->filters['tahun'] ?? date('Y');
        $data = Demografi::where('tahun', $tahun)->first();

        // Pastikan data selalu array angka, bukan null
        $laki = (int) ($data->total_laki_laki ?? 0);
        $perempuan = (int) ($data->total_perempuan ?? 0);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => [$laki, $perempuan],
                    'backgroundColor' => ['#3b82f6', '#ec4899'],
                    'borderColor' => 'transparent',
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'cutout' => '60%',
        ];
    }
}