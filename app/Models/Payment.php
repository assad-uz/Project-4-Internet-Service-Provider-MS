<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'billing_id',
        'customer_id',
        'collected_by',
        'payment_method',
        'transaction_id',
        'amount',
        'payment_date',
    ];
    
    // Payment belongs to a Billing record
    public function billing(): BelongsTo
    {
        return $this->belongsTo(Billing::class);
    }

    // Payment belongs to a Customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Payment is collected by a User (assuming 'users' table is for employees/collectors)
    public function collector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'collected_by');
    }
}