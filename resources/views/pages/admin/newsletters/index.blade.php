{{-- resources/views/admin/newsletter/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Newsletter Subscriptions')

@section('content')

<div class="container py-4">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Newsletter Subscriptions</h3>
            <small class="text-muted">Total Subscribers: {{ $subscriptions->count() }}</small>
        </div>
        <a href="#" class="btn btn-outline-success" title="Export all emails to CSV">Export CSV</a>
    </div>

    {{-- Subscription Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Email Address</th>
                            <th>Status</th>
                            <th>Subscribed On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>
                                <strong>{{ $subscription->email }}</strong>
                            </td>
                            <td>
                                @if($subscription->is_confirmed)
                                    <span class="badge bg-success">Confirmed</span>
                                @else
                                    <span class="badge bg-warning text-dark">Unconfirmed</span>
                                @endif
                            </td>
                            <td>{{ $subscription->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                {{-- Delete Button (Placeholder) --}}
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subscriber?')">
                                    {{-- @csrf 
                                    @method('DELETE') --}}
                                    <button type="submit" class="btn btn-sm btn-outline-danger" disabled>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                No newsletter subscribers found yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection