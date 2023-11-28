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
            </div>

            <div class="w-full ms-5">
                <p class="text-black">
                    <strong> {{ $character->name }}</strong>
                </p>

                <hr class="my-2 border-t-2 border-gray-300">
                <p class="text-black">
                    {{ $character->description }}
                </p>

                <p class="text-black mt-6">
                    <strong> Voice Actor</strong>
                </p>
                <hr class="my-2 border-t-2 border-gray-300">
            </div>
        </div>
    </div>
</x-app-layout>