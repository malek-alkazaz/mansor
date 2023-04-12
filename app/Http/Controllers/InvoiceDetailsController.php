<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
        $product = product::find($invoiceDetails->product_id);
        $invoice = Invoice::find($request->invoice_id);

        $old_Qty_price = $invoiceDetails->quantity * $product->price;
        $oldTotalPrice = $invoice->total_price - $old_Qty_price;

        
        $price = (int) $request->quantity * $product->price;
        $newTotalPrice = $oldTotalPrice + $price;

        $invoiceDetails->update([
            'quantity' => ($request->quantity) ? $request->quantity : $invoiceDetails->quantity,
            'price' => ($request->quantity) ? $price : $invoiceDetails->price,
        ]);
        
        $invoice->update([
            'total_price' => $newTotalPrice,
        ]);

        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceDetails $invoiceDetails)
    {
        //
    }
}
