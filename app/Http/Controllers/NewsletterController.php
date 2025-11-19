<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

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
                Rule::unique('newsletter_subscriptions', 'email')
            ],
        ], [
            // Custom English error messages
            'email.unique' => 'This email address is already subscribed.',
            'email.required' => 'The email address is required.',
        ]);

        try {
            // 2. Save the data to the database
            NewsletterSubscription::create([
                'email' => $validated['email'],
                // is_confirmed defaults to TRUE as per your schema
            ]);

            // 3. Redirect to the home page (using a safe GET route) with a success message
            return redirect()->route('home')->with('success', 'Subscription successful! The latest updates will be sent to your inbox.');

        } catch (\Exception $e) {
            // Error handling: log the error and return a generic message
            Log::error("Newsletter Subscription Failed: " . $e->getMessage()); 
            // 4. Redirect to the home page (using a safe GET route) with an error message
            return redirect()->route('home')->with('error', 'Subscription failed. Please try again later.');
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
        return view('pages.admin.newsletters.index', compact('subscriptions'));
    }

    public function destroy(NewsletterSubscription $subscription)
    {
        // Delete the subscription record
        $subscription->delete();

        // Redirect back to the list with a success message
        return redirect()->route('admin.newsletters.index')->with('success', 'Subscriber deleted successfully.');
    }
}