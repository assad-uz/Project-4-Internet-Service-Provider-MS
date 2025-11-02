<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Connection;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Package;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // 💡 আপনার রাউট অনুযায়ী মেথডের নাম 'index' করা হলো
    public function index() 
    {
        // চলতি মাস নির্ধারণ
        $currentMonth = Carbon::now()->startOfMonth();
        
        // ১. মোট ব্যবহারকারী (Customer)
        $totalCustomers = Customer::count();
        
        // ২. সক্রিয় ও নিষ্ক্রিয় ব্যবহারকারী (ধরে নিচ্ছি Customer মডেলে 'status' আছে)
        $activeCustomers = Customer::where('status', 'active')->count();
        $inactiveCustomers = Customer::where('status', 'inactive')->count();
        
        // ৩. বকেয়া বিলের সংখ্যা
        $totalDueBillingsCount = Billing::whereIn('status', ['unpaid', 'partially_paid'])->count();
        
        // ৪. প্যাকেজ অনুযায়ী ব্যবহারকারী
        $packageCounts = Connection::select('package_id', DB::raw('count(*) as total'))
                                   ->groupBy('package_id')
                                   ->with('package') 
                                   ->get();
                                   
        // ৫. পেন্ডিং সাপোর্ট টিকিট
        // $pendingTickets = Ticket::where('status', 'pending')->count(); 
        $pendingTickets = 8;
        
        // ৬. মোট সংগৃহীত অর্থ (চলতি মাসে)
        $totalSalesAmount = Payment::where('payment_date', '>=', $currentMonth)
                                   ->sum('amount');

        // ভিউতে ডেটা পাঠানো
        return view('pages.admin.dashboard', [
            'totalCustomers' => $totalCustomers,
            'activeCustomers' => $activeCustomers,
            'inactiveCustomers' => $inactiveCustomers,
            'pendingTickets' => $pendingTickets,
            'packageCounts' => $packageCounts,
            'totalDueBillingsCount' => $totalDueBillingsCount,
            'totalSalesAmount' => $totalSalesAmount,
        ]);
    }
}