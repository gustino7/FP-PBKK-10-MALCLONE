<!-- resources/views/song/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Add Song to Anime') }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('songs.store', ['anime' => $anime->id]) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-gray-600">Title</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                
                <div class="mb-4">
                    <label for="singer" class="block text-gray-600">Singer</label>
                    <input type="text" name="singer" id="singer" class="w-full border border-gray-300 rounded p-2" required>
                </div>
    
                <div class="mb-4">
                    <label for="theme_type" class="block text-gray-600">Theme Type</label>
                    <select name="theme_type" id="theme_type" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="Opening">Opening</option>
                        <option value="Ending">Ending</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-mal-blue text-white my-2 py-2 px-4 rounded">Add Song</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>