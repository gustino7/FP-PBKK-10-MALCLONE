<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-lg text-gray-800 leading-3">
            {{ $user->name }}'s Profile
        </h4>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-white p-6 shadow sm:rounded-lg flex">
            <div class="w-1/4">
                @if ($user->profile_picture)
                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="{{ $user->name }}" class="w-50 h-50 object-cover rounded-md mb-4">
                @else
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Default Profile Picture" class="w-50 h-50 object-cover rounded-md mb-4">
                @endif

                <div class="my-4 border-l-4 border-mal-blue pl-4">
                    <p class="text-lg font-semibold text-black">Information</p>
                    <p class="text-gray-600">
                        <strong>Joined:</strong> {{ $user->created_at->format('M j, Y') }}
                    </p>
                </div>
            </div>

            <div class="w-full ms-5">
                <div class="h-16 overflow-hidden text-sm">
                    @if ($user->description)
                    {{ $user->description }}
                    @else
                    This user hasn't set a description yet.
                    @endif
                </div>
                <p class="text-black">
                    <strong>Statistics</strong>
                </p>
                <hr class="my-2 border-t-2 border-gray-300">
            </div>

        </div>
    </div>
</x-app-layout>