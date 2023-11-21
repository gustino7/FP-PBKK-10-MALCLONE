<div class="my-[1rem]" draggable="false">
    <div class="border-b border-black mb-2">
        <a href="#">
            <h1>{{ $title }}</h1>
        </a>
    </div>
    <div class="min-w-[328.71px] cursor-pointer relative group">
        <div class="flex flex-row gap-x-2 carousel{{ $idn }} snap-center scroll-smooth overflow-hidden">
            @foreach($animes as $anime)
            <div class="card{{ $idn }} max-w-[9rem] min-w-[9rem] h-[12.75rem] hover:opacity-80" draggable="false">
                <a href="{{ route('anime.show', ['id' => $anime->id]) }}">
                    @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                    <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="h-full">
                    @else
                    <img src="storage/posters/{{ $anime->poster }}" alt="anime" class="h-full">
                    @endif
                </a>
            </div>
            @endforeach
        </div>
        <div id="leftArrow{{ $idn }}" class="arrow{{ $idn }} hidden group-hover:block absolute top-[25%] -translate-x-0 -translate-y-[-50%] left-2 text-2xl rounded-xl p-2 bg-black/50 text-white cursor-pointer" draggable="false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </div>
        <div id="rightArrow{{ $idn }}" class="arrow{{ $idn }} hidden group-hover:block absolute top-[25%] -translate-x-0 -translate-y-[-50%] right-2 text-2xl rounded-xl p-2 bg-black/50 text-white cursor-pointer" draggable="false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </div>
    </div>
</div>

<script>
    const carousel_{{ $idn }} = document.querySelector(".carousel{{ $idn }}");
    const arrowBtns_{{ $idn }} = document.querySelectorAll(".arrow{{ $idn }}");
    const scrollHorizontal_{{ $idn }} = (carousel_{{ $idn }}.querySelector(".card{{ $idn }}").offsetWidth)*5;

    arrowBtns_{{ $idn }}.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel_{{ $idn }}.scrollLeft += btn.id === "leftArrow{{ $idn }}" ? -scrollHorizontal_{{ $idn }} : scrollHorizontal_{{ $idn }};
        })
    });
</script>