<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SystemDetailWidget extends Widget
{
    protected static string $view = 'filament.widgets.system-detail-widget';

    protected function getDetails(): array
    {
        return [
            'App Name' => config('app.name'),
            'Environment' => config('app.env'),
            'App URL' => config('app.url'),
            'Timezone' => config('app.timezone'),
            'Locale' => config('app.locale'),
            // 'PHP Version' => PHP_VERSION,
            // 'Laravel Version' => app()->version(),
            // Add more as needed
        ];
    }

    public function getViewData(): array
    {
        return [
            'details' => $this->getDetails(),
        ];
    }
}