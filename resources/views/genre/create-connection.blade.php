<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            Add Genre to {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('genre.store', $anime) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium text-gray-600">Select Genre</label>
                    <select name="genre_id" id="genre" class="mt-1 p-2 border rounded-md w-full" required>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded-md">Add Genre</button>
            </form>
        </div>
    </div>
</x-app-layout>