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

                    <!-- Generate links for previous seasons -->
                    <a href="{{ route('anime.season', ['year' => $prevYear, 'season' => $prevSeason]) }}" class="text-link-blue">...</a>

                    <!-- Generate links for each season -->
                    @foreach($seasons as $season)
                    <a href="{{ route('anime.season', ['year' => $season['year'], 'season' => $season['season']]) }}" class="text-link-blue">{{ $season['label'] }}</a>
                    @endforeach

                    <!-- Generate links for next seasons -->
                    <a href="{{ route('anime.season', ['year' => $nextYear, 'season' => $nextSeason]) }}" class="text-link-blue">...</a>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach($seasonalAnimes as $anime)
                    <div class="border border-gray-300 p-4 rounded-md mb-4">
                        <h2 class="text-lg font-semibold text-link-blue">
                            <a href="{{ route('anime.show', ['id' => $anime->id]) }}">{{ $anime->title }}</a>
                        </h2>
                        <p class="text-sm text-gray-600">{{ $anime->premiered }} | Episode {{ $anime->episode }}</p>
                        <div class="mt-2">
                            <img src="{{ filter_var($anime->poster, FILTER_VALIDATE_URL) ? $anime->poster : asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-full h-32 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">{{ $anime->synopsis }}</p>
                        </div>
                        <p class="text-sm text-gray-600">Average Rating: {{ $anime->avg_rating }}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>