<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $studio->name }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-1/4">
                @if (filter_var($studio->profile_picture, FILTER_VALIDATE_URL))
                <img src="{{ $studio->profile_picture }}" alt="{{ $studio->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                @else
                <img src="{{ asset('storage/' . $studio->profile_picture) }}" alt="{{ $studio->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                @endif

            </div>

            <div class="w-3/4 ms-5">

                <div class="my-4">
                    <p class="text-lg font-semibold text-black">Information</p>
                    <p class="text-gray-600">
                        <strong>Established:</strong> {{ $studio->established }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Description:</strong> {{ $studio->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>