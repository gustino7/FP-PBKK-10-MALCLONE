<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Seasonal Anime') }}
        </h4>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg p-6">

                <!-- Seasonal Navigation -->
                <div class="flex space-x-4 mb-4 justify-center">
                    <a href="{{ route('anime.season', ['year' => $prevYear, 'season' => $prevSeason]) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">...</a>
                    @foreach($seasons as $season)
                    <a href="{{ route('anime.season', ['year' => $season['year'], 'season' => $season['season']]) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">{{ $season['label'] }}</a>
                    @endforeach
                    <a href="{{ route('anime.season', ['year' => $nextYear, 'season' => $nextSeason]) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">...</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach($seasonalAnimes as $anime)
                    <div class="border border-gray-300 p-4 rounded-md mb-4 flex flex-col">
                        <h2 class="text-lg font-semibold text-mal-blue text-center">
                            <a href="{{ route('anime.show', ['id' => $anime->id]) }}">{{ $anime->title }}</a>
                        </h2>
                        <p class="text-sm text-gray-600 text-center">{{ $anime->premiered }} | Episode {{ $anime->episode }}</p>
                        <div class="mt-4 flex-grow flex">
                            <img src="{{ filter_var($anime->poster, FILTER_VALIDATE_URL) ? $anime->poster : asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-1/2 h-64 object-cover rounded mb-2 mr-4">
                            <p class="text-sm text-gray-600 flex-grow">{{ $anime->synopsis }}</p>
                        </div>
                        <p class="text-sm text-gray-600">Average Rating: {{ $anime->avg_rating }}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>