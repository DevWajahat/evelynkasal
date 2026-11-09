@include('includes.admin.head', ['title' => 'Admin Login'])

<div class="flex min-h-screen flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-100">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="#" class="inline-flex items-center gap-2 text-2xl font-bold text-brand-600 tracking-tight">
            <i class="fa fa-hashtag"></i>
            <span class="text-slate-900">EvelynKasal</span>
        </a>
        <h2 class="mt-4 text-xl font-bold tracking-tight text-slate-800">Sign in to Admin Panel</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="rounded-xl bg-white py-8 px-6 shadow-sm border border-slate-200 sm:px-10">
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full rounded-lg border @error('email') border-rose-300 ring-rose-300 @else border-slate-300 @enderror px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 sm:text-sm"
                            placeholder="admin@example.com">
                    </div>
                    @error('email')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-lg border @error('password') border-rose-300 ring-rose-300 @else border-slate-300 @enderror px-3.5 py-2.5 text-slate-900 placeholder-slate-400 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                        <label for="remember" class="ml-2 block text-sm text-slate-600">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition-colors">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('includes.admin.script')
