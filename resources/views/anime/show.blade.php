<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-48 h-72 object-cover rounded-md float-left mr-4 ml-2"> <!-- Add ml-2 for left margin -->
            @else
            <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-48 h-72 object-cover rounded-md float-left mr-4 ml-2"> <!-- Add ml-2 for left margin -->
            @endif

            <div class="flex-1">
                <div class="font-bold border border-gray-300 p-2 mb-4 flex">
                    <div class="w-1/7">
                        <div class="my-4 border-mal-blue pl-4">
                            <p class="tet-center text-lg font-semibold text-mal-blue">SCORE</p>
                            <p class="text-center text-3xl">{{ $anime->avg_rating }}</p>
                        </div>
                    </div>
                    <div class="w-1/4 ms-3">
                        <div class="my-4 pl-4">
                            <p class="text-lg text-black mb-4">
                                <span class="font-medium">Ranked :</span>
                                <span class="font-bold">#{{ $rank + 1 }}</span>
                            </p>
                            <p class="text-sm font-semibold text-link-blue">{{ $anime->type }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="font-bold border border-gray-300 p-2 mb-4 flex">
                    <div class="w-1/7">
                        <div class="my-4 border-mal-blue pl-4">
                            <p class="text-md">
                                <select class="border rounded px-2 py-1">
                                    <option value="watching">Add to List</option>
                                    <option value="watching">Watching</option>
                                    <option value="completed">Completed</option>
                                    <option value="on-hold">On-Hold</option>
                                    <option value="dropped">Dropped</option>
                                    <option value="plan-to-watch">Plan to Watch</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </div>

                <p class="text-gray-700">
                    <strong>Synopsis:</strong>
                </p>
                <div>
                    {{ $anime->synopsis }}
                </div>
                <div style="clear: both;"></div> <!-- Add this line to clear the floated image -->

                <div class="my-4 border-l-4 border-mal-blue pl-4">
                    <p class="text-lg font-semibold text-black">Information</p>
                    <p class="text-gray-600">
                        <strong>Type:</strong> {{ $anime->type }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Episodes:</strong> {{ $anime->episode }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Premiered:</strong> {{ $anime->premiered }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Status:</strong> {{ $anime->status }}
                    </p>
                </div>
            </div>
        </div>
</x-app-layout>