<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $character->name }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-1/4">
                @if (filter_var($character->profile_picture, FILTER_VALIDATE_URL))
                <img src="{{ $character->profile_picture }}" alt="{{ $character->title }}" class="w-50 h-50 object-cover rounded-md mb-4">
                @else
                <img src="{{ asset('storage/' . $character->profile_picture) }}" alt="{{ $character->title }}" class="w-50 h-50 object-cover rounded-md mb-4">
                @endif
                <h2 class="text-lg font-semibold text-black mt-4">Animeography</h2>

                <ul class="mt-2">
                    <hr class="my-2 border-t-2 border-gray-300">
                    @forelse ($animeography as $entry)
                    <li class="flex items-center space-x-4 py-1 border-b border-gray-300">
                        <div class="flex-shrink-0">
                            @if (filter_var($entry->Anime->poster, FILTER_VALIDATE_URL))
                            <img src="{{ $entry->Anime->poster }}" alt="{{ $entry->Anime->title }}" class="w-16 h-24 object-cover rounded-md">
                            @else
                            <img src="{{ asset('storage/posters/' . $entry->Anime->poster) }}" alt="{{ $entry->Anime->title }}" class="w-16 h-24 object-cover rounded-md">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-mal-blue text-sm">
                                <a href="{{ route('anime.show', ['id' => $entry->Anime->id]) }}">{{ $entry->Anime->title }}</a>
                            </p>
                            <p class="text-gray-600 text-sm">{{ $entry->role }}</p>
                        </div>
                    </li>
                    @empty
                    <p class="text-gray-600">No animeography available for this character.</p>
                    @endforelse
                </ul>


            </div>

            <div class="w-full ms-5">
                <p class="text-black">
                    <strong> {{ $character->name }}</strong>
                </p>

                <hr class="my-2 border-t-2 border-gray-300">
                <p class="text-black">
                    {{ $character->description }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>