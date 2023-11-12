<div class="flex flex-row my-2">
    <div class="basis-1/5 text-center items-center">
        <h1 class="text-lg font-bold">{{ $num }}</h1>
    </div>
    <div class="basis-1/5 mx-3"><img src="{{ $img }}" alt="anime" class="min-w-[4.5rem] w-full h-[5.75rem]"></div>
    <div class="basis-3/5 flex flex-col">
        <div>
            <h1 class="text-blue-400 hover:underline"><a href="#">{{ $title }}</a></h1>
        </div>
        <div>
            <h1 class="text-sm">{{ $type }}, {{ $episode }}, scored {{ $rating }}</h1>
        </div>
    </div>
</div>