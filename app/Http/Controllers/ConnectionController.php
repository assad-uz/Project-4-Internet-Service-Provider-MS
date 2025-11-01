<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Customer;
use App\Models\Package;
use App\Models\DistributionBox;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConnectionController extends Controller
{
    // 1. INDEX: সমস্ত সংযোগ দেখানোর জন্য
    public function index()
    {
        $connections = Connection::with(['customer', 'package', 'distributionBox'])
                             ->orderBy('id', 'desc')
                             ->paginate(10); 
                             
        return view('pages.admin.connections.index', compact('connections'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        $customers = Customer::orderBy('name')->get(); 
        $packages = Package::orderBy('package_name')->get(); 
        $boxes = DistributionBox::orderBy('box_code')->get(); 
        
        $connectionTypes = ['Optical Fiber', 'CAT-5', 'UTP'];
        $statuses = ['active', 'suspended', 'terminated'];
        
        return view('pages.admin.connections.create', compact('customers', 'packages', 'boxes', 'connectionTypes', 'statuses'));
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id|unique:connections,customer_id', // একজন কাস্টমারের একটিই সংযোগ
            'package_id' => 'required|exists:packages,id',
            'distribution_box_id' => 'required|exists:distribution_boxes,id',
            'username' => 'required|string|max:100|unique:connections,username',
            'password' => 'required|string|min:6|max:255',
            'ip_address' => 'nullable|ipv4',
            'mac_address' => 'nullable|max:20',
            'box_port_number' => 'nullable|integer|min:1|max:65535',
            'connection_type' => ['required', Rule::in(['Optical Fiber', 'CAT-5', 'UTP'])],
            'connection_date' => 'required|date',
            'status' => ['required', Rule::in(['active', 'suspended', 'terminated'])],
        ]);
        
        Connection::create($validated);

        return redirect()->route('connections.index')
                         ->with('success', 'Connection created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(Connection $connection)
    {
        $customers = Customer::orderBy('name')->get(); 
        $packages = Package::orderBy('package_name')->get(); 
        $boxes = DistributionBox::orderBy('box_code')->get(); 
        
        $connectionTypes = ['Optical Fiber', 'CAT-5', 'UTP'];
        $statuses = ['active', 'suspended', 'terminated'];
        
        return view('pages.admin.connections.edit', compact('connection', 'customers', 'packages', 'boxes', 'connectionTypes', 'statuses'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, Connection $connection)
    {
        $validated = $request->validate([
            // customer_id uniqueness চেক করা হচ্ছে, বর্তমান সংযোগকে বাদ দিয়ে
            'customer_id' => 'required|exists:customers,id|unique:connections,customer_id,' . $connection->id, 
            'package_id' => 'required|exists:packages,id',
            'distribution_box_id' => 'required|exists:distribution_boxes,id',
            // username uniqueness চেক করা হচ্ছে, বর্তমান সংযোগকে বাদ দিয়ে
            'username' => 'required|string|max:100|unique:connections,username,' . $connection->id,
            'password' => 'nullable|string|min:6|max:255', // আপডেটের সময় পাসওয়ার্ড ঐচ্ছিক
            'ip_address' => 'nullable|ipv4',
            'mac_address' => 'nullable|max:20',
            'box_port_number' => 'nullable|integer|min:1|max:65535',
            'connection_type' => ['required', Rule::in(['Optical Fiber', 'CAT-5', 'UTP'])],
            'connection_date' => 'required|date',
            'status' => ['required', Rule::in(['active', 'suspended', 'terminated'])],
        ]);
        
        // পাসওয়ার্ড খালি থাকলে, আগের পাসওয়ার্ডটি রাখা হচ্ছে
        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        
        $connection->update($validated);

        return redirect()->route('connections.index')
                         ->with('success', 'Connection updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(Connection $connection)
    {
        // ডিলিট করার আগে বিলিং বা অন্য কোনো নির্ভরশীলতা চেক করতে হতে পারে।
        $connection->delete();
        
        return redirect()->route('connections.index')
                         ->with('success', 'Connection deleted successfully.');
    }
}