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
                                <th class="px-4 py-2 border-b border-r text-left">Title</th>
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
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-20 h-32 object-cover rounded">
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold">{{ $anime->title }}</h2>
                                            <p class="text-sm text-gray-600">{{ $anime->type }} ({{ $anime->episode }} episodes)</p>
                                            <p class="text-sm text-gray-600">Premiered: {{ $anime->premiered }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 border-b border-r text-center">{{ $anime->rating }}</td>
                                <td class="px-4 py-2 border-b border-r text-center">{{ $anime->your_score }}</td>
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