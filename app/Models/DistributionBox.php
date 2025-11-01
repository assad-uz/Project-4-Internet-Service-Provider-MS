<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributionBox extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'box_code',
        'name',
        'area_id',
    ];

    /**
     * একটি Distribution Box কোন Area-এর সাথে সম্পর্কিত।
     */
    public function area(): BelongsTo
    {
        // 💡 এই বক্সটি একটি Area-এর সাথে সম্পর্কিত (belongsTo)
        return $this->belongsTo(Area::class);
    }
}
