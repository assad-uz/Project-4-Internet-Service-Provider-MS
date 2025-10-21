<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = [
            [
                'name' => 'Bronze Pack',
                'price' => '499', // monthly ৳
                'speed' => '10 Mbps',
                'features' => [
                    'Unlimited browsing (fair usage)',
                    '24/7 support',
                    'Free router (on signup)'
                ],
                'badge' => 'Popular',
                'color' => 'secondary'
            ],
            [
                'name' => 'Silver Pack',
                'price' => '799',
                'speed' => '25 Mbps',
                'features' => [
                    'Unlimited browsing',
                    'Priority support',
                    'Free static IP (optional)'
                ],
                'badge' => 'Best Value',
                'color' => 'primary'
            ],
            [
                'name' => 'Gold Pack',
                'price' => '1299',
                'speed' => '50 Mbps',
                'features' => [
                    'High speed streaming',
                    'Dedicated bandwidth',
                    'Free installation'
                ],
                'badge' => 'Recommended',
                'color' => 'warning'
            ],
            [
                'name' => 'Platinum Pack',
                'price' => '2499',
                'speed' => '100 Mbps',
                'features' => [
                    'Top-tier speed & priority',
                    'SLA & dedicated support',
                    'Free router + installation'
                ],
                'badge' => 'Premium',
                'color' => 'dark'
            ],
        ];

        // আপনি চাইলে ডেটাবেস থেকে নিতেও পারেন; এখন ডেমো ডেটা পাঠাচ্ছি
        return view('pages.portal.home', compact('packages'));
    }
}
