<?php

namespace App\Filament\Pages;

use App\Models\Pasien;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ScanBarcode extends Page
{
    protected static ?string $title = 'Scan Barcode / QR';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $navigationLabel = 'Scan Barcode';

    protected static ?int $navigationSort = 3;

    public string $barcodeInput = '';

    public ?array $scannedPasien = null;

    public ?string $scanError = null;

    public string $filterStatus = 'all';

    public function getView(): string
    {
        return 'filament.pages.scan-barcode';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Scan Barcode / QR Pasien';
    }

    public function processScan(): void
    {
        $this->scanError   = null;
        $this->scannedPasien = null;

        $input = trim($this->barcodeInput);

        if ($input === '') {
            return;
        }

        $pasien = Pasien::where('qr_id', $input)->first();

        if (! $pasien) {
            $this->scanError = "QR / Barcode tidak ditemukan: \"{$input}\"";
            $this->barcodeInput = '';
            return;
        }

        $pasien->update(['status' => 'dipanggil']);

        $this->scannedPasien = [
            'id'           => $pasien->id,
            'queue_number' => $pasien->queue_number,
            'name'         => $pasien->name,
            'poli'         => $this->formatPoli($pasien->poli),
            'penjamin'     => $this->formatPenjamin($pasien->penjamin),
            'status'       => 'dipanggil',
            'nik'          => $pasien->nik,
            'phone'        => $pasien->phone,
        ];

        Notification::make()
            ->title("✅ Pasien Dipanggil: {$pasien->name}")
            ->body("No. Antrian: {$pasien->queue_number} • Poli: {$this->formatPoli($pasien->poli)}")
            ->success()
            ->duration(4000)
            ->send();

        $this->barcodeInput = '';
    }

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

    public function getStatisticsProperty(): array
    {
        $today = Pasien::whereDate('created_at', today());

        return [
            'total'     => (clone $today)->count(),
            'menunggu'  => (clone $today)->where('status', 'menunggu')->count(),
            'dipanggil' => (clone $today)->where('status', 'dipanggil')->count(),
            'selesai'   => (clone $today)->where('status', 'selesai')->count(),
        ];
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

    private function formatPenjamin(?string $penjamin): string
    {
        return match ($penjamin) {
            'bpjs'          => 'BPJS Kesehatan',
            'asuransi_lain' => 'Asuransi Lain',
            'umum'          => 'Umum',
            default         => $penjamin ?? '-',
        };
    }
    public function tandaiSelesai(int $id): void
    {
        Pasien::where('id', $id)->update(['status' => 'selesai']);

        Notification::make()
            ->title('✅ Status diperbarui: Selesai')
            ->success()
            ->duration(3000)
            ->send();
    }
}
