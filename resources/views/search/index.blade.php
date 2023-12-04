<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-center mb-8">
                        <div class="flex items-center mr-6  ">
                            <a href="#anime" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Anime</a>
                        </div>
                        <div class="flex items-center mr-6">
                            <a href="#staff" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Staff</a>
                        </div>
                        <div class="flex items-center  ">
                            <a href="#users" class="border text-mal-blue px-4 py-2 rounded hover:bg-blue-500 hover:text-white">Users</a>
                        </div>
                    </div>


                    <div id="anime" class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Anime Results</h3>
                        @foreach ($animeResults as $anime)
                        <a href="{{ route('anime.show', ['id' => $anime->id]) }}" class="flex items-start mb-4 text-mal-blue">
                            @if (filter_var($anime->poster, FILTER_VALIDATE_URL))
                            <img src="{{ $anime->poster }}" alt="{{ $anime->title }}" class="w-[3rem] h-[4rem] object-cover ">
                            @else
                            <img src="{{ asset('storage/posters/' . $anime->poster) }}" alt="{{ $anime->title }}" class="w-[3rem] h-[4rem]  object-cover">
                            @endif
                            <div class="ml-4">
                                <span>{{ $anime->title }}</span>
                                <span class="block text-gray-600">{{ $anime->type }} ({{ $anime->episode }} episodes)</span>
                                <span class="block text-gray-600">Scored: {{ $anime->avg_rating }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <div id="staff" class="mb-8">
                        <h3 class="text-lg font-semibold mt-8 mb-4">Staff Results</h3>
                        @foreach ($staffResults as $staff)
                        <a href="{{ route('staff.show', ['staff' => $staff->id]) }}" class="flex items-start mb-4 text-mal-blue">
                            @if (filter_var($staff->profile_picture, FILTER_VALIDATE_URL))
                            <img src="{{ $staff->profile_picture }}" alt="{{ $staff->name }}" class="w-[3rem] h-[4rem] object-cover">
                            @else
                            <img src="{{ asset('storage/' . $staff->profile_picture) }}" alt="{{ $staff->name }}" class="w-[3rem] h-[4rem] object-cover">
                            @endif
                            <span class="ml-4">{{ $staff->name }}</span>
                        </a>
                        @endforeach
                    </div>

                    <div id="users">
                        <h3 class="text-lg font-semibold mt-8 mb-4">User Results</h3>
                        @foreach ($userResults as $user)
                        <a href="{{ route('user.profile', ['username' => $user->name]) }}" class="flex items-start mb-4 text-mal-blue">
                            @if ($user->profile_picture)
                            <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="{{ $user->name }}" class="w-[3rem] h-[4rem] object-cover">
                            @else
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Default Profile Picture" class="w-[3rem] h-[4rem] object-cover">
                            @endif
                            <span class="ml-4">{{ $user->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>