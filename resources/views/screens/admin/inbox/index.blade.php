@extends('layouts.admin.app', ['title' => 'Contact Inbox'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Inbox Messages</h2>
            <p class="text-xs text-slate-500">View and manage reader inquiries and contact form submissions.</p>
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

    <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-400">
                    <tr>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6">Sender</th>
                        <th class="py-3 px-6">Subject</th>
                        <th class="py-3 px-6">Date</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50/75 transition-colors {{ !$msg->is_read ? 'bg-brand-50/30' : '' }}">
                        <td class="py-4 px-6">
                            @if($msg->is_read)
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-[10px] font-medium text-slate-600 uppercase tracking-wider">Read</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-brand-100 px-2.5 py-0.5 text-[10px] font-medium text-brand-700 uppercase tracking-wider">New</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-semibold text-slate-900">{{ $msg->first_name }} {{ $msg->last_name }}</div>
                            <div class="text-xs text-slate-500">{{ $msg->email }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-800">{{ Str::limit($msg->subject, 40) }}</div>
                            <div class="text-xs text-slate-500 truncate max-w-xs">{{ $msg->message }}</div>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500">
                            {{ $msg->created_at->format('M d, Y') }}<br>
                            <span class="text-[10px]">{{ $msg->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.inbox.show', $msg->id) }}" class="rounded-md bg-white border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                                    View
                                </a>
                                <form action="{{ route('admin.inbox.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md bg-white border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-regular fa-envelope-open text-4xl mb-3 text-slate-300"></i>
                                <p>Your inbox is currently empty.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
        <div class="border-t border-slate-200 px-6 py-4 bg-slate-50">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
