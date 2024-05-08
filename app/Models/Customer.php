<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'customer_address',
        'company_name',
        'company_address',
        'mobile',
        'phone',
        'website',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
