<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Top Anime') }}
        </h4>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full border border-collapse border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b border-r text-center">Rank</th>
                                <th class="px-4 py-2 border-b border-r text-center">Title</th>
                                <th class="px-4 py-2 border-b border-r text-center">Score</th>
                                <th class="px-4 py-2 border-b border-r text-center">Your Score</th>
                                <th class="px-4 py-2 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topAnimes as $anime)
                            <tr>
                                <td class="px-4 py-2 border-b border-r text-center">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2 border-b border-r text-left">
                                    <div class="flex mt-1">
                                        <div class="mr-4">
                                            <a href="{{ route('anime.show', ['id' => $anime->id]) }}">
                                                @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                                                <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="mt-1 w-[3rem] h-[4rem] object-cover rounded">
                                                @else
                                                <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="mt-1 w-[3rem] h-[4rem] object-cover rounded">
                                                @endif
                                            </a>

                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-link-blue">
                                                <a href="{{ route('anime.show', ['id' => $anime->id]) }}">{{ $anime->title }}</a>
                                            </h2>
                                            <p class="text-sm text-gray-600">{{ $anime->type }} ({{ $anime->episode }} episodes)</p>
                                            <p class="text-sm text-gray-600">Premiered: {{ $anime->premiered }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-2 border-b border-r text-center">{{ $anime->avg_rating }}</td>
                                    @if ($user)
                                    @php
                                    $userReview = $user->Review()->where('anime_id', $anime->id)->first();
                                    @endphp

                                <td class="px-4 py-2 border-b border-r text-center">
                                    @if ($userReview)
                                    {{ $userReview->rating }}
                                    @endif
                                </td>
                                @endif
                                </td>
                                <td class="px-4 py-2 border-b text-center">{{ $anime->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>