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
                    <!-- User Description -->
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

                <!-- User Anime Statistics -->
                <div class="flex">
                    <!-- Total Entries, Watch Time, and Status -->
                    <div class="w-1/2">
                        <p class="text-black">Total Entries: {{ $user->user_anime_count }}</p>
                        <p class="text-black">Total Watch Time: {{ $user->total_watch_time }} hours</p>

                        <!-- User Status for Watched Anime -->
                        <p class="text-black">Status:</p>
                        <ul>
                            <li>
                                Watching: {{ $user->Review()->where('status', 'Watching')->count() }}
                                <svg height="12" width="12" class="statusCircle" style="background-color: #3498db;"></svg>
                            </li>
                            <li>
                                Completed: {{ $user->Review()->where('status', 'Completed')->count() }}
                                <svg height="12" width="12" class="statusCircle" style="background-color: #2ecc71;"></svg>
                            </li>
                            <li>
                                On-Hold: {{ $user->Review()->where('status', 'On-Hold')->count() }}
                                <svg height="12" width="12" class="statusCircle" style="background-color: #f39c12;"></svg>
                            </li>
                            <li>
                                Dropped: {{ $user->Review()->where('status', 'Dropped')->count() }}
                                <svg height="12" width="12" class="statusCircle" style="background-color: #e74c3c;"></svg>
                            </li>
                            <li>
                                Plan To Watch: {{ $user->Review()->where('status', 'Plan To Watch')->count() }}
                                <svg height="12" width="12" class="statusCircle" style="background-color: #9b59b6;"></svg>
                            </li>
                        </ul>
                    </div>

                    <!-- Staff Members Section -->
                    <div class="w-1/2">
                        <!-- ... (Your existing code for displaying staff members) -->
                    </div>
                </div>

                <hr class="mt-[-5px] mb-2 border-t-2 border-gray-300">
            </div>
        </div>
    </div>
</x-app-layout>