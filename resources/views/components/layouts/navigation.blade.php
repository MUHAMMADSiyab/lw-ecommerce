<nav x-data="{ open: false }" class="bg-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        Estore.pk
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex pt-4 md:pt-0">
                    <x-nav-link href="/" wire:navigate>
                        {{ __('Brands') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right menu -->
            <div class="flex items-center">

                @auth
                    {{-- Setting --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 hover:text-green-500 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>


                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="/" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-nav-link class="relative">
                        <img src="https://picsum.photos/80/80" alt="Profile Photo"
                            class="rounded-full w-10 h-10 object-contain p-1 border-2 border-double border-gray-400 cursor-pointer"
                            title="{{ auth()->user()?->name }}">
                    </x-nav-link>
                @endauth
                @guest
                    <x-nav-link href="/admin/login" wire:navigate>
                        {{ __('Login') }}
                    </x-nav-link>
                @endguest
            </div>
        </div>
    </div>
</nav>
