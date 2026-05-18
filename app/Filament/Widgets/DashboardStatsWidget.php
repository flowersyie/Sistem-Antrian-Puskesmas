<?php

namespace App\Filament\Widgets;

use App\Models\Pasien;
use Filament\Widgets\Widget;

class DashboardStatsWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-stats-widget';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function getStats(): array
    {
        $today = Pasien::whereDate('created_at', today());

        return [
            'total'     => (clone $today)->count(),
            'menunggu'  => (clone $today)->where('status', 'menunggu')->count(),
            'dipanggil' => (clone $today)->where('status', 'dipanggil')->count(),
            'selesai'   => (clone $today)->where('status', 'selesai')->count(),
        ];
    }
}
