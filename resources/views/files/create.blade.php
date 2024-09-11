<!-- resources/views/files/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Unggah File Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Display errors if any -->
                    @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- File Upload Form -->
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- File Input -->
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Pilih File</label>
                            <input type="file" name="file" id="file" class="block w-full mt-1" required>
                        </div>

                        <!-- Sat Juru Bayar Input -->
                        <div class="mb-4">
                            <label for="sat_juru_bayar" class="block text-sm font-medium text-gray-700">Sat Juru
                                Bayar</label>
                            <input type="text" name="sat_juru_bayar" id="sat_juru_bayar" class="block w-full mt-1"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <a href="{{ route('files.index') }}" class="mr-3 btn btn-secondary">
                                {{ __('Kembali ke Daftar File') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Unggah') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>