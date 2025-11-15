<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; // Added Log Facade

class NewsletterController extends Controller
{
    /**
     * Handles the subscription request from the front-end form.
     */
    public function subscribe(Request $request)
    {
        // 1. Validation: email must be required, valid, max 100 chars, and unique in DB.
        $validated = $request->validate([
            'email' => [
                'required', 
                'email', 
                'max:100',
                // Checks if the email already exists in the 'newsletter_subscriptions' table.
                Rule::unique('newsletter_subscriptions', 'email')
            ],
        ], [
            // Custom Bengali error messages
            'email.unique' => 'এই ইমেইলটি ইতোমধ্যে সাবস্ক্রাইব করা হয়েছে।',
            'email.required' => 'ইমেইল অ্যাড্রেস দেওয়া আবশ্যক।',
        ]);

        try {
            // 2. Save the data to the database
            NewsletterSubscription::create([
                'email' => $validated['email'],
                // is_confirmed defaults to TRUE as per your schema
            ]);

            // 3. Redirect back with a success message
            return back()->with('success', 'সাবস্ক্রিপশন সফল হয়েছে! সর্বশেষ আপডেট আপনার ইনবক্সে পাঠানো হবে।');

        } catch (\Exception $e) {
            // Error handling: log the error and return a generic message
            Log::error("Newsletter Subscription Failed: " . $e->getMessage()); 
            return back()->with('error', 'সাবস্ক্রিপশন ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
        }
    }

    /**
     * Display a list of all newsletter subscriptions in the admin panel.
     */
    public function index()
    {
        // Load all subscriptions, ordered by latest first.
        $subscriptions = NewsletterSubscription::orderBy('created_at', 'desc')->get();

        // Pass data to the admin view
        return view('admin.newsletter.index', compact('subscriptions'));
    }
}