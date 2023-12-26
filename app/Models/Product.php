<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function makeSlug()
    {
        return Str::slug($this->name);
    }
}
