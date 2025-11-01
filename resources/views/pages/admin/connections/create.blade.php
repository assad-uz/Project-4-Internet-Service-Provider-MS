@extends('layouts.app')

@section('title', 'Create Connection')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Create New Connection</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('connections.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                    <select class="form-select" id="customer_id" name="customer_id" required>
                        <option value="" disabled selected>Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} ({{ $customer->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="package_id" class="form-label">Package <span class="text-danger">*</span></label>
                    <select class="form-select" id="package_id" name="package_id" required>
                        <option value="" disabled selected>Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->package_name }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="distribution_box_id" class="form-label">Distribution Box <span class="text-danger">*</span></label>
                    <select class="form-select" id="distribution_box_id" name="distribution_box_id" required>
                        <option value="" disabled selected>Select Box</option>
                        @foreach($boxes as $box)
                            <option value="{{ $box->id }}" {{ old('distribution_box_id') == $box->id ? 'selected' : '' }}>
                                {{ $box->box_code }} ({{ $box->area->name ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="box_port_number" class="form-label">Box Port Number</label>
                    <input type="number" class="form-control" id="box_port_number" name="box_port_number" value="{{ old('box_port_number') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="connection_type" class="form-label">Connection Type <span class="text-danger">*</span></label>
                    <select class="form-select" id="connection_type" name="connection_type" required>
                        <option value="" disabled selected>Select Type</option>
                        @foreach($connectionTypes as $type)
                            <option value="{{ $type }}" {{ old('connection_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="connection_date" class="form-label">Connection Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="connection_date" name="connection_date" value="{{ old('connection_date', date('Y-m-d')) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="ip_address" class="form-label">IP Address (Optional)</label>
                    <input type="text" class="form-control" id="ip_address" name="ip_address" value="{{ old('ip_address') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="mac_address" class="form-label">MAC Address (Optional)</label>
                    <input type="text" class="form-control" id="mac_address" name="mac_address" value="{{ old('mac_address') }}">
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
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('connections.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Save Connection</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection