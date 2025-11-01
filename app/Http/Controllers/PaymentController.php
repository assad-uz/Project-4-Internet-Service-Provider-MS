<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Billing; // Billing মডেল ইমপোর্ট করা
use App\Models\User;     // User মডেল ইমপোর্ট করা (Collector হিসেবে)
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // ট্রানজেকশনের জন্য

class PaymentController extends Controller
{
    // 1. INDEX: সমস্ত পেমেন্ট দেখানোর জন্য
    public function index()
    {
        $payments = Payment::with(['customer', 'billing', 'collector'])
                             ->orderBy('payment_date', 'desc')
                             ->paginate(10); 
                             
        return view('pages.admin.payments.index', compact('payments'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        // শুধুমাত্র 'unpaid' বা 'partially_paid' বিলগুলো লোড করা 
        $billings = Billing::with('customer')
                           ->whereIn('status', ['unpaid', 'partially_paid'])
                           ->orderBy('due_date', 'asc')
                           ->get();
                           
        // পেমেন্ট কালেকশনকারী ইউজারদের লোড করা (আপনার প্রয়োজন অনুযায়ী)
        $collectors = User::orderBy('name')->get(); 
        $paymentMethods = ['cash', 'bKash', 'card', 'bank'];
        
        return view('pages.admin.payments.create', compact('billings', 'collectors', 'paymentMethods'));
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_id' => 'required|exists:billings,id',
            'collected_by' => 'nullable|exists:users,id', // যিনি কালেক্ট করলেন
            'payment_method' => ['required', Rule::in(['cash', 'bKash', 'card', 'bank'])],
            'transaction_id' => 'nullable|string|max:100',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'nullable|date',
        ]);

        $billing = Billing::findOrFail($validated['billing_id']);

        // 💡 ট্রানজেকশন: পেমেন্ট এবং বিলিং স্ট্যাটাস একসাথে আপডেট করা
        DB::transaction(function () use ($validated, $billing) {
            // ১. কাস্টমার আইডি স্বয়ংক্রিয়ভাবে বিল থেকে নিয়ে আসা
            $validated['customer_id'] = $billing->customer_id;
            
            // যদি payment_date না থাকে, তাহলে বর্তমান সময় ব্যবহার করা
            if (!isset($validated['payment_date'])) {
                $validated['payment_date'] = now();
            }

            // ২. পেমেন্ট রেকর্ড তৈরি করা
            Payment::create($validated);

            // ৩. বিলিং স্ট্যাটাস আপডেট করা
            $totalPaid = $billing->payments()->sum('amount');
            $netAmount = $billing->amount - $billing->discount;

            if ($totalPaid >= $netAmount) {
                $billing->status = 'paid';
            } elseif ($totalPaid > 0) {
                $billing->status = 'partially_paid';
            } else {
                $billing->status = 'unpaid';
            }
            $billing->save();
        });

        return redirect()->route('payments.index')
                         ->with('success', 'Payment recorded successfully, and billing status updated.');
    }

    // 4. EDIT এবং UPDATE মেথডগুলো সাধারণত পেমেন্টের ক্ষেত্রে প্রয়োজন হয় না
    // কারণ একবার পেমেন্ট রেকর্ড হয়ে গেলে তা এডিট করার চেয়ে রিভার্স করা বা নতুন ট্রানজেকশন করা ভালো।
    // তবে CRUD সম্পূর্ণ করার জন্য আমি শুধু কাঠামোটি দিচ্ছি।

    public function edit(Payment $payment)
    {
        $billings = Billing::with('customer')->orderBy('due_date', 'asc')->get();
        $collectors = User::orderBy('name')->get(); 
        $paymentMethods = ['cash', 'bKash', 'card', 'bank'];
        
        return view('pages.admin.payments.edit', compact('payment', 'billings', 'collectors', 'paymentMethods'));
    }

    public function update(Request $request, Payment $payment)
    {
         $validated = $request->validate([
            'billing_id' => 'required|exists:billings,id',
            'collected_by' => 'nullable|exists:users,id',
            'payment_method' => ['required', Rule::in(['cash', 'bKash', 'card', 'bank'])],
            'transaction_id' => 'nullable|string|max:100',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'nullable|date',
        ]);

        $oldBillingId = $payment->billing_id;
        $newBillingId = $validated['billing_id'];
        
        // ট্রানজেকশন: পুরনো ও নতুন বিলের স্ট্যাটাস আপডেট করা
        DB::transaction(function () use ($validated, $payment, $oldBillingId, $newBillingId) {
            
            // ১. পেমেন্ট আপডেট করা
            $payment->update($validated);

            // ২. কাস্টমার আইডি আপডেট করা যদি বিলিং আইডি পরিবর্তন হয়
            if ($oldBillingId != $newBillingId) {
                $newBilling = Billing::findOrFail($newBillingId);
                $payment->customer_id = $newBilling->customer_id;
                $payment->save();
                
                // ৩. পুরনো বিলের স্ট্যাটাস আপডেট করা (যদি পরিবর্তন হয়)
                $this->updateBillingStatus($oldBillingId);
            }
            
            // ৪. নতুন/বর্তমান বিলের স্ট্যাটাস আপডেট করা
            $this->updateBillingStatus($newBillingId);
        });

        return redirect()->route('payments.index')->with('success', 'Payment record updated successfully.');
    }
    
    // 5. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(Payment $payment)
    {
        $billingId = $payment->billing_id;
        
        // ট্রানজেকশন: পেমেন্ট ডিলিট এবং বিলিং স্ট্যাটাস আপডেট
        DB::transaction(function () use ($payment, $billingId) {
            $payment->delete();
            $this->updateBillingStatus($billingId); // বিলের স্ট্যাটাস পুনরায় হিসাব করা
        });
        
        return redirect()->route('payments.index')
                         ->with('success', 'Payment deleted successfully, and billing status recalculated.');
    }

    /**
     * একটি ইউটিলিটি মেথড যা একটি বিলের বর্তমান পেমেন্টের ভিত্তিতে স্ট্যাটাস আপডেট করে।
     */
    protected function updateBillingStatus(int $billingId): void
    {
        $billing = Billing::findOrFail($billingId);
        $totalPaid = $billing->payments()->sum('amount');
        $netAmount = $billing->amount - $billing->discount;
        
        if ($totalPaid >= $netAmount) {
            $billing->status = 'paid';
        } elseif ($totalPaid > 0) {
            $billing->status = 'partially_paid';
        } else {
            $billing->status = 'unpaid';
        }
        $billing->save();
    }
}