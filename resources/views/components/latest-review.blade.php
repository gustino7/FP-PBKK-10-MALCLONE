<div class="my-2">
    <div class="flex flex-row h-[7rem]">
        <div class="w-[20%]">
            <img src="{{ $img }}" alt="anime" class="w-[5rem] h-full">
        </div>
        <div class="flex flex-col w-[80%] justify-between">
            {{-- Ganti href ke anime id --}}
            <h1 class="text-blue-400 text-sm hover:underline cursor-pointer w-fit"><a href="#">{{ $title }}</a></h1>
            {{-- Ganti text dengan comment di table review--}}
            <p class="text-justify line-clamp-3 text-xs">This is the biggest example of a "mixed feelings" anime i could ever think of.
                If someone could enjoy this anime really depends from person to person. I would personally rate it much higher than the average score, around 7.5, but at the same time I think that the low score is understandable.
                Good thing is that the first episode is enough to understand if this anime could be enjoyed or not.
                I would raccommend to watch the first episode even for just see this unique example of this anime, not necessarely to enjoy it, but to find something new.
                
                It has two important two very important names behind it: Ookubo, character designer behind Soul Eater/Fire Force and Yoko Taro, director of the Nier and Drakengard series.
                I know almost nothing about Ookubo other than his fame, but I am a huge Yoko Taro fan.
                Despite what some people say, you can really feel Yoko Taro was behind this anime, like the tragic characters and the feeling that everything will go wrong.
                If you enjoyed Taro's games before Nier Automata was a thing, like Drakengard 1 and 3, and the first version of Nier, the story story of this anime is something that you could enjoy.
            </p>
            {{-- Ganti href ke id review --}}
            <a href="#" class="text-xs text-blue-400 hover:underline w-fit">read more ...</a>
            {{-- Ganti href ke id user --}}
            <p class="text-gray-500 text-xs">13 minutes ago by <a href="#" class="text-blue-400 hover:underline">{{ $user }}</a></p>
        </div>
    </div>
</div>