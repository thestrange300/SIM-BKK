<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\App;

class DependencyWidget extends Widget
{
    protected static string $view = 'filament.widgets.dependency-widget';


    protected function getHeading(): ?string
    {
        return 'Dependencies Overview';
    }

    protected function getDescription(): ?string
    {
        return 'This widget displays the current versions of key dependencies used in the application.';
    }

    protected function getDependencies(): array
    {
        // Get Filament version
        $filamentVersion = $this->getFilamentVersion();
        
        // Get Tailwind version (from package.json or node_modules)
        $tailwindVersion = $this->getTailwindVersion();
        
        return [
            'PHP' => PHP_VERSION,
            'Filament' => $filamentVersion,
            'Tailwind' => $tailwindVersion,
            'Laravel' => App::version(),
            'Database' => env('DB_CONNECTION', 'unknown'),
            // Add more dependencies as needed
        ];
    }

    private function getFilamentVersion(): string
    {
        try {
            
            // Method 2: Try to get from composer.lock
            $composerLock = base_path('composer.lock');
            if (file_exists($composerLock)) {
                $lockData = json_decode(file_get_contents($composerLock), true);
                
                foreach ($lockData['packages'] ?? [] as $package) {
                    if ($package['name'] === 'filament/filament') {
                        return $package['version'];
                    }
                }
            }
                  
            return 'Unknown';
        } catch (\Exception $e) {
            return 'Error retrieving version';
        }
    }

    private function getTailwindVersion(): string
    {
        try {
            // Method 1: Try to get from package.json
            $packageJson = base_path('package.json');
            if (file_exists($packageJson)) {
                $packageData = json_decode(file_get_contents($packageJson), true);
                
                // Check devDependencies first, then dependencies
                if (isset($packageData['devDependencies']['tailwindcss'])) {
                    return trim($packageData['devDependencies']['tailwindcss'], '^~');
                }
                
                if (isset($packageData['dependencies']['tailwindcss'])) {
                    return trim($packageData['dependencies']['tailwindcss'], '^~');
                }
            }        
            return 'Not installed';
        } catch (\Exception $e) {
            return 'Error retrieving version';
        }
    }

    public function getViewData(): array
    {
        return [
            'heading' => $this->getHeading(),
            'description' => $this->getDescription(),
            'dependencies' => $this->getDependencies()
        ];
    }
}
