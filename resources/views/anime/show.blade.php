<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-48 h-72 object-cover rounded-md float-left mr-4">
            <p class="text-gray-700">
                <strong>Synopsis:</strong>
            <div>
                {{ $anime->synopsis }}
            </div>
            </p>
            <div style="clear: both;"></div> <!-- Add this line to clear the floated image -->

            <p class="text-gray-600 my-2">
                <strong>Type:</strong> {{ $anime->type }} ({{ $anime->episode }} episodes)
            </p>
            <p class="text-gray-600 mb-2">
                <strong>Premiered:</strong> {{ $anime->premiered }}
            </p>
            <p class="text-gray-600">
                <strong>Status:</strong> {{ $anime->status }}
            </p>

        </div>
    </div>
</x-app-layout>