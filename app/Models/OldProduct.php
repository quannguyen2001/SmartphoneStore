<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldProduct extends Model
{
    use HasFactory;
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }
}
