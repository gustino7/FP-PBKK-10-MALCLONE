<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $anime->title }}
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('message'))
            <x-error-msg message="{{ session('message') }}" />
        @endif
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
                    <div class="my">
                        <h1 class=" text-black font-bold">Edit status</h1>
                    </div>
                    <hr class="mt-1 mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>
                        <form action="{{ route('review.update', ['review_id' => $review_id, 'anime_id' => $anime->id]) }}" method="POST" class="flex flex-col justify-between gap-5">
                            @csrf
                            @method("PUT")
                            <div class="flex flex-row items-center h-[1.5rem] justify-between mt-2">
                                <div class="text-sm">
                                    <label for="status" class="">Status :</label>
                                </div>
                                <select name="status" id="status" class="w-[57.5%] text-xs h-[1.75rem] p-1">
                                    @foreach(['Watching', 'Completed', 'On-hold', 'Dropped', 'Plan-to-watch'] as $option)
                                    <option value="{{ $option }}" @if($review->status == $option) selected @endif>
                                        {{ $option }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="flex flex-row items-center h-[1.5rem] justify-between">
                                <div class="text-sm">
                                    <label for="rating">Your Score :</label>
                                </div>
                                <select name="rating" id="rating" class="w-[57.5%] text-xs h-[1.75rem] p-1">
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
                            <div class="mx-auto w-full">
                                <button type="submit" class="bg-mal-blue text-white py-1 rounded text-center text-xs font-bold h-[1.75rem] w-full">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                {{-- Information --}}
                <div class="my-4">
                    <h1 class=" text-black font-bold">Information</h1>
                    <hr class="mt-1 mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
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
                <div class="font-bold border border-gray-300 p-2 flex items-center bg-[#F9F8F9]">
                    <div class="w-1/8">
                        <div class="my-3 border-mal-blue pl-4">
                            <p class="text-lg font-semibold text-mal-blue text-center">SCORE</p>
                            <p class="text-3xl">{{ $anime->avg_rating }}</p>
                        </div>
                    </div>
                    <div class="border-r border-gray-300 h-16 ms-4"></div> <!-- Vertical Line -->
                    <div class="w-1/2">
                        <div class="my-3 pl-4">
                            <p class="text-lg text-black mb-4">
                                <span class="font-medium">Ranked :</span>
                                <span class="font-bold">#{{ $rank + 1 }}</span>
                            </p>
                            <div class="flex items-center my-3">
                                <p class="text-sm font-semibold text-link-blue">{{ $anime->season }}</p>
                                <div class="border-r border-gray-300 h-4 mx-3"></div>
                                <p class="text-sm font-semibold text-link-blue">{{ $anime->type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Add To List --}}
                <div class="font-medium border border-gray-300 p-2 flex bg-[#F9F8F9]">
                    <div class="w-full">
                        <div class="my-1 border-mal-blue pl-4">
                            @if ($user_anime)
                            <p>
                                This anime is in your list
                            </p>
                            <form action="{{ route('anime.removelist', ['id' => $anime->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="font-bold border rounded-lg px-2 py-1 me-3 bg-red-500 text-white hover:opacity-70">Drop Anime</button>
                            </form>
                            @else
                            <form action="{{ route('anime.addlist', ['id' => $anime->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="font-bold border rounded-lg px-2 py-1 me-3 bg-mal-blue text-white hover:opacity-70">Add To List</button>
                            </form>
                            @endif
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
                <div class="mt-4 flex justify-between">
                    <h1 class="text-black">
                        <strong>Characters & Voice Actors</strong>
                    </h1>
                    @if (auth()->user()->isAdmin === 1)
                    <div class="ml-auto">
                        <a href="{{ route('anime.characters.createconnection', ['anime' => $anime->id]) }}" class="text-link-blue me-6">
                            <strong class="text-sm">Edit</strong>
                        </a>
                        <a href="{{ route('anime.characters.createconnection', ['anime' => $anime->id]) }}" class="text-link-blue">
                            <strong class="text-sm">More characters</strong>
                        </a>
                    </div>
                    @endif
                </div>
                <hr class="mt-[-5px] mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                <div class="flex">
                    <table class="w-1/2 float-left">
                        <tbody>
                            @php
                            $characters = $anime->Anime_Character->sortBy('role')->take(10);
                            $leftSide = $characters->slice(0, 5);
                            @endphp
                            @foreach($leftSide as $animeCharacter)
                            @php
                            $character = $animeCharacter->Character;
                            $bgColor = $loop->iteration % 2 === 0 ? 'bg-[#F9F8F9]' : 'bg-white';
                            @endphp
                            <tr class="{{ $bgColor }}">
                                <td class="">
                                    @if (filter_var($character->profile_picture, FILTER_VALIDATE_URL))
                                    <img src="{{ $character->profile_picture }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                                    @else
                                    <img src="{{ asset('storage/' . $character->profile_picture) }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                                    @endif
                                </td>
                                <td class="py-2 align-top">
                                    <div class="ml-[-4rem]">
                                        <p class="text-mal-blue">{{ $character->name }}</p>
                                        <p class="text-xs">{{ $animeCharacter->role }}</p>
                                    </div>
                                </td>
                            <tr>
                                <td colspan="2">
                                    <hr class="my-1 border-t-2 border-gray-100">
                                </td>
                            </tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="border-r border-gray-300 h-84 mx-2"></div>

                    <table class="w-1/2 float-left">
                        <tbody>
                            @php
                            $rightSide = $characters->slice(5);
                            @endphp
                            @foreach($rightSide as $animeCharacter)
                            @php
                            $character = $animeCharacter->Character;
                            $bgColor = $loop->iteration % 2 === 0 ? 'bg-[#F9F8F9]' : 'bg-white';
                            @endphp
                            <tr class="{{ $bgColor }}">
                                <td class="">
                                    @if (filter_var($character->profile_picture, FILTER_VALIDATE_URL))
                                    <img src="{{ $character->profile_picture }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                                    @else
                                    <img src="{{ asset('storage/' . $character->profile_picture) }}" alt="{{ $character->title }}" class="w-[3rem] h-[4rem] object-cover">
                                    @endif
                                </td>
                                <td class="py-2 align-top">
                                    <div class="ml-[-2rem]">
                                        <p class="text-mal-blue">{{ $character->name }}</p>
                                        <p class="text-xs">{{ $animeCharacter->role }}</p>
                                    </div>
                                </td>
                            <tr>
                                <td colspan="2">
                                    <hr class="my-1 border-t-2 border-gray-100">
                                </td>
                            </tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Staff --}}
                <div class="mt-2 flex justify-between">
                    <h1 class="text-black">
                        <strong>Staff</strong>
                    </h1>
                    <div class="ml-auto">
                        <a href="{{ route('anime.characters.createconnection', ['anime' => $anime->id]) }}" class="text-link-blue me-6">
                            <strong class="text-sm">Edit</strong>
                        </a>
                        <a href="{{ route('anime.characters.createconnection', ['anime' => $anime->id]) }}" class="text-link-blue">
                            <strong class="text-sm">More staff</strong>
                        </a>
                    </div>
                </div>

                <hr class="mt-[-5px] mb-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->

                {{-- Songs --}}
                <div class="mt-6 flex justify-between">
                    <div class="w-1/2 flex items-center">
                        <h1 class="text-black">
                            <strong>Opening Theme</strong>
                        </h1>
                        <a href="{{ route('songs.create', ['anime' => $anime->id, 'theme_type' => 'Opening']) }}" class="text-link-blue ml-auto me-6">
                            <strong class="text-sm">Edit</strong>
                        </a>
                    </div>
                    <div class="w-1/2 flex items-center">
                        <h1 class="text-black">
                            <strong>Ending Theme</strong>
                        </h1>
                        <a href="{{ route('songs.create', ['anime' => $anime->id, 'theme_type' => 'Ending']) }}" class="text-link-blue ml-auto">
                            <strong class="text-sm">Edit</strong>
                        </a>
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/2 flex items-center">
                        <hr class="mt-[-5px] border-t-2 border-gray-300 w-[95%]">
                    </div>
                    <div class="w-1/2 flex items-center">
                        <hr class="mt-[-5px] border-t-2 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex justify-between">
                    {{-- Opening Songs --}}
                    <div class="w-1/2">
                        @foreach($anime->Song()->where('theme_type', 'Opening')->get() as $key => $song)
                        <div class="flex items-center">
                            <div class="flex items-center">
                                @if(count($anime->Song()->where('theme_type', 'Opening')->get()) > 1)
                                <p class="text-gray-600">{{ $key + 1 }}:{!! "&nbsp;" !!}</p>
                                @endif
                                <p class="text-mal-blue">"{{ $song->title }}"{!! "&nbsp;" !!}</p>
                                <p class="text-gray-600"> by {{ $song->singer }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- Ending Songs --}}
                    <div class="w-1/2">
                        @foreach($anime->Song()->where('theme_type', 'Ending')->get() as $key => $song)
                        <div class="flex items-center">
                            @if(count($anime->Song()->where('theme_type', 'Ending')->get()) > 1)
                            <p class="text-gray-600">{{ $key + 1 }}:{!! "&nbsp;" !!}</p>
                            @endif
                            <p class="text-mal-blue"> "{{ $song->title }}"{!! "&nbsp;" !!}</p>
                            <p class="text-gray-600"> by {{ $song->singer }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <hr class="mt-[-5px] mb-2 border-t-2 border-gray-300">

                {{-- Reviews --}}
                <div class="mt-4">
                    <h1 class="text-black">
                        <strong>Reviews</strong>
                    </h1>
                    <hr class="my-2 border-t-2 border-gray-300"> <!-- Add this line for the horizontal rule -->
                    <div>
                        <div class="bg-[#F9F8F9] flex flex-row justify-between px-8 h-8 items-center ">
                            <a href="{{ route('review.create', ['anime_id' => $anime -> id, 'user_id' => Auth::user()->id ]) }}" class="text-mal-blue font-bold hover:underline">Write review</a>
                            <a href="{{ route('review.showAll', ['id' => $anime -> id]) }}" class="text-mal-blue font-bold hover:underline">All reviews</a>
                        </div>
                    </div>
                    @foreach ($latest_reviews as $review)
                        <x-show-review img="{{ $review -> profile_picture }}" title="{{ $review -> title }}" user="{{ $review -> name }}" comment="{{ $review -> comment }}" time="{{ $review -> created_at }}" review="{{ $review -> review_id }}"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>