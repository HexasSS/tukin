<!-- resources/views/files/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- File Details -->
                    <div class="mb-4">
                        <p><strong>{{ __('Nama File:') }}</strong> {{ $file->file_path }}</p>
                        <p><strong>{{ __('Sat Juru Bayar:') }}</strong> {{ $file->sat_juru_bayar }}</p>
                        <p><strong>{{ __('Diunggah Pada:') }}</strong> {{ optional($file->uploaded_at)->format('d M Y')
                            }}</p>
                        <!-- Add more details as necessary -->
                    </div>

                    <!-- Actions -->
                    <div class="mb-4">
                        <a href="{{ route('files.index') }}" class="btn btn-primary">
                            {{ __('Kembali ke Daftar File') }}
                        </a>
                        <a href="{{ route('files.edit', $file->id) }}" class="btn btn-yellow">
                            {{ __('Edit File') }}
                        </a>
                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-red"
                                onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus file ini?') }}')">
                                {{ __('Hapus File') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>