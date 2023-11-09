<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-48 h-72 object-cover rounded-md float-left mr-4">
            @else
            <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-48 h-72 object-cover rounded-md float-left mr-4">
            @endif
            <p class="text-gray-700">
                <strong>Synopsis:</strong>
            </p>
            <div>
                {{ $anime->synopsis }}
            </div>
            <div style="clear: both;"></div> <!-- Add this line to clear the floated image -->

            <div class="my-4 border-l-4 border-mal-blue pl-4">
                <p class="text-lg font-semibold text-black">Information</p>
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
    </div>
</x-app-layout>