<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $genre . (' Anime') }}
        </h4>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($genreAnimes as $anime)
                    <div class="border border-gray-300 py-4 rounded-md mb-4 flex flex-col">
                        <h2 class="text-lg font-semibold text-mal-blue text-center h-12 mb-2 overflow-hidden flex items-center justify-center">
                            <a href="{{ route('anime.show', ['id' => $anime->id]) }}">{{ $anime->title }}</a>
                        </h2>
                        <p class="bg-gray-100 text-sm text-gray-600 text-center">{{ $anime->premiered }} | Episode {{ $anime->episode }}</p>
                        <div class="mt-4 flex-grow flex">
                            <img src="{{ filter_var($anime->poster, FILTER_VALIDATE_URL) ? $anime->poster : asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-1/2 h-64 object-cover rounded mb-2 mr-4">
                            <p class="text-sm text-gray-600 flex-grow line-clamp-3">{{ $anime->synopsis }}</p>
                        </div>
                        <div class="flex items-center ml-2">
                            <p class="text-sm text-gray-600 flex items-center">
                                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                {{ $anime->avg_rating }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600 text-center">No anime found for this genre.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>