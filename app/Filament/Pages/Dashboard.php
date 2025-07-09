<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DependencyWidget;
use App\Filament\Widgets\GitbookWidget;
use App\Filament\Widgets\SystemDetailWidget;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;

class Dashboard extends Page
{
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
