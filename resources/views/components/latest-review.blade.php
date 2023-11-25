<div class="my-2">
    <div class="flex flex-row h-[7rem]">
        <div class="w-[20%]">
            <a href="{{ route('anime.show', ['id' => $anime]) }}">
                @if (filter_var($img, FILTER_VALIDATE_URL))
                <img src="{{ $img }}" alt="image" class="w-[5rem] h-full">
                @else
                <img src="storage/posters/{{ $img }}" alt="anime" class="w-[5rem] h-full">
                @endif
            </a>
        </div>
        <div class="flex flex-col w-[80%] justify-between">
            {{-- Ganti href ke anime id --}}
            <h1 class="text-blue-400 text-sm hover:underline cursor-pointer w-fit"><a href="{{ route('anime.show', ['id' => $anime]) }}">{{ $title }}</a></h1>
            {{-- Ganti text dengan comment di table review--}}
            <p class="text-justify line-clamp-3 text-xs">
                {{ $comment }}
            </p>
            {{-- Ganti href ke id review --}}
            <a href="{{ route('review.show', ['id' => $reviewId]) }}" class="text-xs text-blue-400 hover:underline w-fit">read more ...</a>
            {{-- Ganti href ke id user --}}
            <p class="text-gray-500 text-xs">{{ $time }} ago by <a href="{{ route('user.profile', ['username' => $user]) }}" class="text-blue-400 hover:underline">{{ $user }}</a></p>
        </div>
    </div>
</div>