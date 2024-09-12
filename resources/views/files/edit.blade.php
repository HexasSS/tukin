<!-- resources/views/files/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- File Edit Form -->
                    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">{{ __('File Baru')
                                }}</label>
                            <input type="file" id="file" name="file" class="block w-full mt-1" required>
                        </div>
                        <input type="hidden" name="sat_juru_bayar" value="{{ $file->sat_juru_bayar }}">
                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">{{ __('Unggah Ulang File') }}</button>
                            <a href="{{ route('files.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>