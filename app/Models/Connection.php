<?php

namespace App\Models;

use App\Models\Package;
use App\Models\Customer;
use App\Models\DistributionBox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Connection extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'package_id',
        'distribution_box_id',
        'username',
        'password',
        'ip_address',
        'mac_address',
        'box_port_number',
        'connection_type',
        'connection_date',
        'status',
    ];

    /**
     * সম্পর্ক: Connection belongs to a Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * সম্পর্ক: Connection belongs to a Package.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * সম্পর্ক: Connection belongs to a DistributionBox.
     */
    public function distributionBox(): BelongsTo
    {
        return $this->belongsTo(DistributionBox::class);
    }
}