<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display the sat_juru_bayar for the current user -->
                    <p class="text-gray-600">{{ __('Your Sat Juru Bayar: ') . $userSatJuruBayar }}</p>

                    <!-- Button to create a new file -->
                    <div class="mb-4">
                        <a href="{{ route('files.create') }}" class="btn btn-primary">
                            {{ __('Unggah File Baru') }}
                        </a>
                    </div>

                    <!-- Check if files exist -->
                    @if ($files->isEmpty())
                    <p class="text-gray-600">{{ __('Belum ada file yang diunggah.') }}</p>
                    @else
                    <!-- Files Table -->
                    <table class="w-full text-left table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Nama File') }}</th>
                                <th class="px-4 py-2">{{ __('Sat Juru Bayar') }}</th>
                                <th class="px-4 py-2">{{ __('Diunggah Pada') }}</th>
                                <th class="px-4 py-2">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $file->file_path }}</td>
                                <td class="px-4 py-2">{{ $file->sat_juru_bayar }}</td>
                                <td class="px-4 py-2">{{ optional($file->uploaded_at)->format('d M Y') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('files.show', $file->id) }}" class="text-blue-500">{{ __('Lihat')
                                        }}</a> |
                                    <a href="{{ route('files.edit', $file->id) }}" class="text-yellow-500">{{ __('Edit')
                                        }}</a> |
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500"
                                            onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus file ini?') }}')">{{
                                            __('Hapus') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $files->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>