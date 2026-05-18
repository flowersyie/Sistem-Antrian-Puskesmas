<?php

namespace App\Filament\Resources\Pasiens\Pages;

use App\Filament\Resources\Pasiens\PasienResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPasien extends ViewRecord
{
    protected static string $resource = PasienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cetak_struk')
                ->label('Cetak Struk')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn () => route('pasien.struk', $this->record->id))
                ->openUrlInNewTab(),

            EditAction::make(),
        ];
    }
}
