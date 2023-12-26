<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    public function makeSlugBrand()
    {
        return Str::slug($this->title);
    }
}
