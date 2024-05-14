<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'subject',
        'customer_id',
        'product_id',
        'product_name',
        'quantity',
        'per_unit_price',
        'sell_price',
        'vat',
        'tax',
        'total_amount',
        // 'roundedTotal',
        'in_words',
        'warranty',
        'total_in_words',
        'is_paid',
        'payment_method',
        'reference',
        'invoice_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
