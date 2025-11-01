<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'connection_id',
        'package_id',
        'billing_month',
        'amount',
        'due_date',
        'discount',
        'status',
    ];

    /**
     * সম্পর্ক: Billing belongs to a Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * সম্পর্ক: Billing belongs to a Connection.
     */
    public function connection(): BelongsTo
    {
        return $this->belongsTo(Connection::class);
    }

    /**
     * সম্পর্ক: Billing belongs to a Package.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}