<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApbdesChart;
use App\Filament\Widgets\DashboardHeroWidget;
use App\Filament\Widgets\GenderChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('tahun')
                            ->label('Periode Tahun')
                            ->options(function () {
                                $year = (int) date('Y');

                                return [
                                    $year => (string) $year,
                                    $year - 1 => (string) ($year - 1),
                                    $year - 2 => (string) ($year - 2),
                                ];
                            })
                            ->default(date('Y'))
                            ->native(false),
                    ])
                    ->columns(3),
            ]);
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            GenderChart::class,
            ApbdesChart::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            DashboardHeroWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 1;
    }
}
