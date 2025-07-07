<nav x-data="{ open: false }" class="shadow-2xl sticky top-0 z-50 transition-all duration-500 border-b-8 border-blue-400" style="background-color: #0a224e;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-4">
                <!-- Logo Animasi -->
                <div class="shrink-0 flex items-center animate-bounce">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white relative group">
                        {{ __('Dashboard') }}
                        <span class="absolute left-0 -bottom-1 w-0 h-1 bg-white rounded-full group-hover:w-full transition-all duration-300"></span>
                    </x-nav-link>
                    @if(\App\Helpers\UserHelper::isLoggedIn())
                        <x-nav-link :href="route('schedules.index')" :active="request()->routeIs('schedules.*')" class="text-white relative group">
                            {{ __('Jadwal') }}
                            <span class="absolute left-0 -bottom-1 w-0 h-1 bg-white rounded-full group-hover:w-full transition-all duration-300"></span>
                        </x-nav-link>
                        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')" class="text-white relative group">
                            {{ __('Booking') }}
                            <span class="absolute left-0 -bottom-1 w-0 h-1 bg-white rounded-full group-hover:w-full transition-all duration-300"></span>
                        </x-nav-link>
                        <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')" class="text-white relative group">
                            {{ __('Tiket') }}
                            <span class="absolute left-0 -bottom-1 w-0 h-1 bg-white rounded-full group-hover:w-full transition-all duration-300"></span>
                        </x-nav-link>
                        @if(\App\Helpers\UserHelper::IsAdmin())
                            <x-nav-link :href="route('trains.index')" :active="request()->routeIs('trains.*')" class="text-white relative group">
                                {{ __('Kelola Kereta') }}
                                <span class="absolute left-0 -bottom-1 w-0 h-1 bg-white rounded-full group-hover:w-full transition-all duration-300"></span>
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gradient-to-r from-indigo-500 to-blue-500 shadow hover:scale-105 focus:outline-none transition-all duration-300">
                            @if(\App\Helpers\UserHelper::isLoggedIn())
                                <div>{{ \App\Helpers\UserHelper::currentUserName() }}</div>
                                @if(\App\Helpers\UserHelper::IsAdmin())
                                    <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Admin</span>
                                @endif
                            @else
                                <div>Guest</div>
                            @endif
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @if(\App\Helpers\UserHelper::isLoggedIn())
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-600 focus:outline-none focus:bg-indigo-700 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 transition-all duration-500">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(\App\Helpers\UserHelper::isLoggedIn())
                <x-responsive-nav-link :href="route('schedules.index')" :active="request()->routeIs('schedules.*')" class="text-white">
                    {{ __('Jadwal') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')" class="text-white">
                    {{ __('Booking') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')" class="text-white">
                    {{ __('Tiket') }}
                </x-responsive-nav-link>
                @if(\App\Helpers\UserHelper::IsAdmin())
                    <x-responsive-nav-link :href="route('trains.index')" :active="request()->routeIs('trains.*')" class="text-white">
                        {{ __('Kelola Kereta') }}
                    </x-responsive-nav-link>
                @endif
            @endif
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-200">
            <div class="px-4">
                @if(\App\Helpers\UserHelper::isLoggedIn())
                    <div class="font-medium text-base text-white">{{ \App\Helpers\UserHelper::currentUserName() }}</div>
                    <div class="font-medium text-sm text-indigo-100">{{ \App\Helpers\UserHelper::currentUserEmail() }}</div>
                    @if(\App\Helpers\UserHelper::IsAdmin())
                        <div class="font-medium text-xs text-red-600 bg-red-100 px-2 py-1 rounded mt-1 inline-block">Admin</div>
                    @endif
                @else
                    <div class="font-medium text-base text-white">Guest</div>
                @endif
            </div>
            <div class="mt-3 space-y-1">
                @if(\App\Helpers\UserHelper::isLoggedIn())
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-white"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')" class="text-white">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-white">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
</nav>
