<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DependencyWidget;
use App\Filament\Widgets\GitbookWidget;
use App\Filament\Widgets\SystemDetailWidget;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use App\Filament\Traits\AuthorizesFilamentPages;

class Dashboard extends Page
{
    use AuthorizesFilamentPages;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            GitbookWidget::class,
            DependencyWidget::class,
            SystemDetailWidget::class,
        ];
    }
}
