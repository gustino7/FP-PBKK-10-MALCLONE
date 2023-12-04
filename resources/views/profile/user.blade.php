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

                <p class="text-black mt-3">
                <h3>Anime Stats</h3>
                </p>

                <hr class="my-2 border-t-2 border-gray-300">
                <!-- User Anime Statistics -->
                <div class="flex">
                    <!-- Total Entries, Watch Time, and Status -->
                    <div class="w-1/2">
                        <!-- User Status for Watched Anime -->
                        <ul>
                            <!-- Watching -->
                            <li class="flex items-center">
                                <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Watching']) }}" class="flex items-center">
                                    <svg height="12" width="12" class="statusCircle" style="background-color: #2CB139; border-radius: 50%;"></svg>
                                    <span class="ml-2 text-mal-blue">Watching: </span>
                                    <span>{!! "&nbsp;" !!} {{ $user->Review()->where('status', 'Watching')->count() }}</span>
                                </a>
                            </li>

                            <!-- Completed -->
                            <li class="flex items-center">
                                <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Completed']) }}" class="flex items-center">
                                    <svg height="12" width="12" class="statusCircle" style="background-color: #26458E; border-radius: 50%;"></svg>
                                    <span class="ml-2 text-mal-blue">Completed: </span>
                                    <span>{!! "&nbsp;" !!} {{ $user->Review()->where('status', 'Completed')->count() }}</span>
                                </a>
                            </li>


                            <!-- On-Hold -->
                            <li class="flex items-center">
                                <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'On-Hold']) }}" class="flex items-center">
                                    <svg height="12" width="12" class="statusCircle" style="background-color: #E6B714; border-radius: 50%;"></svg>
                                    <span class="ml-2 text-mal-blue">On-Hold: </span>
                                    <span> {!! "&nbsp;" !!} {{ $user->Review()->where('status', 'On-Hold')->count() }} </span>
                                </a>
                            </li>

                            <!-- Dropped -->
                            <li class="flex items-center">
                                <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Dropped']) }}" class="flex items-center">
                                    <svg height="12" width="12" class="statusCircle" style="background-color: #A12F31; border-radius: 50%;"></svg>
                                    <span class="ml-2 text-mal-blue">Dropped: </span>
                                    <span>{!! "&nbsp;" !!} {{ $user->Review()->where('status', 'Dropped')->count() }}</span>
                                </a>
                            </li>

                            <!-- Plan To Watch -->
                            <li class="flex items-center">
                                <a href="{{ route('user.animeList', ['username' => $user->name, 'status' => 'Plan To Watch']) }}" class="flex items-center">
                                    <svg height="12" width="12" class="statusCircle" style="background-color: #8E8E8F; border-radius: 50%;"></svg>
                                    <span class="ml-2 text-mal-blue">Plan To Watch: </span>
                                    <span>{!! "&nbsp;" !!} {{ $user->Review()->where('status', 'Plan To Watch')->count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="mt-2 mb-2 border-t-2 border-gray-300">
            </div>
        </div>
    </div>
</x-app-layout>