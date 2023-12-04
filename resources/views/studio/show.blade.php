<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $studio->name }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <p class="text-gray-600">
                <strong>Established:</strong> {{ $studio->established }}
            </p>
            <p class="text-gray-600">
                <strong>Description:</strong> {{ $studio->description }}
            </p>

        </div>
    </div>
</x-app-layout>