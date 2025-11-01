<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerType extends Model
{
   use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function customers(): HasMany
{
    return $this->hasMany(Customer::class);
}
}
