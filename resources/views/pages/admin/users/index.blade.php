@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">User Management</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Create New User
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 15%">Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 20%">Address</th>
                <th style="width: 15%">Phone</th>
                <th style="width: 15%">Created At</th>
                <th style="width: 10%">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address ?? 'N/A' }}</td>
                <td>{{ $user->phone ?? 'N/A' }}</td>
                <td>{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                          class="d-inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($users->isEmpty())
            <tr>
                <td colspan="7" class="text-center text-muted">No users found.</td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }}
    </div>

</div>
@endsection
