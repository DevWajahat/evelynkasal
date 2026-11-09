@extends('layouts.admin.app', ['title' => 'Read Message'])

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Message Details</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.inbox.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
                <i class="fa fa-arrow-left"></i>
                <span>Back to Inbox</span>
            </a>
            <form action="{{ route('admin.inbox.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-rose-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-rose-500 transition-colors">
                    <i class="fa fa-trash"></i>
                    <span>Delete</span>
                </button>
            </form>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        <!-- Header Info -->
        <div class="border-b border-slate-100 bg-slate-50/50 p-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-100 text-brand-700 font-bold text-lg">
                    {{ substr($contact->first_name, 0, 1) }}{{ substr($contact->last_name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">{{ $contact->first_name }} {{ $contact->last_name }}</h3>
                    <a href="mailto:{{ $contact->email }}" class="text-sm text-brand-600 hover:underline">{{ $contact->email }}</a>
                </div>
            </div>
            <div class="text-right text-xs text-slate-500">
                <p class="font-medium">{{ $contact->created_at->format('l, F j, Y') }}</p>
                <p>{{ $contact->created_at->format('h:i A') }} ({{ $contact->created_at->diffForHumans() }})</p>
            </div>
        </div>

        <!-- Subject & Body -->
        <div class="p-6 md:p-8 space-y-6">
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Subject</h4>
                <p class="text-lg font-bold text-slate-800">{{ $contact->subject }}</p>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3">Message</h4>
                <div class="prose prose-sm max-w-none text-slate-700 whitespace-pre-wrap leading-relaxed">
                    {{ $contact->message }}
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="border-t border-slate-100 bg-slate-50 p-4 flex gap-3">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject) }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                <i class="fa fa-reply"></i>
                <span>Reply via Email</span>
            </a>
        </div>
    </div>
</div>
@endsection
