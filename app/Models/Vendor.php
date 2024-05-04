<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'product_type',
        'address',
        'phone'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
