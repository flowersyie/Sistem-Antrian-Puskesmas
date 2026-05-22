<?php

namespace App\Filament\Pages;

use App\Models\Pasien;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class DataPasien extends Page
{

    protected static ?string $title = 'Data Pasien Terdaftar';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Data Pasien';

    public function getView(): string
    {
        return 'filament.pages.data-pasien';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Data Pasien Terdaftar';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public function getPoliSummaryProperty(): array
    {
        $poliLabels = [
            'umum'   => 'Poli Umum',
            'gigi'   => 'Poli Gigi',
            'anak'   => 'Poli Anak',
            'kia'    => 'Poli KIA / KB',
            'lansia' => 'Poli Lansia',
            'jiwa'   => 'Poli Jiwa',
            'gizi'   => 'Poli Gizi',
            'mata'   => 'Poli Mata',
            'tht'    => 'Poli THT',
        ];

        $grouped = Pasien::whereDate('created_at', today())
            ->orderBy('queue_number')
            ->get()
            ->groupBy('poli');

        $result = [];
        foreach ($poliLabels as $key => $label) {
            if ($grouped->has($key)) {
                $result[$key] = [
                    'label'    => $label,
                    'patients' => $grouped[$key],
                ];
            }
        }

        return $result;
    }
}
