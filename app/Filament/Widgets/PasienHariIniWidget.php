<?php

namespace App\Filament\Widgets;

use App\Models\Pasien;
use Filament\Widgets\Widget;

class PasienHariIniWidget extends Widget
{
    protected string $view = 'filament.widgets.pasien-hari-ini-widget';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '5s';

    public string $filterStatus = 'all';

    public function getPasienListProperty(): \Illuminate\Database\Eloquent\Collection
    {
        $query = Pasien::query()
            ->whereDate('created_at', today())
            ->orderByRaw("FIELD(status, 'dipanggil', 'menunggu', 'selesai', 'batal')")
            ->orderBy('queue_number');

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        return $query->get();
    }

    public function getCountByStatus(): array
    {
        $today = Pasien::whereDate('created_at', today());
        return [
            'all'       => (clone $today)->count(),
            'menunggu'  => (clone $today)->where('status', 'menunggu')->count(),
            'dipanggil' => (clone $today)->where('status', 'dipanggil')->count(),
            'selesai'   => (clone $today)->where('status', 'selesai')->count(),
        ];
    }

    public function tandaiSelesai(int $id): void
    {
        Pasien::where('id', $id)->update(['status' => 'selesai']);
    }

    private function formatPoli(string $poli): string
    {
        return match ($poli) {
            'umum'   => 'Poli Umum',
            'gigi'   => 'Poli Gigi',
            'anak'   => 'Poli Anak',
            'kia'    => 'Poli KIA / KB',
            'lansia' => 'Poli Lansia',
            'jiwa'   => 'Poli Jiwa',
            'gizi'   => 'Poli Gizi',
            'mata'   => 'Poli Mata',
            'tht'    => 'Poli THT',
            default  => $poli,
        };
    }
}
