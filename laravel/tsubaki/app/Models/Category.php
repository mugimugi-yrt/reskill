<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function products() {
        return $this->hasMany(Product::class);
    }
}
