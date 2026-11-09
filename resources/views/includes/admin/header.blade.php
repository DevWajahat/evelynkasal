<header class="sticky top-0 z-30 flex h-16 w-full items-center justify-between border-b border-slate-200 bg-white px-4 md:px-6 shadow-sm">
    <div class="flex items-center gap-4">
        <button id="sidebarToggle" type="button" class="text-slate-600 hover:text-slate-900 focus:outline-none md:hidden">
            <i class="fa fa-bars text-xl"></i>
        </button>
        <div class="relative hidden sm:block w-64 md:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <i class="fa fa-search text-sm"></i>
            </span>
            <input type="text" class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm text-slate-800 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-brand-500" placeholder="Search orders, products...">
        </div>
    </div>

    <div class="flex items-center gap-3">
        <div class="relative">
            <button class="relative rounded-full p-2 text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:outline-none">
                <i class="fa fa-bell text-lg"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
            </button>
        </div>

        <div class="relative flex items-center gap-3 pl-2 border-l border-slate-200">
            <div class="h-9 w-9 rounded-full bg-brand-500 text-white flex items-center justify-center font-semibold text-sm">
                {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
            </div>
            <div class="hidden text-left md:block">
                <p class="text-sm font-semibold text-slate-700 leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role ?? 'Admin' }}</p>
            </div>

                <a href="{{ route('admin.logout') }}" class="text-slate-400 hover:text-rose-600 ml-2 p-1" title="Logout">
                    <i class="fa fa-arrow-right-from-bracket"></i>
                </a>

        </div>
    </div>
</header>
