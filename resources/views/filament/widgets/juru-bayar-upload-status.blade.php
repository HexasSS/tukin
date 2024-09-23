<x-filament::widget>
    <x-filament::card>
        <div class="text-center">
            <h2 class="text-xl font-semibold">Status Unggahan Tukin Periode Lalu</h2>
            <p class="mt-4 text-4xl">
                {{ $juruBayarUploaded }} / {{ $totalJuruBayar }}
            </p>
            <p class="text-gray-600">Juru Bayar telah mengunggah tukin</p>
        </div>
    </x-filament::card>
</x-filament::widget>