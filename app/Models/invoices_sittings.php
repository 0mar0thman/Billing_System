<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_sittings extends Model
{
    use HasFactory;
    protected $fillable = [
        'Discount_Commission',
        'Amount_Commission',
        'Amount_collection'
    ];
}
