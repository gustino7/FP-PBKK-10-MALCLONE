<!-- resources/views/characters/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            Add Character to {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('anime.characters.store', $anime) }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="character" class="block text-sm font-medium text-gray-600">Select Character</label>
                    <select name="character_id" id="character" class="mt-1 p-2 border rounded-md w-full" required>
                        @foreach($characters as $character)
                        <option value="{{ $character->id }}">{{ $character->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-600">Select Role</label>
                    <select name="role" id="role" class="mt-1 p-2 border rounded-md w-full" required>
                        <option value="Main">Main</option>
                        <option value="Supporting">Supporting</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Character</button>
            </form>
        </div>
    </div>
</x-app-layout>