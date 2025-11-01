@extends('layouts.app')

@section('title', 'Create Distribution Box')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Create New Distribution Box</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('distribution_boxes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="box_code" class="form-label">Box Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="box_code" name="box_code" value="{{ old('box_code') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Name (Optional)</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="area_id" class="form-label">Area <span class="text-danger">*</span></label>
                <select class="form-select" id="area_id" name="area_id" required>
                    <option value="" disabled selected>Select an Area</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('distribution_boxes.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Save Box</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection