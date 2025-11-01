<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    // 1. INDEX: সমস্ত কাস্টমার দেখানোর জন্য
    public function index()
    {
        // Eager Loading: area এবং customerType রিলেশনশিপ লোড করা হচ্ছে
        $customers = Customer::with(['area', 'customerType'])
                             ->orderBy('id', 'desc')
                             ->paginate(10); 
                             
        return view('pages.admin.customers.index', compact('customers'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        $areas = Area::orderBy('name')->get(); 
        $customerTypes = CustomerType::orderBy('name')->get();
        // status-এর জন্য ENUM ভ্যালু
        $statuses = ['active', 'inactive', 'suspended'];
        
        return view('pages.admin.customers.create', compact('areas', 'customerTypes', 'statuses'));
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'nullable|email|max:100|unique:customers,email',
            'address' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'customer_type_id' => 'required|exists:customer_types,id',
            // Rule::in() ব্যবহার করে নিশ্চিত করা হচ্ছে যে স্ট্যাটাস ENUM-এর মধ্যে আছে
            'status' => ['required', Rule::in(['active', 'inactive', 'suspended'])],
        ]);
        
        Customer::create($validated);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(Customer $customer)
    {
        $areas = Area::orderBy('name')->get(); 
        $customerTypes = CustomerType::orderBy('name')->get();
        $statuses = ['active', 'inactive', 'suspended'];
        
        return view('pages.admin.customers.edit', compact('customer', 'areas', 'customerTypes', 'statuses'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            // ফোন এবং ইমেইল uniqueness চেক করা হচ্ছে, বর্তমান কাস্টমারকে বাদ দিয়ে
            'phone' => 'required|string|max:20|unique:customers,phone,' . $customer->id,
            'email' => 'nullable|email|max:100|unique:customers,email,' . $customer->id,
            'address' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'customer_type_id' => 'required|exists:customer_types,id',
            'status' => ['required', Rule::in(['active', 'inactive', 'suspended'])],
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(Customer $customer)
    {
        // 💡 যদি ভবিষ্যতে Customer-এর সাথে Connection বা Billing-এর সম্পর্ক থাকে, তবে এখানে চেক করতে হবে।
        $customer->delete();
        
        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}