<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-500 h-8 py-2 px-4 border border-b-2 border-gray-200">
            <h4 class="font-semibold text-xl text-white leading-3">
                Review
            </h4>
        </div>
        <div class="my-6">
            <p class="text-gray-400 mb-6"><a href="{{ route('anime.show', ['id' => $anime -> id]) }}" class="text-blue-400 hover:underline hover:underline-offset-2">{{ $anime -> title }}</a> (anime)</p>
            <div class="flex flex-row gap-x-10">
                <div>
                    <img src="{{ asset('storage/' . $user -> profile_picture) }}" alt="profile{{ $user -> name }}" class="h-16">
                </div>
                <div class="w-full">
                    <div class="flex flex-row justify-between">
                        <a href="">{{ $user -> name }}</a>
                        <p>{{ $date }}</p>
                    </div>
                    <div class="w-fit bg-gray-300 p-1 rounded-md hover:bg-gray-400">
                        <p>{{ $review -> feelings }} feelings</p>
                    </div>
                    <p class="my-4">{{ $review -> comment }}</p>
                    <p class="my-4">Reviewer’s Rating: {{ $review -> rating }}</p>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>