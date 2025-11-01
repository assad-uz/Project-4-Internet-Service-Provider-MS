<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BillingController extends Controller
{
    // 1. INDEX: সমস্ত বিল দেখানোর জন্য
    public function index()
    {
        $billings = Billing::with(['customer', 'connection', 'package'])
                             ->orderBy('billing_month', 'desc')
                             ->paginate(10); 
                             
        return view('pages.admin.billings.index', compact('billings'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        // কানেকশনগুলি লোড করা হচ্ছে যাতে বিল তৈরি করার সময় কানেকশন সিলেক্ট করা যায়
        $connections = Connection::with('customer')->orderBy('id', 'desc')->get(); 
        $statuses = ['unpaid', 'paid', 'partially_paid', 'cancelled'];
        
        return view('pages.admin.billings.create', compact('connections', 'statuses'));
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        // 💡 Validation: কানেকশন আইডি ও মাস ইউনিক হতে হবে
        $validated = $request->validate([
            'connection_id' => 'required|exists:connections,id',
            'billing_month' => [
                'required', 
                'date_format:Y-m-d',
                Rule::unique('billings')->where(function ($query) use ($request) {
                    return $query->where('connection_id', $request->connection_id)
                                 ->where('billing_month', $request->billing_month);
                }),
            ],
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'status' => ['required', Rule::in(['unpaid', 'paid', 'partially_paid', 'cancelled'])],
        ]);
        
        // 💡 কাস্টমার আইডি এবং প্যাকেজ আইডি কানেকশন থেকে স্বয়ংক্রিয়ভাবে যুক্ত করা
        $connection = Connection::with('package')->findOrFail($validated['connection_id']);
        
        $validated['customer_id'] = $connection->customer_id;
        $validated['package_id'] = $connection->package_id;
        
        Billing::create($validated);

        return redirect()->route('billings.index')
                         ->with('success', 'Billing record created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(Billing $billing)
    {
        $connections = Connection::with('customer')->orderBy('id', 'desc')->get(); 
        $statuses = ['unpaid', 'paid', 'partially_paid', 'cancelled'];
        
        return view('pages.admin.billings.edit', compact('billing', 'connections', 'statuses'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, Billing $billing)
    {
        // 💡 Validation: ইউনিকনেস চেক করার সময় বর্তমান বিলিং আইডি বাদ দেওয়া
        $validated = $request->validate([
            'connection_id' => 'required|exists:connections,id',
            'billing_month' => [
                'required', 
                'date_format:Y-m-d',
                Rule::unique('billings')->ignore($billing->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('connection_id', $request->connection_id)
                                     ->where('billing_month', $request->billing_month);
                    }),
            ],
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'status' => ['required', Rule::in(['unpaid', 'paid', 'partially_paid', 'cancelled'])],
        ]);
        
        // কানেকশন পরিবর্তন হলে নতুন কাস্টমার ও প্যাকেজ আইডি আপডেট করা
        if ($billing->connection_id != $validated['connection_id']) {
            $connection = Connection::with('package')->findOrFail($validated['connection_id']);
            $validated['customer_id'] = $connection->customer_id;
            $validated['package_id'] = $connection->package_id;
        }

        $billing->update($validated);

        return redirect()->route('billings.index')
                         ->with('success', 'Billing record updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(Billing $billing)
    {
        // বিল ডিলিট করার আগে এর সাথে কোনো পেমেন্ট রেকর্ড যুক্ত আছে কিনা, তা চেক করতে হতে পারে। 
        // পেমেন্ট মডিউল তৈরি না হওয়া পর্যন্ত আপাতত সরাসরি ডিলিট করা হচ্ছে।
        $billing->delete();
        
        return redirect()->route('billings.index')
                         ->with('success', 'Billing record deleted successfully.');
    }
}