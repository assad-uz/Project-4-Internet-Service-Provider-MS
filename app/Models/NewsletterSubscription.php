<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscription extends Model
{
    use HasFactory;

    protected $table = 'newsletter_subscriptions'; 

    protected $fillable = [
        'email',
        'is_confirmed', 
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
    ];
}