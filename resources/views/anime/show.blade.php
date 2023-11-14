<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-1/5">
                @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                @else
                <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                @endif

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

            <div class="w-full ms-5">
                <div class="font-bold border border-gray-300 p-2 mb-4 flex">
                    <div class="w-1/8">
                        <div class="my-3 border-mal-blue pl-4">
                            <p class="text-lg font-semibold text-mal-blue">SCORE</p>
                            <p class="text-3xl">{{ $anime->avg_rating }}</p>
                        </div>
                    </div>
                    <div class="w-1/2 ms-3">
                        <div class="my-3 pl-4">
                            <p class="text-lg text-black mb-4">
                                <span class="font-medium">Ranked :</span>
                                <span class="font-bold">#{{ $rank + 1 }}</span>
                            </p>
                            <p class="text-sm font-semibold text-link-blue">{{ $anime->type }}</p>
                        </div>
                    </div>
                </div>
                <div class="font-medium border border-gray-300 p-2 mb-4 flex">
                    <div class="w-full">
                        <div class="my-1 border-mal-blue pl-4">
                            <p class="text-m">
                                <select class="border rounded px-2 py-1 me-3">
                                    <option value="add-to-list">Add to List</option>
                                    <option value="watching">Watching</option>
                                    <option value="completed">Completed</option>
                                    <option value="on-hold">On-Hold</option>
                                    <option value="dropped">Dropped</option>
                                    <option value="plan-to-watch">Plan to Watch</option>
                                </select>
                                <select class="border rounded px-2 py-1 me-3 w-40">
                                    <option value="10">(10) Masterpiece</option>
                                    <option value="9">(9) Great</option>
                                    <option value="8">(8) Very Good</option>
                                    <option value="7">(7) Good</option>
                                    <option value="6">(6) Fine</option>
                                    <option value="5">(5) Average</option>
                                    <option value="4">(4) Bad</option>
                                    <option value="3">(3) Very Bad</option>
                                    <option value="2">(2) Horrible</option>
                                    <option value="1">(1) Appalling</option>
                                </select>
                                <select class="border rounded px-2 py-1 w-40">
                                    @for ($i = 0; $i <= $anime->episode; $i++)
                                        <option value="{{ $i }}">Episode: {{ $i }} / {{$anime->episode}}</option>
                                        @endfor
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
                <p class="text-black">
                    <strong>Synopsis</strong>
                </p>
                <div>
                    {{ $anime->synopsis }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>