<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOldProduct extends Model
{
    use HasFactory;
    public function old_product()
    {
        return $this->belongsTo(OldProduct::class,'old_product_id');
    }
}
