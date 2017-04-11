<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'customer_name',
        'quantity'
    ];

    protected $appends = [
        'total_price'
    ];

    public function offering()
    {
        return $this->belongsTo(Offering::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->offering->price;
    }
}
