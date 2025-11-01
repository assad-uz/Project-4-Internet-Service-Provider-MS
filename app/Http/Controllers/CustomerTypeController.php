<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    // 1. INDEX: সমস্ত কাস্টমার টাইপ দেখানোর জন্য
    public function index()
    {
        $customerTypes = CustomerType::orderBy('id', 'desc')->paginate(10); 
        return view('pages.admin.customer_types.index', compact('customerTypes'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        return view('pages.admin.customer_types.create');
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:customer_types,name',
        ]);
        
        CustomerType::create($validated);

        return redirect()->route('customer_types.index')
                         ->with('success', 'Customer Type created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(CustomerType $customerType)
    {
        return view('pages.admin.customer_types.edit', compact('customerType'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, CustomerType $customerType)
    {
        $validated = $request->validate([
            // বর্তমান row-টিকে বাদ দিয়ে uniqueness চেক করা হচ্ছে
            'name' => 'required|string|max:50|unique:customer_types,name,' . $customerType->id,
        ]);

        $customerType->update($validated);

        return redirect()->route('customer_types.index')
                         ->with('success', 'Customer Type updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(CustomerType $customerType)
    {
        $customerType->delete();
        
        return redirect()->route('customer_types.index')
                         ->with('success', 'Customer Type deleted successfully.');
    }
}