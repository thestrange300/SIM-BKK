<?php

namespace App\Filament\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthorizesFilamentPages
{
    protected static function authorizePage(User $user): bool
    {
        // Superadmin has full access
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Get the current page class name
        $pageClass = static::class;

        // Dashboard is accessible to all admins (adjust if needed)
         if ($pageClass === \App\Filament\Pages\Dashboard::class) {
             return $user->isSuperAdmin() || $user->isAdminAcara() || $user->isAdminKeuangan() || $user->isAdminMasjid();
         }

        // Admin Acara can access Manajemen Acara and Manajemen Qurban related pages
        if ($user->isAdminAcara()) {
            return in_array($pageClass, [
                \App\Filament\Pages\LaporanAcara::class,
                \App\Filament\Pages\LaporanQurban::class,
                // Add other Manajemen Acara/Qurban pages here if any
            ]);
        }

        // Admin Keuangan can access Manajemen Keuangan and Manajemen Zakat related pages
        if ($user->isAdminKeuangan()) {
            return in_array($pageClass, [
                \App\Filament\Pages\LaporanKeuangan::class,
                \App\Filament\Pages\LaporanZakatFitrah::class,
                // Add other Manajemen Keuangan/Zakat pages here if any
            ]);
        }

        // Admin Masjid can access Manajemen Masjid related pages (excluding Pengelola Website)
        if ($user->isAdminMasjid()) {
            return in_array($pageClass, [
                \App\Filament\Pages\LaporanMasjid::class,
                // Add other Manajemen Masjid pages here if any
            ]);
        }

        // Deny access by default
        return false;
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return static::authorizePage($user);
    }
}
