<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $user->name }}'s Anime List ({{ ucfirst($status) }})
        </h4>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg p-6">
                <div class="flex space-x-4 mb-6 justify-center">
                    <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Watching']) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Watching</a>
                    <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Completed']) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Completed</a>
                    <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'On-Hold']) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">On-Hold</a>
                    <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Dropped']) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Dropped</a>
                    <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Plan To Watch']) }}" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Plan To Watch</a>
                </div>
                <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg p-6">
                    <table class="min-w-full border border-collapse border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b border-r text-center">#</th>
                                <th class="px-4 py-2 border-b border-r text-center">Poster</th>
                                <th class="px-4 py-2 border-b border-r text-center">Anime Title</th>
                                <th class="px-4 py-2 border-b border-r text-center">User Score</th>
                                <th class="px-4 py-2 border-b border-r text-center">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td class="px-4 py-2 border-b border-r text-center">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2 border-b border-r text-center">
                                    <div class="flex items-center justify-center">
                                        <img src="{{ filter_var($review->anime->poster, FILTER_VALIDATE_URL) ? $review->anime->poster : asset('storage/posters/' . $review->anime->poster) }}" alt="{{ $review->anime->title }}" class="mt-1 w-[3rem] h-[4rem] object-cover rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-2 border-b border-r text-left">
                                    <div class="flex mt-1">
                                        <div class="mr-4">
                                            <a href="{{ route('anime.show', ['id' => $review->anime->id]) }}">
                                                {{ $review->anime->title }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 border-b border-r text-center">
                                    {{ $review->rating }}
                                </td>
                                <td class="px-4 py-2 border-b text-center">
                                    {{ $review->anime->type }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>