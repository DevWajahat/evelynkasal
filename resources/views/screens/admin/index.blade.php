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
                <p class="mt-1 text-sm text-sky-100">Live operational dashboard for Evelyn Kasal's author portfolio website.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-slate-800 shadow-sm hover:bg-slate-100 transition-colors">
                    <i class="fa fa-arrow-up-right-from-square text-xs"></i>
                    <span>Preview Site</span>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Published Blocks</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">{{ $activePublishedCount }} / {{ $sections->count() }}</h4>
                <p class="mt-0.5 text-xs text-slate-500">Active on Frontend</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-50 text-brand-600">
                <i class="fa fa-book-open text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Meta Keys</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">{{ $totalMetaKeys }}</h4>
                <p class="mt-0.5 text-xs text-slate-500">Across {{ $totalSections }} Sections</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                <i class="fa fa-layer-group text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Uploaded Assets</p>
                <h4 class="mt-1 text-2xl font-bold text-slate-800">{{ $uploadFilesCount }} Files</h4>
                <p class="mt-0.5 text-xs text-slate-500">in /public/uploads/cms</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                <i class="fa fa-images text-xl"></i>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Storage Status</p>
                <h4 class="mt-1 text-2xl font-bold {{ $storageLinked ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $storageLinked ? 'Healthy' : 'Check Disk' }}
                </h4>
                <p class="mt-0.5 text-xs text-slate-500">Public Disk Link</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                <i class="fa fa-hard-drive text-xl"></i>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 class="font-semibold text-slate-800">Core Content Blocks</h3>
                <p class="text-xs text-slate-400">Live synchronization status across all landing and internal page sections.</p>
            </div>
            <a href="{{ route('admin.cms.index') }}" class="rounded-md bg-slate-100 hover:bg-slate-200 px-2.5 py-1 text-xs font-medium text-slate-600 transition-colors">Manage All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-400">
                    <tr>
                        <th class="py-3 px-6">Section</th>
                        <th class="py-3 px-6">Scope / Contents</th>
                        <th class="py-3 px-6">Key Assets</th>
                        <th class="py-3 px-6">Sync Status</th>
                        <th class="py-3 px-6">Last Updated</th>
                        <th class="py-3 px-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($sections as $sec)
                    <tr class="hover:bg-slate-50/75 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full {{ $sec['is_published'] ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                <div>
                                    <p class="leading-tight">{{ $sec['name'] }}</p>
                                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider">{{ $sec['page'] }} / {{ $sec['type'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">{{ $sec['scope'] }}</td>
                        <td class="py-4 px-6 font-mono text-xs text-slate-500">{{ $sec['assets'] }}</td>
                        <td class="py-4 px-6">
                            @if($sec['is_published'])
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                <i class="fa fa-circle-check text-[10px]"></i> {{ $sec['meta_count'] }} Keys Live
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700">
                                <i class="fa fa-clock text-[10px]"></i> Needs Setup
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-400">{{ $sec['updated_at'] }}</td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route($sec['route']) }}" class="rounded-md bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-600 hover:bg-brand-100 transition-colors">
                                Edit Content
                            </a>
                        </td>
                    </tr>
                    @endforeach
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
                <a href="{{ route('admin.cms.meta.herosection.form') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-pen-nib mb-1 text-base"></i>
                    <span>Hero Section</span>
                </a>
                <a href="{{ route('admin.cms.meta.featured-book.form') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-book mb-1 text-base"></i>
                    <span>Featured Book</span>
                </a>
                <a href="{{ route('admin.cms.meta.about-section.form') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-user-pen mb-1 text-base"></i>
                    <span>Home About</span>
                </a>
                <a href="{{ route('admin.cms.meta.contact.getInTouch') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-100 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                    <i class="fa fa-headset mb-1 text-base"></i>
                    <span>Get In Touch</span>
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
                    <span class="font-mono font-medium text-slate-700">{{ request()->getHost() }}</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Upload Directory</span>
                    <span class="font-semibold text-emerald-600 flex items-center gap-1">
                        <i class="fa fa-circle-check text-[10px]"></i> /public/uploads/cms
                    </span>
                </div>
                <div class="flex justify-between items-center py-1">
                    <span class="text-slate-500">Framework Environment</span>
                    <span class="font-mono font-semibold text-slate-700 capitalize">{{ app()->environment() }}</span>
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
                    <span>Use transparent PNG or WebP files for 3D book cover graphics.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa fa-check text-brand-600 mt-0.5"></i>
                    <span>Always ensure Amazon and retail store URLs include full https:// protocol.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa fa-check text-brand-600 mt-0.5"></i>
                    <span>Keep portrait photos at a clean 1:1 or 4:5 ratio for consistent layouts.</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
