
<x-filament-widgets::widget>
    {{-- <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">{{ $heading }}</h1>
    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $description }}</p> --}}
    <x-filament::section>
        <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Detail Sistem</span>
                    <span class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Nilai</span>
                </div>
                <hr class="border-gray-300 dark:border-gray-700">
            @foreach($details as $name => $version)
                <div class="flex justify-between">
                    <span class="font-semibold text-sm">{{ $name }}</span>
                    <span class="text-green-400 bg-emerald-900/50 border border-green-800 text-xs px-2 py-0.5 rounded-md">
                        {{ $version }}
                    </span>
                </div>
            @endforeach
        </div>  
    </x-filament::section>
</x-filament-widgets::widget>
