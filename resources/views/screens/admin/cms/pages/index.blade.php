@extends('layouts.admin.app', ['title' => 'Page Sections Management'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">CMS Page Sections</h2>
            <p class="text-xs text-slate-500">Define pages and section identifiers used by meta content builders.</p>
        </div>
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

    @if(session('error'))
    <div class="flex items-center justify-between rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-xs text-rose-800">
        <div class="flex items-center gap-2">
            <i class="fa fa-triangle-exclamation text-sm text-rose-600"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800">
            <i class="fa fa-xmark"></i>
        </button>
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-semibold text-slate-800">
                        {{ $editItem ? 'Edit Section Identifier' : 'Add New Section Identifier' }}
                    </h3>
                    @if($editItem)
                    <a href="{{ route('admin.cms.index') }}" class="text-xs text-slate-500 hover:text-slate-800 underline">Cancel</a>
                    @endif
                </div>

                <form action="{{ $editItem ? route('admin.cms.update', $editItem->id) : route('admin.cms.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @if($editItem)
                        @method('PUT')
                    @endif

                    <div>
                        <label for="page" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Page Slug <span class="text-rose-500">*</span></label>
                        <input type="text" id="page" name="page" required
                            value="{{ old('page', $editItem->page ?? '') }}"
                            placeholder="e.g. home, about, books, contact"
                            class="mt-1.5 block w-full rounded-lg border @error('page') border-rose-300 ring-rose-300 @else border-slate-300 @enderror px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        <p class="mt-1 text-[11px] text-slate-400">Target page location where this section will live.</p>
                        @error('page')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Section Type / Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="type" name="type" required
                            value="{{ old('type', $editItem->type ?? '') }}"
                            placeholder="e.g. hero_section, author_bio, reviews"
                            class="mt-1.5 block w-full rounded-lg border @error('type') border-rose-300 ring-rose-300 @else border-slate-300 @enderror px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        <p class="mt-1 text-[11px] text-slate-400">Converted automatically into a snake_case identifier.</p>
                        @error('type')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa {{ $editItem ? 'fa-arrows-rotate' : 'fa-plus' }}"></i>
                        <span>{{ $editItem ? 'Update Section' : 'Create Section' }}</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <div>
                        <h3 class="font-semibold text-slate-800">Registered Sections</h3>
                        <p class="text-xs text-slate-400">All registered blocks available in the database.</p>
                    </div>
                    <span class="rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">{{ $cmsList->count() }} Total</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-400">
                            <tr>
                                <th class="py-3 px-6">#</th>
                                <th class="py-3 px-6">Page</th>
                                <th class="py-3 px-6">Section Type</th>
                                <th class="py-3 px-6">Metas</th>
                                <th class="py-3 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($cmsList as $item)
                            <tr class="hover:bg-slate-50/75 transition-colors {{ $editItem && $editItem->id === $item->id ? 'bg-brand-50/50' : '' }}">
                                <td class="py-3.5 px-6 font-mono text-xs text-slate-400">{{ $loop->iteration }}</td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ $item->page }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-xs font-semibold text-slate-900">
                                    {{ $item->type }}
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-medium {{ $item->meta_count > 0 ? 'bg-sky-50 text-brand-600' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $item->meta_count }} keys
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.cms.index', ['edit' => $item->id]) }}"
                                            class="rounded p-1.5 text-slate-500 hover:bg-slate-100 hover:text-brand-600 transition-colors" title="Edit">
                                            <i class="fa fa-pen text-xs"></i>
                                        </a>

                                        <form action="{{ route('admin.cms.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all meta values under this section.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded p-1.5 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-colors" title="Delete">
                                                <i class="fa fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-xs text-slate-400">
                                    No page sections defined yet. Use the form to add your first section.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
