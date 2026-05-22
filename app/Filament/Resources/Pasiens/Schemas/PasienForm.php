<?php

namespace App\Filament\Resources\Pasiens\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PasienForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pasien')
                    ->required()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-user')
                    ->extraInputAttributes([
                        'style' => 'border-color: #6366f1; box-shadow: 0 0 0 1px #6366f1;',
                    ]),

                TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->rules(['digits:16'])
                    ->maxLength(16)
                    ->placeholder('16 digit NIK')
                    ->prefixIcon('heroicon-o-identification')
                    ->extraInputAttributes([
                        'style'       => 'border-color: #8b5cf6; box-shadow: 0 0 0 1px #8b5cf6;',
                        'inputmode'   => 'numeric',
                        'pattern'     => '[0-9]{16}',
                    ]),

                TextInput::make('phone')
                    ->label('Nomor Handphone')
                    ->tel()
                    ->required()
                    ->maxLength(15)
                    ->placeholder('08xxxxxxxxxx')
                    ->prefixIcon('heroicon-o-phone')
                    ->extraInputAttributes([
                        'style' => 'border-color: #06b6d4; box-shadow: 0 0 0 1px #06b6d4;',
                    ]),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->rows(2),

                Select::make('penjamin')
                    ->label('Penjamin')
                    ->required()
                    ->options([
                        'umum'          => 'Umum',
                        'asuransi_lain' => 'Asuransi Lain',
                        'bpjs'          => 'BPJS Kesehatan',
                    ])
                    ->default('umum')
                    ->native(false),

                Select::make('poli')
                    ->label('Poli Tujuan')
                    ->required()
                    ->options([
                        'umum'   => 'Poli Umum',
                        'gigi'   => 'Poli Gigi',
                        'anak'   => 'Poli Anak',
                        'kia'    => 'Poli KIA / KB',
                        'lansia' => 'Poli Lansia',
                        'jiwa'   => 'Poli Jiwa',
                        'gizi'   => 'Poli Gizi',
                        'mata'   => 'Poli Mata',
                        'tht'    => 'Poli THT',
                    ])
                    ->searchable()
                    ->native(false),

                TextInput::make('status_display')
                    ->label('Status')
                    ->default('Menunggu')
                    ->disabled()
                    ->dehydrated(false),

                Hidden::make('status')
                    ->default('menunggu'),
            ]);
    }
}
