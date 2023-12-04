<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="pb-3">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <!-- User is logged in -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-black">{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-8 h-8 rounded">
                            @else
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Default Profile Picture" class="w-8 h-8 rounded">
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.profile', ['username' => auth()->user()->name])">
                            {{ __('My Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Account Settings') }}
                        </x-dropdown-link>
                        @if (auth()->user()->isAdmin === 1)
                        <x-dropdown-link :href="route('anime.create')">
                            {{ __('Create Anime') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('staff.create')">
                            {{ __('Create Staff') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('studio.create')">
                            {{ __('Create Studio') }}
                        </x-dropdown-link>
                        @endif
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <!-- User is not logged in -->
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="bg-gray-300 text-gray-700 py-1 px-4 rounded transition duration-300 hover:bg-gray-400 focus:outline-none focus:shadow-outline">Login</a>
                    <a href="{{ route('register') }}" class="bg-mal-blue text-white py-1 px-4 rounded transition duration-300 hover:bg-mal-darkblue focus:outline-none focus:shadow-outline">Sign Up</a>
                </div>


                @endauth
            </div>



            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                <!-- User is logged in -->
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @else
                <!-- User is not logged in -->
                <div class="font-medium text-base text-gray-800">Guest</div>
                <div class="font-medium text-sm text-gray-500">guest@example.com</div>
                @endauth
            </div>


            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('anime.create')">
                    {{ __('Create Anime') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>


            </div>
        </div>
    </div>
    <div class="hidden space-x-8 sm:flex max-w-custom mx-auto px-3 sm:px-3 lg:px-3 py-2 bg-mal-blue">
        <x-nav-link :href="route('topanime')" :active="request()->routeIs('topanime')" class="text-white font-black hover:text-black hover:bg-gray-300 ">
            {{ __('Top Anime') }}
        </x-nav-link>

        <x-nav-link :href="route('anime.season', ['year' => 2023, 'season' => 'fall'])" :active="request()->routeIs('anime.season')" class="text-white font-black hover:text-black hover:bg-gray-300">
            {{ __('Seasonal Anime') }}
        </x-nav-link>


        <x-nav-link :href="route('community')" :active="request()->routeIs('community')" class="text-white font-black hover:text-black hover:bg-gray-300 ">
            {{ __('Community') }}
        </x-nav-link>

        <div class="flex justify-end">
            <form action="{{ route('search.index') }}" method="get" class="flex items-center">
                <input type="text" name="query" placeholder="Search" class="px-2 py-1 border rounded focus:outline-none focus:ring focus:border-mal-blue">
                <button type="submit" class="ml-2 bg-gray-300 text-black py-1 px-2 rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline bg-[#E0E7F4]">Search</button>
            </form>
        </div>

    </div>


</nav>