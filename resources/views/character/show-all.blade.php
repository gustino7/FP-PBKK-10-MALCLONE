<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('message'))
        <x-error-msg message="{{ session('message') }}" />
        @endif
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-[23%] flex flex-col">
                <div>
                    @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                    <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                    @else
                    <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                    @endif
                </div>

                {{-- Information --}}
                <div class="my-4">
                    <h1 class=" text-black font-bold">Information</h1>
                    <hr class="mt-1 mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <p class="text-gray-600">
                        <strong>Type:</strong> {{ $anime->type }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Episodes:</strong> {{ $anime->episode }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Premiered:</strong> {{ $anime->premiered }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Status:</strong> {{ $anime->status }}
                    </p>
                </div>
            </div>

            <div class="w-full ms-5 flex flex-col gap-4">
                {{-- Character Voice Actor --}}
                <div class="mt-4 flex justify-between">
                    <h1 class="text-black">
                        <strong>Characters & Voice Actors</strong>
                    </h1>
                    <div class="ml-auto">
                        @if (auth()->user()->isAdmin === 1)
                        <a href="{{ route('anime.characters.createconnection', ['anime' => $anime->id]) }}" class="text-link-blue">
                            <strong class="text-sm">Edit</strong>
                        </a>
                        @endif
                    </div>
                </div>
                <hr class="mt-[-5px] mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                <div class="flex flex-col">
                    @php
                    $characters = $anime->Anime_Character;
                    @endphp
                    @foreach($characters as $animeCharacter)
                    @php
                    $character = $animeCharacter->Character;
                    $bgColor = $loop->iteration % 2 === 0 ? 'bg-[#F9F8F9]' : 'bg-white';
                    @endphp
                    <div class="{{ $bgColor }} flex py-2 border-t-2 border-gray-100">
                        <div class="">
                            @if (filter_var($character->profile_picture, FILTER_VALIDATE_URL))
                            <img src="{{ $character->profile_picture }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                            @else
                            <img src="{{ asset('storage/' . $character->profile_picture) }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                            @endif
                        </div>
                        <div class="ml-2]">
                            <p class="text-mal-blue ml-2">{{ $character->name }}</p>
                            <p class="text-xs ml-2">{{ $animeCharacter->role }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>