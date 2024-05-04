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
        'quantity',
        // 'purchase_price',
        // 'vat',
        // 'tax',
        // 'total_amount',
        // 'in_words',
        // 'warranty'
    ];

}
