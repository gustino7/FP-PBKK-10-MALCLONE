<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-[23%] flex flex-col">
                <div>
                    @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                    <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                    @else
                    <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-full h-72 object-cover rounded-md mb-4">
                    @endif
                </div>
                
                {{-- Edit Status --}}
                @if ($review_id)
                    <div class="flex flex-col">
                        <div class="border-b-2 border-gray-600 mb-2">
                            <h1 class=" text-gray-600 font-bold">Edit status</h1>
                        </div>
                        <div>
                            <form action="{{ route('review.update', ['review_id' => $review_id, 'anime_id' => $anime->id]) }}" method="POST" class="flex flex-col justify-between gap-5">
                                @csrf
                                @method("PUT")
                                <div class="flex flex-row items-center h-[1.5rem] justify-between">
                                    <div class="text-xs">
                                        <label for="status" class="">Status :</label>
                                    </div>
                                    <select name="status" id="status" class="w-[67.5%] text-xs">
                                        @foreach(['Watching', 'Completed', 'On-hold', 'Dropped', 'Plan-to-watch'] as $option)
                                            <option value="{{ $option }}" @if($review->status == $option) selected @endif>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="flex flow-row items-center h-[1.5rem] justify-between">
                                    <div class="text-xs">
                                        <label for="status">Your Score :</label>
                                    </div>
                                    <select name="rating" id="rating" class="w-[67.5%] text-xs">
                                        @for ($i = 10; $i >= 1; $i--)
                                            <option value="{{ $i }}" @if ($review->rating == $i) selected @endif>
                                                ({{ $i }}) 
                                                @if ($i == 10)
                                                    Masterpiece
                                                @elseif ($i == 9)
                                                    Great
                                                @elseif ($i == 8)
                                                    Very Good
                                                @elseif ($i == 7)
                                                    Good
                                                @elseif ($i == 6)
                                                    Fine
                                                @elseif ($i == 5)
                                                    Average
                                                @elseif ($i == 4)
                                                    Bad
                                                @elseif ($i == 3)
                                                    Very Bad
                                                @elseif ($i == 2)
                                                    Horrible
                                                @else
                                                    Appalling
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mx-auto w-20">
                                    <button type="submit" class="bg-mal-blue text-white py-1 ml-1 rounded text-center text-xs font-bold w-full">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                
                {{-- Information --}}
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

            <div class="w-full ms-5 flex flex-col gap-4">
                {{-- Score --}}
                <div class="font-bold border border-gray-300 p-2 flex items-center">
                    <div class="w-1/8">
                        <div class="my-3 border-mal-blue pl-4">
                            <p class="text-lg font-semibold text-mal-blue">SCORE</p>
                            <p class="text-3xl">{{ $anime->avg_rating }}</p>
                        </div>
                    </div>
                    <div class="border-r border-gray-300 h-16 ms-4"></div>
                    <div class="w-1/2">
                        <div class="my-3 pl-4">
                            <p class="text-lg text-black mb-4">
                                <span class="font-medium">Ranked :</span>
                                <span class="font-bold">#{{ $rank + 1 }}</span>
                            </p>
                            <p class="text-sm font-semibold text-link-blue">{{ $anime->type }}</p>
                        </div>
                    </div>
                </div>
                {{-- Add To List --}}
                <div class="font-medium border border-gray-300 p-2 flex">
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
                {{-- Synopsis --}}
                <div>
                    <h1 class="text-black">
                        <strong>Synopsis</strong>
                    </h1>
                    <hr class="my-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>
                        {{ $anime->synopsis }}
                    </div>
                </div>
                {{-- Character Voice Actor --}}
                <div class="mt-4">
                    <h1 class="text-black">
                        <strong>Characters and Voice Actors</strong>
                    </h1>
                    <hr class="my-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>

                    </div>
                </div>
                {{-- Songs --}}
                <div class="mt-4">
                    <h1 class="text-black">
                        <strong>Songs</strong>
                    </h1>
                    <hr class="my-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>

                    </div>
                </div>
                {{-- Reviews --}}
                <div class="mt-4">
                    <h1 class="text-black">
                        <strong>Reviews</strong>
                    </h1>
                    <hr class="my-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>
                        <div class="bg-slate-300 flex flex-row justify-between px-8 h-8 items-center">
                            <a href="{{ route('review.create', ['anime_id' => $anime->id, 'user_id' => Auth::user()->id ]) }}" class="text-violet-500 font-bold hover:underline">Write review</a>
                            <a href="#" class="text-violet-500 font-bold hover:underline">All reviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>