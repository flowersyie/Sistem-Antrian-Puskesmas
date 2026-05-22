<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Logout extends Page
{
    protected static ?string $title = 'Logout';
    protected static ?string $navigationLabel = 'Logout';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-left-on-rectangle';
    protected static bool $shouldRegisterNavigation = false;
    
    public function mount(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        redirect('/login')->send();
    }

    public function getView(): string
    {
        return 'filament.pages.logout';
    }
}
