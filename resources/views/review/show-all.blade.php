<x-app-layout>
    <x-slot name="header">
        <div class="mx-6 mt-3 mb-10">
            <h4 class="font-semibold text-xl text-gray-800 leading-3 mb-2">
                Reviews
            </h4>
            <a href="{{ route('anime.show', ['id' => $anime -> id]) }}" class="font-bold text-gray-400 text-xl hover:underline">{{ $anime -> title }}</a>
        </div>
        <div class="flex flex-col">
            @foreach ($reviews as $review)
                <x-show-review img="{{ $review -> profile_picture }}" user="{{ $review -> name }}" comment="{{ $review -> comment }}" time="{{ $review -> created_at }}" review="{{ $review -> reviewId }}"/>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>