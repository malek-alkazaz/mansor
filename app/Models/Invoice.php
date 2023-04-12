<?php

namespace App\Models;

use App\Models\InvoiceDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['client_name','total_price'];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class,'invoice_id');
    }
}
