@include('includes.admin.head')

<div class="flex min-h-screen">
    <div id="sidebarBackdrop" class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm hidden md:hidden"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-slate-200 bg-white transition-transform duration-300 ease-in-out -translate-x-full md:static md:translate-x-0">
        <div class="flex h-16 items-center justify-between px-6 border-b border-slate-200">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-brand-600 font-bold text-xl">
                <i class="fa fa-hashtag"></i>
                <span class="tracking-wide text-slate-900">Evelyn</span>
            </a>
        </div>

        <nav class="flex-1 space-y-1.5 overflow-y-auto px-3 py-4 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-gauge w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.cms.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.index') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-layer-group w-5 text-center"></i>
                <span>Page Sections</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Home Page Sections</div>

            <a href="{{ route('admin.cms.meta.herosection.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.herosection.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-image w-5 text-center"></i>
                <span>Hero Section</span>
            </a>

            <a href="{{ route('admin.cms.meta.featured-book.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.featured-book.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-book-bookmark w-5 text-center"></i>
                <span>Featured Book</span>
            </a>

            <a href="{{ route('admin.cms.meta.about-section.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.about-section.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-user-pen w-5 text-center"></i>
                <span>About Author</span>
            </a>

            <a href="{{ route('admin.cms.meta.newsletter.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.newsletter.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-envelope-open-text w-5 text-center"></i>
                <span>Newsletter</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Books Page Sections</div>

            <a href="{{ route('admin.cms.meta.book.storytellingSection.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.book.storytellingSection.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-book-open w-5 text-center"></i>
                <span>Storytelling Section</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">About Page Sections</div>

            <a href="{{ route('admin.cms.meta.about-page.form') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.about-page.*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-address-card w-5 text-center"></i>
                <span>About Section</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Contact Page Sections</div>

            <a href="{{ route('admin.cms.meta.contact.getInTouch') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('admin.cms.meta.contact.getInTouch*') ? 'text-brand-600 bg-brand-50' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <i class="fa fa-headset w-5 text-center"></i>
                <span>Get In Touch</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-200">
            <a href="{{ route('admin.logout') }}" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-rose-600 hover:bg-rose-50 text-sm font-medium transition-colors">
                <i class="fa fa-power-off w-5 text-center"></i>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <div class="flex flex-1 flex-col min-w-0">
        @include('includes.admin.header')

        <main class="flex-1 p-4 md:p-6 lg:p-8">
            @yield('content')
        </main>

        @include('includes.admin.footer')
    </div>
</div>

@include('includes.admin.script')
