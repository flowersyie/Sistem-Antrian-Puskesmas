<?php

namespace App\Filament\Resources\Pasiens\Pages;

use App\Filament\Resources\Pasiens\PasienResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    protected function getRedirectUrl(): string
    {
        return PasienResource::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $url = route('pasien.struk', $this->record->id);
        $this->js("window.open('{$url}', '_blank')");
    }
}
