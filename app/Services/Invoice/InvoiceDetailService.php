<?php

namespace App\Services\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;

class InvoiceDetailService
{
    public function store($invoiceID) {
        $invoice_content =session()->get('invoice');
        foreach( $invoice_content->items as $product){
            InvoiceDetails::create([
                'quantity' => $product['quantity'],
                'price' =>$product['totalPrice'],
                'product_id' => $product['id'],
                'invoice_id' => $invoiceID
            ]);
        }
    }

    
}