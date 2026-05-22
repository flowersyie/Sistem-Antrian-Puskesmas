<?php

namespace App\Filament\Resources\Pasiens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PasiensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('queue_number')
                    ->label('No. Antrian')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label('No. Telepon')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('poli')
                    ->label('Poli Tujuan')
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
                    })
                    ->searchable(),

                TextColumn::make('penjamin')
                    ->label('Penjamin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bpjs'          => 'success',
                        'asuransi_lain' => 'warning',
                        default         => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'umum'          => 'Umum',
                        'asuransi_lain' => 'Asuransi Lain',
                        'bpjs'          => 'BPJS Kesehatan',
                        default         => $state,
                    })
                    ->toggleable(),

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
                    })
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tgl. Daftar')
                    ->dateTime('d/m/Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
