<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DashboardHeroWidget extends Widget
{
    // Arahkan ke file view yang akan kita buat
    protected static string $view = 'filament.widgets.dashboard-hero-widget';

    // PENTING: Agar widget ini melebar penuh (mengambil semua kolom grid)
    protected int | string | array $columnSpan = 'full'; 
}