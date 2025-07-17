{{-- <x-filament-panels::page>

</x-filament-panels::page> --}}

<x-filament::page>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Progress Keseluruhan</h2>
        <p>Total Dokumen: {{ $stats['total'] }}</p>
        <p>Terisi: {{ $stats['filled'] }}</p>
        <div class="w-full bg-gray-200 rounded-full h-4 mt-2">
            <div class="bg-success-600 h-4 rounded-full" style="width: {{ $stats['percentage'] }}%"></div>
        </div>
        <p class="mt-1 text-sm">{{ $stats['percentage'] }}% selesai</p>
    </x-filament::card>

    <x-filament::card class="mt-6">
        <h2 class="text-xl font-bold mb-4">Progress per Kriteria</h2>
        @foreach ($byCriterion as $item)
            <div class="mb-3">
                <p class="font-medium">{{ $item['name'] }}</p>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-primary-600 h-3 rounded-full" style="width: {{ $item['percentage'] }}%"></div>
                </div>
                <p class="text-sm">{{ $item['percentage'] }}%</p>
            </div>
        @endforeach
    </x-filament::card>
</x-filament::page>
