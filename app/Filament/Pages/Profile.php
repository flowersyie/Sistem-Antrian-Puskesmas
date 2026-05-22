<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Support\Htmlable;

class Profile extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title = 'Profil Saya';
    protected static ?string $slug = 'profile';
    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationSort(): ?int
    {
        return 99;
    }

    // Data form
    public ?string $name = '';
    public ?string $email = '';
    public ?string $current_password = '';
    public ?string $new_password = '';
    public ?string $new_password_confirmation = '';

    public function mount(): void
    {
        $user = auth()->user();
        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function getView(): string
    {
        return 'filament.pages.profile';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Profil Saya';
    }

    public function saveProfile(): void
    {
        $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
        ], [
            'name.required'  => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan akun lain.',
        ]);

        $user = auth()->user();
        $user->name  = $this->name;
        $user->email = $this->email;
        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui!')
            ->success()
            ->send();
    }

    public function savePassword(): void
    {
        $this->validate([
            'current_password'          => ['required'],
            'new_password'              => ['required', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required'     => 'Kata sandi baru wajib diisi.',
            'new_password.min'          => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'Kata sandi saat ini salah.');
            return;
        }

        $user = auth()->user();
        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->current_password          = '';
        $this->new_password              = '';
        $this->new_password_confirmation = '';

        Notification::make()
            ->title('Kata sandi berhasil diubah!')
            ->success()
            ->send();
    }
}
