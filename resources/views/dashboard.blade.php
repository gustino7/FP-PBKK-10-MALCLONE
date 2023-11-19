<x-app-layout>
    <x-slot name="header">
        <div class="font-bold border-b border-black bg-slate-50">
            <h1 class="tracking-widest">Welcome to MAL!</h1>
        </div>
        <div class="flex flex-row border border-gray-400">
            <div class="mx-2 my-4 p-6 flex flex-col w-[60%] border-r border-black">
                @include('components.caraousel', ['animes' => $animes_tv, 'idn' => 'type', 'title' => 'Type TV'])
                @include('components.caraousel', ['animes' => $animes_latest, 'idn' => 'latest', 'title' => 'Latest Updated'])
                @include('components.caraousel', ['animes' => $animes_tv, 'idn' => 'action', 'title' => 'Genre Action'])
                @include('components.caraousel', ['animes' => $animes_tv, 'idn' => 'life', 'title' => 'Genre Slice of Life'])
                <div class="border-b border-black">
                    <h1><a href="#">Latest Review</a></h1>
                </div>
                @for($i = 1; $i <= 2; $i++)
                    <x-latest-review img="storage/profile_pictures/frieren.jpg" title="Frieren" user="ryanw531"/>
                    <x-latest-review img="storage/profile_pictures/sao.jpg" title="Sword Art Online" user="Nohexz881"/>
                @endfor
            </div>
            <div class="flex flex-col w-[35%] mx-auto">
                <div class="mt-[2.4rem] h-fit">
                    <div class="bg-slate-600 px-4 py-1">
                        <h1 class="text-md font-bold text-white">Upcoming Anime</h1>
                    </div>
                    <div class="flex flex-col bg-slate-100">
                        @foreach($animes_upcoming as $anime)
                            <x-recomend-side num="{{ $loop -> iteration }}" img="storage/posters/{{ $anime->poster }}" title="{{ $anime->title }}" type="{{ $anime->type }}" episode="{{ $anime->type }}" rating="{{ $anime->avg_rating }}" />
                        @endforeach
                    </div>
                </div>
                <div class="my-[1rem] h-fit">
                    <div class="bg-slate-600 px-4 py-1">
                        <h1 class="text-md font-bold text-white"><a href="/topanime">Top Anime</a></h1>
                    </div>
                    <div class="flex flex-col bg-slate-100">
                        @foreach($animes_top as $anime)
                            <x-recomend-side num="{{ $loop -> iteration }}" img="storage/posters/{{ $anime->poster }}" title="{{ $anime->title }}" type="{{ $anime->type }}" episode="{{ $anime->episode }}" rating="{{ $anime->avg_rating }}" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>

</x-app-layout>