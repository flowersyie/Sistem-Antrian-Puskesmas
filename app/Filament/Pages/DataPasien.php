<?php

namespace App\Filament\Pages;

use App\Models\Pasien;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class DataPasien extends Page implements HasTable
{
    use InteractsWithTable;

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

    public function table(Table $table): Table
    {
        return $table
            ->query(Pasien::query()->latest())
            ->columns([
                TextColumn::make('queue_number')
                    ->label('No. Antrian')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => (string) $state)
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('No. HP')
                    ->toggleable(),

                TextColumn::make('poli')
                    ->label('Poli')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'umum'   => 'Poli Umum',
                        'gigi'   => 'Poli Gigi',
                        'anak'   => 'Poli Anak',
                        'kia'    => 'Poli KIA / KB',
                        'lansia' => 'Poli Lansia',
                        'jiwa'   => 'Poli Jiwa',
                        'gizi'   => 'Poli Gizi',
                        'mata'   => 'Poli Mata',
                        'tht'    => 'Poli THT',
                        default  => $state,
                    }),

                TextColumn::make('penjamin')
                    ->label('Penjamin')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'bpjs'          => 'success',
                        'asuransi_lain' => 'warning',
                        default         => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'umum'          => 'Umum',
                        'asuransi_lain' => 'Asuransi Lain',
                        'bpjs'          => 'BPJS Kesehatan',
                        default         => $state ?? '-',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu'  => 'warning',
                        'dipanggil' => 'gray',
                        'selesai'   => 'success',
                        'batal'     => 'danger',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu'  => 'Menunggu',
                        'dipanggil' => 'Dipanggil',
                        'selesai'   => 'Selesai',
                        'batal'     => 'Batal',
                        default     => $state,
                    }),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Tgl. Daftar')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50]);
    }
}
