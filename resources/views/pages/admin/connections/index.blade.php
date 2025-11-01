@extends('layouts.app')

@section('title', 'Connections List')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Connection Management</h3>
        <a href="{{ route('connections.create') }}" class="btn btn-primary">
            + Add New Connection
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 20%">Customer (Phone)</th>
                <th style="width: 15%">Username</th>
                <th style="width: 15%">Package</th>
                <th style="width: 15%">Box/Port</th>
                <th style="width: 10%">Type/Date</th>
                <th style="width: 8%">Status</th>
                <th style="width: 12%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($connections as $connection)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <strong>{{ $connection->customer->name ?? 'N/A' }}</strong><br>
                    <small class="text-muted">{{ $connection->customer->phone ?? '' }}</small>
                </td>
                <td>{{ $connection->username }}</td>
                <td>{{ $connection->package->name ?? 'N/A' }}</td>
                <td>
                    {{ $connection->distributionBox->box_code ?? 'N/A' }} / 
                    {{ $connection->box_port_number ?? 'N/A' }}
                </td>
                <td>
                    <span class="badge bg-secondary">{{ $connection->connection_type }}</span><br>
                    <small>{{ $connection->connection_date }}</small>
                </td>
                <td class="text-center">
                    @php
                        $statusClass = [
                            'active' => 'success',
                            'suspended' => 'warning',
                            'terminated' => 'danger'
                        ][$connection->status] ?? 'dark';
                    @endphp
                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($connection->status) }}</span>
                </td>
                <td class="text-center">
                    <a href="{{ route('connections.edit', $connection->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('connections.destroy', $connection->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this connection?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($connections->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">No connections found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $connections->links() }}
    </div>
</div>
@endsection