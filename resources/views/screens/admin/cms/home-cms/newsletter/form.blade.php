@extends('layouts.admin.app', ['title' => 'Manage Newsletter Section'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Home Newsletter Section</h2>
            <p class="text-xs text-slate-500">Edit the headline and description copy for the email subscriber call-to-action.</p>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
            <i class="fa fa-arrow-left"></i>
            <span>Back to Sections</span>
        </a>
    </div>

    @if(session('success'))
    <div class="flex items-center justify-between rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs text-emerald-800">
        <div class="flex items-center gap-2">
            <i class="fa fa-circle-check text-sm text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">
            <i class="fa fa-xmark"></i>
        </button>
    </div>
    @endif

    <div class="max-w-3xl">
        <form action="{{ route('admin.cms.meta.newsletter.save') }}" method="POST" class="space-y-6">
            @csrf

            <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Headline & Description</h3>

                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Newsletter Title <span class="text-rose-500">*</span></label>
                    <input type="text" id="title" name="title" required
                        value="{{ old('title', $metas['title'] ?? 'SUBSCRIBE TO NEWSLETTER') }}"
                        placeholder="SUBSCRIBE TO NEWSLETTER"
                        class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-base font-bold text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                    @error('title')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Subtitle / Description <span class="text-rose-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required
                        placeholder="Stay updated with the latest book releases, blog posts, and exclusive news delivered straight to your inbox."
                        class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm leading-relaxed text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('description', $metas['description'] ?? '') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa fa-floppy-disk"></i>
                        <span>Save Newsletter Section</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
