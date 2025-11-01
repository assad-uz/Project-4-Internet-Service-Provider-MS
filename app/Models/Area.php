<?php

namespace App\Models;

use App\Models\DistributionBox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    /**
     * একটি Area-তে একাধিক Distribution Box থাকতে পারে।
     */
    public function distributionBoxes(): HasMany
    {
        // 💡 একটি Area-তে একাধিক DistributionBox থাকতে পারে (hasMany)
        return $this->hasMany(DistributionBox::class);
    }
}
