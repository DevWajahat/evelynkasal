@extends('layouts.admin.app', ['title' => 'Author CMS Overview'])

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-gradient-to-r from-brand-600 to-sky-700 p-6 text-white shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm">
                    <i class="fa fa-sparkles text-[10px]"></i> Live Website CMS
                </span>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-white">Author Portal & Content Center</h2>
                <p class="mt-1 text-sm text-sky-100">Quickly control your landing page copy, featured book profiles, press media, and newsletter settings.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{-- url('/') --}}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-slate-800 shadow-sm hover:bg-slate-100 transition-colors">
                    <i class="fa fa-arrow-up-right-from-square text-xs"></i>
                    <span>Preview Site</span>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Published Works</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">Active</h4>
                <p class="mt-0.5 text-xs text-slate-500">Book Showcase</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50 text-brand-600">
                <i class="fa fa-book-open text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Landing Sections</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">6 Blocks</h4>
                <p class="mt-0.5 text-xs text-slate-500">Configured in CMS</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                <i class="fa fa-layer-group text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Reader Inquiries</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">Enabled</h4>
                <p class="mt-0.5 text-xs text-slate-500">Contact / Press Kit</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                <i class="fa fa-envelope-open-text text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Media & Assets</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">Storage Ready</h4>
                <p class="mt-0.5 text-xs text-slate-500">Public Disk Linked</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                <i class="fa fa-images text-xl"></i>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 class="font-semibold text-slate-800">Core Content Blocks</h3>
                <p class="text-xs text-slate-400">Select a section to modify text, imagery, and external buy links.</p>
            </div>
            <span class="rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">Full Access</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-400">
                    <tr>
                        <th class="py-3 px-6">Section</th>
                        <th class="py-3 px-6">Scope / Contents</th>
                        <th class="py-3 px-6">Key Assets</th>
                        <th class="py-3 px-6">Sync Status</th>
                        <th class="py-3 px-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Hero & Headline
                            </div>
                        </td>
                        <td class="py-4 px-6">Main taglines, author sub-heading, Amazon/Barnes & Noble CTA buttons</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">Author Headshot, Book Mockup</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                Published
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{-- route('cms.edit', 'hero') --}}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Edit Content</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Author Biography
                            </div>
                        </td>
                        <td class="py-4 px-6">About the author narrative, awards, career credentials, background</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">Portrait Image, Signature PNG</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                Published
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{-- route('cms.edit', 'about') --}}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Edit Content</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Featured Books
                            </div>
                        </td>
                        <td class="py-4 px-6">Book synopses, ISBN specs, release year, formats (Hardcover, Kindle, Audiobook)</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">High-Res Cover 3D Renders</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                Published
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{-- route('cms.edit', 'books') --}}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Edit Content</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Praise & Reviews
                            </div>
                        </td>
                        <td class="py-4 px-6">Editorial reviews, critic blurbs, reader testimonials, publication stars</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">Publication Brand Logos</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                Published
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{-- route('cms.edit', 'reviews') --}}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Edit Content</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Contact & Inquiries
                            </div>
                        </td>
                        <td class="py-4 px-6">Agent representation info, speaking inquiries text, social handles</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">Downloadable Press Kit PDF</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                Published
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{-- route('cms.edit', 'contact') --}}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Edit Content</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h4 class="font-semibold text-slate-800">Quick CMS Actions</h4>
            </div>
            <div class="grid grid-cols-2 gap-3 text-xs">
                <a href="{{-- route('cms.edit', 'hero') --}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-pen-nib mb-1 text-base"></i>
                    <span>Edit Hero</span>
                </a>
                <a href="{{-- route('cms.edit', 'books') --}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-book mb-1 text-base"></i>
                    <span>Edit Books</span>
                </a>
                <a href="{{-- route('cms.edit', 'about') --}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-user-pen mb-1 text-base"></i>
                    <span>Edit Bio</span>
                </a>
                <a href="{{-- route('cms.edit', 'reviews') --}}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-quote-left mb-1 text-base"></i>
                    <span>Edit Reviews</span>
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h4 class="font-semibold text-slate-800">Author Site Settings</h4>
            </div>
            <div class="space-y-3 text-xs">
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Primary Domain</span>
                    <span class="font-mono font-medium text-slate-700">yourdomain.com</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Media Disk Symlink</span>
                    <span class="font-semibold text-emerald-600 flex items-center gap-1">
                        <i class="fa fa-circle-check text-[10px]"></i> storage:link Active
                    </span>
                </div>
                <div class="flex justify-between items-center py-1">
                    <span class="text-slate-500">Cache Status</span>
                    <span class="font-semibold text-slate-700">Views & Routes Cached</span>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h4 class="font-semibold text-slate-800">Content Guidelines</h4>
            </div>
            <ul class="space-y-2 text-xs text-slate-500">
                <li class="flex items-start gap-2">
                    <i class="fa fa-check text-brand-600 mt-0.5"></i>
                    <span>Use WebP or PNG format for 3D book covers to preserve transparency.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa fa-check text-brand-600 mt-0.5"></i>
                    <span>Verify buy links point to valid Amazon, B&N, or Apple Books URLs.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa fa-check text-brand-600 mt-0.5"></i>
                    <span>Press kit downloads should be uploaded as a PDF asset under 10MB.</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
