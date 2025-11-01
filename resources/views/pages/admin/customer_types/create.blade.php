@extends('layouts.app')

@section('title', 'Create Customer Type')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Create New Customer Type</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('customer_types.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Type Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('customer_types.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Save Type</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection