@extends('layouts.admin.app', ['title' => 'Manage Contact Page'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Contact Page CMS</h2>
            <p class="text-xs text-slate-500">Manage the banner headers, left contact information, icons, and social media handles.</p>
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

    <form action="{{ route('admin.cms.meta.contact.getInTouch.save') }}" method="POST" class="space-y-6">
        @csrf

        <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-4">
            <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">1. Top Banner Header</h3>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label for="page_title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Main Banner Title <span class="text-rose-500">*</span></label>
                    <input type="text" id="page_title" name="page_title" required
                        value="{{ old('page_title', $metas['page_title'] ?? 'CONTACT') }}"
                        placeholder="CONTACT"
                        class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm font-bold text-slate-800 focus:border-brand-500 focus:outline-none">
                    @error('page_title')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="page_subtitle" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Subtitle / Tagline Line</label>
                    <input type="text" id="page_subtitle" name="page_subtitle"
                        value="{{ old('page_subtitle', $metas['page_subtitle'] ?? 'Have a question about the book, or just want to say hello? I\'d love to hear from you.') }}"
                        placeholder="Have a question about the book, or just want to say hello? I'd love to hear from you."
                        class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">2. Left Content & Blurb</h3>

                    <div>
                        <label for="section_heading" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Heading <span class="text-rose-500">*</span></label>
                        <input type="text" id="section_heading" name="section_heading" required
                            value="{{ old('section_heading', $metas['section_heading'] ?? 'GET IN TOUCH') }}"
                            placeholder="GET IN TOUCH"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm font-bold text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="section_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Description Narrative <span class="text-rose-500">*</span></label>
                        <textarea id="section_description" name="section_description" rows="5" required
                            placeholder="Whether you are interested in a reading, a signed copy of the book, or simply want to share your thoughts, feel free to reach out."
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm leading-relaxed text-slate-800 focus:border-brand-500 focus:outline-none">{{ old('section_description', $metas['section_description'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">3. Follow Me / Social Media Links</h3>

                    <div>
                        <label for="social_instagram" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <i class="fa-brands fa-instagram text-rose-500 mr-1"></i> Instagram Link
                        </label>
                        <input type="text" id="social_instagram" name="social_instagram"
                            value="{{ old('social_instagram', $metas['social_instagram'] ?? '') }}"
                            placeholder="https://instagram.com/username"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="social_x" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <i class="fa-brands fa-x-twitter text-slate-800 mr-1"></i> X (Twitter) Link
                        </label>
                        <input type="text" id="social_x" name="social_x"
                            value="{{ old('social_x', $metas['social_x'] ?? '') }}"
                            placeholder="https://x.com/username"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="social_facebook" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                            <i class="fa-brands fa-facebook text-sky-600 mr-1"></i> Facebook Link
                        </label>
                        <input type="text" id="social_facebook" name="social_facebook"
                            value="{{ old('social_facebook', $metas['social_facebook'] ?? '') }}"
                            placeholder="https://facebook.com/username"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">4. Contact Information & Icons</h3>

                    <div class="p-4 rounded-lg bg-slate-50 border border-slate-200 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-200 text-slate-700 text-xs">
                                <i class="{{ $metas['email_icon'] ?? 'fa-regular fa-envelope' }}" id="emailIconDisplay"></i>
                            </span>
                            <span class="text-xs font-bold text-slate-700">Email Configuration</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="email_label" class="block text-[11px] font-semibold uppercase text-slate-500">Label</label>
                                <input type="text" id="email_label" name="email_label"
                                    value="{{ old('email_label', $metas['email_label'] ?? 'Email') }}"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-brand-500 focus:outline-none">
                            </div>

                            <div>
                                <label for="email_icon" class="block text-[11px] font-semibold uppercase text-slate-500">FontAwesome Icon Class</label>
                                <input type="text" id="email_icon" name="email_icon"
                                    value="{{ old('email_icon', $metas['email_icon'] ?? 'fa-regular fa-envelope') }}"
                                    placeholder="fa-regular fa-envelope"
                                    oninput="document.getElementById('emailIconDisplay').className = this.value"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-mono text-slate-800 focus:border-brand-500 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="email_value" class="block text-[11px] font-semibold uppercase text-slate-500">Displayed Email</label>
                            <input type="text" id="email_value" name="email_value"
                                value="{{ old('email_value', $metas['email_value'] ?? 'info@evelynkasal.com') }}"
                                placeholder="info@example.com"
                                class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-brand-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="p-4 rounded-lg bg-slate-50 border border-slate-200 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-200 text-slate-700 text-xs">
                                <i class="{{ $metas['location_icon'] ?? 'fa-solid fa-location-dot' }}" id="locIconDisplay"></i>
                            </span>
                            <span class="text-xs font-bold text-slate-700">Location Configuration</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="location_label" class="block text-[11px] font-semibold uppercase text-slate-500">Label</label>
                                <input type="text" id="location_label" name="location_label"
                                    value="{{ old('location_label', $metas['location_label'] ?? 'Location') }}"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-brand-500 focus:outline-none">
                            </div>

                            <div>
                                <label for="location_icon" class="block text-[11px] font-semibold uppercase text-slate-500">FontAwesome Icon Class</label>
                                <input type="text" id="location_icon" name="location_icon"
                                    value="{{ old('location_icon', $metas['location_icon'] ?? 'fa-solid fa-location-dot') }}"
                                    placeholder="fa-solid fa-location-dot"
                                    oninput="document.getElementById('locIconDisplay').className = this.value"
                                    class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-mono text-slate-800 focus:border-brand-500 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="location_value" class="block text-[11px] font-semibold uppercase text-slate-500">Address / City</label>
                            <input type="text" id="location_value" name="location_value"
                                value="{{ old('location_value', $metas['location_value'] ?? 'Duxbury, MA, USA') }}"
                                placeholder="City, State, Country"
                                class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-1.5 text-xs text-slate-800 focus:border-brand-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-3 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa fa-floppy-disk"></i>
                        <span>Save Contact Information</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
