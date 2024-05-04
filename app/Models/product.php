<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'vendor_id',
        'purchase_price',
        'stock',
        'vat',
        'tax',
        'warranty',
        'vendor_invoice_no'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
