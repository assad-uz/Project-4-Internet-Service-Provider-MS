@extends('layouts.app')

@section('title', 'Add New Customer')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Add New Customer</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email (Optional)</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="area_id" class="form-label">Area <span class="text-danger">*</span></label>
                    <select class="form-select" id="area_id" name="area_id" required>
                        <option value="" disabled selected>Select Area</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="customer_type_id" class="form-label">Customer Type <span class="text-danger">*</span></label>
                    <select class="form-select" id="customer_type_id" name="customer_type_id" required>
                        <option value="" disabled selected>Select Type</option>
                        @foreach($customerTypes as $type)
                            <option value="{{ $type->id }}" {{ old('customer_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 mb-3">
                    <label for="address" class="form-label">Full Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Save Customer</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection