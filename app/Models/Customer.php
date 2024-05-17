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
        'contact_person_name',
        'contact_person_email',
        'date_of_birth',
        'contact_person_address',
        'company_name',
        'company_address',
        'contact_person_mobile',
        'contact_person_phone',
        'contact_person_website',
        'company_phone',
        'company_website',
        'company_email'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
