@extends('dashboard.layouts.app')

@section('title', 'Devotionals')
@section('page-title', 'Devotionals Management')

@section('content')
<div class="mb-6 flex flex-wrap gap-4 justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">Daily Devotionals</h3>
    <a href="{{ route('dashboard.devotionals.create') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Devotional
    </a>
</div>

{{-- Push status --}}
@if($pushReady)
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800 flex gap-3 items-start">
        <i class="fas fa-bell mt-0.5"></i>
        <div>
            <b>Morning notifications are on.</b> Each published devotional is sent to everyone with the app
            from {{ $notifyFrom }} (Ghana time) on its day. Use <i>Send now</i> to send one straight away.
        </div>
    </div>
@else
    <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 px-5 py-4 text-sm text-amber-900 flex gap-3 items-start">
        <i class="fas fa-bell-slash mt-0.5"></i>
        <div>
            <b>Push notifications are not set up yet.</b> In the Firebase console open Project settings &rsaquo; Service accounts,
            choose <i>Generate new private key</i>, and save the file on the server as
            <code class="bg-white px-1 rounded">storage/app/firebase/service-account.json</code>. Devotionals still appear in the app without it.
        </div>
    </div>
@endif

{{-- This week --}}
<div class="mb-8">
    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Next 7 days</h4>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
        @foreach($upcoming as $day)
            @php $d = $day['devotional']; $isToday = $day['date']->toDateString() === $todayDate; @endphp
            <div class="rounded-lg border p-3 bg-white {{ $isToday ? 'border-primary-400 ring-2 ring-primary-100' : 'border-gray-200' }}">
                <div class="text-xs font-semibold {{ $isToday ? 'text-primary-600' : 'text-gray-500' }}">
                    {{ $isToday ? 'Today' : $day['date']->format('D') }} · {{ $day['date']->format('M j') }}
                </div>
                @if($d)
                    <a href="{{ route('dashboard.devotionals.edit', $d) }}" class="block mt-1 text-sm font-semibold text-gray-900 hover:text-primary-600 line-clamp-2">{{ $d->title }}</a>
                    <div class="mt-2 flex flex-wrap gap-1 text-[11px]">
                        <span class="px-2 py-0.5 rounded-full {{ $d->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ $d->published ? 'Published' : 'Draft' }}</span>
                        @if($d->notified_at)
                            <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700"><i class="fas fa-check"></i> Sent</span>
                        @elseif(! $d->notify)
                            <span class="px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">No push</span>
                        @endif
                    </div>
                @else
                    <div class="mt-1 text-sm text-red-600">Nothing yet</div>
                    <a href="{{ route('dashboard.devotionals.create', ['date' => $day['date']->toDateString()]) }}" class="mt-2 inline-block text-xs font-semibold text-primary-600 hover:underline">+ Add</a>
                @endif
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Scripture</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Completed</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Notification</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($devotionals as $devotional)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $devotional->publish_date->format('D, M d, Y') }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $devotional->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $devotional->scripture_reference }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $devotional->completions_count }}</td>
                <td class="px-6 py-4">
                    <form action="{{ route('dashboard.devotionals.toggle-publish', $devotional) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium {{ $devotional->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $devotional->published ? '✓ Published' : '○ Draft' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-sm whitespace-nowrap">
                    @php $day = $devotional->publish_date->toDateString(); @endphp
                    @if($devotional->notified_at)
                        <span class="text-blue-700"><i class="fas fa-check-circle"></i> Sent {{ $devotional->notified_at->timezone(config('devotion.timezone'))->format('M j, g:ia') }}</span>
                    @elseif(! $devotional->notify)
                        <span class="text-gray-400">Off</span>
                    @elseif($day > $todayDate)
                        <span class="text-gray-600"><i class="far fa-clock"></i> {{ $notifyFrom }} on the day</span>
                    @elseif($day < $todayDate)
                        <span class="text-gray-400">Not sent</span>
                    @else
                        <span class="text-amber-700"><i class="far fa-clock"></i> Due this morning</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center items-center gap-3">
                        @if($devotional->published && $pushReady)
                            <form action="{{ route('dashboard.devotionals.notify', $devotional) }}" method="POST"
                                  onsubmit="return confirm('Send this devotional as a notification to everyone with the app now?');">
                                @csrf
                                <button type="submit" class="text-primary-600 hover:text-primary-800 text-xs font-semibold whitespace-nowrap" title="Send notification now">
                                    <i class="fas fa-paper-plane"></i> {{ $devotional->notified_at ? 'Send again' : 'Send now' }}
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('dashboard.devotionals.edit', $devotional) }}" class="text-blue-600 hover:text-blue-900" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('dashboard.devotionals.destroy', $devotional) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    No devotionals yet. <a href="{{ route('dashboard.devotionals.create') }}" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $devotionals->links() }}</div>
@endsection
