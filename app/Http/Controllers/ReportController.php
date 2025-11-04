<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Connection;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Package;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // চলতি মাসের প্রথম দিন
        $startDate = Carbon::parse($request->input('from_date', Carbon::now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('to_date', Carbon::now()->endOfDay()));
        $packageId = $request->input('package_id');

        // ১. ফিল্টারের জন্য প্যাকেজ লোড করা
        $packages = Package::all();
        
        // ২. সামারি কার্ডের জন্য ডেটা (Dashboard Controller-এর মতো)
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('status', 'active')->count();
        
        // মোট বকেয়া বিলের সংখ্যা ও পরিমাণ
        $pendingBills = Billing::whereIn('status', ['unpaid', 'partially_paid'])
                               ->get();
        $totalPendingBillsCount = $pendingBills->count();
        $totalPendingAmount = $pendingBills->sum('due_amount'); // ধরে নিচ্ছি Billing মডেলে due_amount কলাম আছে
        
        // তারিখের রেঞ্জের মধ্যে মোট সেলস (পেমেন্ট)
        $totalSalesAmount = Payment::whereBetween('payment_date', [$startDate, $endDate])
                                   ->sum('amount');
        $totalTransactions = Payment::whereBetween('payment_date', [$startDate, $endDate])
                                    ->count();

        // ৩. রিপোর্ট টেবিলের জন্য ডেটা (Connections)
        $query = Connection::with('customer', 'package') // সম্পর্ক লোড করা
                           ->whereBetween('connection_date', [$startDate, $endDate]);

        if ($packageId) {
            $query->where('package_id', $packageId);
        }
        
        // কানেকশনগুলো লোড করা
        $connections = $query->orderBy('connection_date', 'desc')->get();
        
        // ভিউতে ডেটা পাঠানো
        return view('pages.admin.reports.report', [
            'packages' => $packages,
            'connections' => $connections,
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
            'selectedPackageId' => $packageId,
            
            // সামারি ডেটা
            'totalCustomers' => $totalCustomers,
            'activeCustomers' => $activeCustomers,
            'totalPendingBillsCount' => $totalPendingBillsCount,
            'totalPendingAmount' => $totalPendingAmount,
            'totalSalesAmount' => $totalSalesAmount,
            'totalTransactions' => $totalTransactions,
        ]);
    }
}