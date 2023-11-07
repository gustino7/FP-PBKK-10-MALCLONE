<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ __('Top Anime') }}
        </h4>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Rank</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Score</th>
                                <th class="px-4 py-2">Your Score</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topAnimes as $anime)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" width="80" height="120">
                                        </div>
                                        <div class="ml-3">
                                            <h2 class="text-lg font-semibold">{{ $anime->title }}</h2>
                                            <p class="mb-1">{{ $anime->type }} ({{ $anime->episode }} episodes)</p>
                                            <p class="mb-2">Premiered: {{ $anime->premiered }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2">{{ $anime->rating }}</td>
                                <td class="px-4 py-2">{{ $anime->your_score }}</td>
                                <!-- Change this to user rating -->
                                <td class="px-4 py-2">{{ $anime->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>