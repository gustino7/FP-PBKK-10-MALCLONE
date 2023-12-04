<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Create Anime-Studio Connection') }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('studio.storeConnection', ['anime' => $anime->id]) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="studio_id" class="block text-gray-600">Select Studio</label>
                    <select name="studio_id" id="studio_id" class="w-full border border-gray-300 rounded p-2" required>
                        @foreach($studios as $studio)
                        <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-mal-blue text-white my-2 py-2 px-4 rounded">Connect Studio</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>