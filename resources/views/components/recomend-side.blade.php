<div class="flex flex-row my-2">
    <div class="basis-1/5 text-center items-center">
        <h1 class="text-lg font-bold">{{ $num }}</h1>
    </div>
    <div class="basis-1/5 mx-3">
        <a href="{{ route('anime.show', ['id' => $id]) }}" class="min-w-[4.5rem] w-full h-[5.75rem]">
            <img src="{{ $img }}" alt="anime">
        </a>
    </div>
    <div class="basis-3/5 flex flex-col">
        <div>
            <h1 class="text-blue-400 hover:underline"><a href="{{ route('anime.show', ['id' => $id]) }}">{{ $title }}</a></h1>
        </div>
        <div>
            <h1 class="text-sm">{{ $type }}, {{ $episode }} eps, scored {{ $rating }}</h1>
        </div>
    </div>
</div>