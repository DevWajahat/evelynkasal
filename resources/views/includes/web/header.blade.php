<div class="{{ request()->routeIs('home') ? 'absolute top-0 left-0 z-50' : 'relative' }} w-full flex justify-center pt-8 px-4 md:px-8" x-data="{ open: false }">
    <header
        class="relative w-full lg:w-[95%] max-w-screen-2xl py-6 px-8 md:px-12 flex items-center justify-between z-40 {{ request()->routeIs('home') ? 'bg-transparent' : 'bg-[#F5F5F5] shadow-sm' }}">

        <div class="text-2xl md:text-3xl font-heavitas uppercase tracking-wider text-[#145072]">
            Evelyn Kasal
        </div>

        <button @click="open = true" class="lg:hidden text-[#333] hover:text-[#145072] focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <nav class="hidden lg:flex space-x-10 text-sm font-bold font-heavitas uppercase tracking-[0.15em] text-[#333]">
            <a href="{{ route('home') }}" class="hover:text-[#145072] transition-colors">Home</a>
            <a href="{{ route('about') }}" class="hover:text-[#145072] transition-colors">About</a>
            <a href="{{ route('book') }}" class="hover:text-[#145072] transition-colors">Book</a>
            <a href="{{ route('contact') }}" class="hover:text-[#145072] transition-colors">Contact</a>
        </nav>
    </header>

    <div x-show="open" style="display: none;" x-transition.opacity @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 lg:hidden">
    </div>

    <div x-show="open" style="display: none;" x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full w-3/4 sm:w-64 bg-[#F5F5F5] shadow-2xl z-50 flex flex-col lg:hidden">

        <div class="flex justify-end p-6 border-b border-gray-200">
            <button @click="open = false" class="text-[#333] hover:text-[#145072] focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <nav class="flex flex-col px-8 py-8 space-y-6 text-sm font-bold uppercase tracking-[0.15em] text-[#333]">
            <a href="{{ route('home') }}"
                class="hover:text-[#145072] transition-colors pb-2 border-b border-gray-200">Home</a>
            <a href="{{ route('about') }}"
                class="hover:text-[#145072] transition-colors pb-2 border-b border-gray-200">About</a>
            <a href="{{ route('book') }}" class="hover:text-[#145072] transition-colors pb-2 border-b border-gray-200">Book</a>
            <a href="{{ route('contact') }}"
                class="hover:text-[#145072] transition-colors pb-2 border-b border-gray-200">Contact</a>
        </nav>
    </div>
</div>
