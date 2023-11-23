<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Create Anime') }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-600">Title</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-600">Status</label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="Airing">Airing</option>
                        <option value="Finished">Finished</option>
                        <option value="Not Yet Aired">Not Yet Aired</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="premiered" class="block text-gray-600">Premiered</label>
                    <input type="date" name="premiered" id="premiered" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="synopsis" class="block text-gray-600">Synopsis</label>
                    <textarea name="synopsis" id="synopsis" class="w-full border border-gray-300 rounded p-2" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-gray-600">Type</label>
                    <select name="type" id="type" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="TV">TV</option>
                        <option value="Movie">Movie</option>
                        <option value="OVA">OVA</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="episode" class="block text-gray-600">Episodes</label>
                    <input type="number" name="episode" id="episode" class="w-full border border-gray-300 rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="poster" class="block text-gray-600">Poster</label>
                    <input type="file" name="poster" id="poster" accept="image/*" class="w-full border border-gray-300 rounded p-2" required>
                    @error('poster')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-mal-blue text-white my-2 py-2 px-4 rounded">Create Anime</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>