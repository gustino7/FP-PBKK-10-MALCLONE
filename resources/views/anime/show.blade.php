<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-4 shadow sm:rounded-lg">
            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-32 h-48 object-cover rounded-md float-left mr-4">
            <p class="text-gray-600 mb-2">
                <strong>Type:</strong> {{ $anime->type }} ({{ $anime->episode }} episodes)
            </p>
            <p class="text-gray-600 mb-2">
                <strong>Premiered:</strong> {{ $anime->premiered }}
            </p>
            <p class="text-gray-600">
                <strong>Status:</strong> {{ $anime->status }}
            </p>
            <p class="text-gray-700 mt-4">
                <strong>Synopsis:</strong> {{ $anime->synopsis }}
            </p>

            <!-- Add other information here -->
        </div>
    </div>
</x-app-layout>