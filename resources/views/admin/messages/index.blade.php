@extends('admin.layout')

@section('title', 'Contact messages')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Private inbox</p>
            <h1>Contact messages</h1>
            <p class="muted" style="margin: 9px 0 0; font-size: 13px;">Customer messages are confidential. Handle them with care.</p>
        </div>
        <a class="button button-secondary" href="{{ route('contact') }}" target="_blank" rel="noopener">View contact page ↗</a>
    </div>

    <nav style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 17px;" aria-label="Filter messages by status">
        <a class="button {{ $statusFilter === null ? '' : 'button-secondary' }}" href="{{ route('admin.messages.index') }}">All</a>
        @foreach ($statuses as $status)
            <a class="button {{ $statusFilter === $status ? '' : 'button-secondary' }}" href="{{ route('admin.messages.index', ['status' => $status]) }}">{{ ucfirst($status) }}</a>
        @endforeach
    </nav>

    <section class="panel" style="overflow: hidden;" aria-label="Message list">
        @if ($messages->isEmpty())
            <div style="padding: 42px 24px; text-align: center;">
                <h2 style="margin-bottom: 8px;">No messages here yet</h2>
                <p class="muted" style="margin: 0; font-size: 13px;">New contact messages will appear in this inbox.</p>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; white-space: nowrap;">
                    <thead>
                        <tr style="background: #f8f9f4; color: #68756c; font-size: 10px; letter-spacing: .08em; text-transform: uppercase;">
                            <th style="padding: 14px 18px;">From</th>
                            <th style="padding: 14px 18px;">Message</th>
                            <th style="padding: 14px 18px;">Received</th>
                            <th style="padding: 14px 18px;">Status</th>
                            <th style="padding: 14px 18px;"><span class="sr-only">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr style="border-top: 1px solid rgb(49 89 71 / 10%); font-size: 12px;">
                                <td style="padding: 16px 18px;">
                                    <strong style="display: block; margin-bottom: 5px;">{{ $message->name }}</strong>
                                    <a class="muted" href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                </td>
                                <td style="max-width: 340px; overflow: hidden; padding: 16px 18px; text-overflow: ellipsis;">{{ $message->message }}</td>
                                <td class="muted" style="padding: 16px 18px;">{{ $message->created_at->format('M j, Y · g:i a') }}</td>
                                <td style="padding: 16px 18px;"><span class="status status-{{ $message->status }}">{{ $message->status }}</span></td>
                                <td style="padding: 16px 18px;"><a href="{{ route('admin.messages.show', $message) }}" style="color: #315947; font-weight: 600;">Open →</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="display: flex; justify-content: space-between; gap: 12px; padding: 15px 18px; border-top: 1px solid rgb(49 89 71 / 10%); font-size: 12px;">
                @if ($messages->onFirstPage())
                    <span class="muted">← Previous</span>
                @else
                    <a href="{{ $messages->previousPageUrl() }}">← Previous</a>
                @endif
                <span class="muted">Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }}</span>
                @if ($messages->hasMorePages())
                    <a href="{{ $messages->nextPageUrl() }}">Next →</a>
                @else
                    <span class="muted">Next →</span>
                @endif
            </div>
        @endif
    </section>
@endsection
