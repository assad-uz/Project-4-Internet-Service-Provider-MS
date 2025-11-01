@extends('layouts.app')

@section('title', 'User List')
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
                <th style="width: 8%">Avatar</th> 
                <th style="width: 15%">Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Phone</th>
                <th style="width: 10%">Role</th> 
                <th style="width: 14%">Last Login</th> 
                <th style="width: 10%">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                
                <td class="text-center">
                    @if ($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }} Avatar" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
                
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                
                <td>{{ $user->phone ?? 'N/A' }}</td>
                
                <td><span class="badge {{ 
                    $user->role == 'admin' ? 'bg-danger' : 
                    ($user->role == 'manager' ? 'bg-warning text-dark' : 'bg-info') 
                }}">{{ ucfirst($user->role) }}</span></td>

                <td>
                    @if ($user->last_login_at)
                        {{ $user->last_login_at->diffForHumans() }} 
                        <small class="text-muted d-block">{{ $user->last_login_at->format('d M Y') }}</small>
                    @else
                        <span class="text-muted">Never</span>
                    @endif
                </td>
                
                <td class="text-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-icon btn-sm"><i class="bx bx-edit text-white"></i></a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-icon btn-sm"><i class="bx bx-trash text-white"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($users->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">No users found.</td>
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