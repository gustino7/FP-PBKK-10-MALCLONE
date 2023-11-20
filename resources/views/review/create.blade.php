<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3 mb-8">
            My Review
        </h4>
        <div class="flex flex-col gap-y-4">
            <div>
                <h1 class="font-bold text-lg text-gray-600">{{ $anime->title }}</h1>
            </div>
            <form action="{{ route('review.store', ['anime_id' => $anime->id, 'user_id' => Auth::user()->id ]) }}" method="post" class="flex flex-col gap-y-4 w-[40rem]">
                @csrf
                <div class="flex flex-row gap-x-6">
                    <div class="flex flex-col">
                        <select name="status" id="status" class="rounded-lg h-[2.2rem] text-sm text-center">
                            @foreach(['Watching', 'Completed', 'On-hold', 'Dropped', 'Plan-to-watch'] as $option)
                                <option value="{{ $option }}">
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        <label class="text-sm text-gray-500">Status<span class="text-red-500">*</span></label>
                    </div>
                    <div class="flex flex-col">
                        <select name="rating" id="rating" class="rounded-lg h-[2.2rem] text-sm text-center">
                            @for ($i = 10; $i >= 1; $i--)
                                <option value="{{ $i }}">
                                    ({{ $i }}) 
                                    @if ($i == 10)
                                        Masterpiece
                                    @elseif ($i >= 8)
                                        Great
                                    @elseif ($i >= 6)
                                        Very Good
                                    @elseif ($i >= 4)
                                        Good
                                    @elseif ($i >= 2)
                                        Fine
                                    @else
                                        Average
                                    @endif
                                </option>
                            @endfor
                        </select>
                        <label class="text-sm text-gray-500">Rating<span class="text-red-500">*</span></label>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="font-bold">Review Text <span class="text-red-600 font-normal">(required)</span></label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="rounded-md h-[10rem]"></textarea>
                </div>
                <div class="flex flex-col gap-y-4">
                    <h1 class="font-bold">Would you recommend this?<span class="text-red-600 font-normal">(required)</span></h1>
                    <div>
                        <div class="ml-4">
                            <input type="radio" name="feelings" id="recommended" value="recommended">
                            <label for="recommended">Recommended</label>
                        </div>
                        <p class="text-gray-500">Review readers should definitely watch this!</p>
                    </div>
                    <div>
                        <div class="ml-4">
                            <input type="radio" name="feelings" id="mixed" value="mixed">
                            <label for="mixed">Mixed Feelings</label>
                        </div>
                        <p class="text-gray-500">Not sure. Some review readers will like this, but others will not enjoy it.</p>
                    </div>
                    <div>
                        <div class="ml-4">
                            <input type="radio" name="feelings" id="bad" value="bad">
                            <label for="bad">Not Recommended</label>
                        </div>
                        <p class="text-gray-500">Most review readers will not like this.</p>
                    </div>
                </div>
                <div class="flex flex-row items-center relative w-fit hover:opacity-80">
                    <button type="submit" class="bg-mal-blue text-white py-2 pl-4 rounded text-center text-sm font-bold w-32">Publish</button>
                    <svg class="h-5 w-5 text-white font-bold absolute left-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" >  
                        <path stroke="none" d="M0 0h24v24H0z"/> 
                            <line x1="10" y1="14" x2="21" y2="3" />
                        <path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3" />
                    </svg>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>