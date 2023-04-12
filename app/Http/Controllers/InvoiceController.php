<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Invoice\InvoiceService;
use App\Services\Product\ProductService;
use App\Services\Invoice\InvoiceDetailService;

class InvoiceController extends Controller
{
    private $detailService;

    public function __construct(InvoiceDetailService $detailService)
    {
        $this->detailService = $detailService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index_invoice',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $products = Product::all();
        return view('invoice.create_invoice',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'client_name' => $request->name,
            'total_price' => $request->price
        ]);
        $this->detailService->store($invoice->id);
        session()->forget('invoice');
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice_content = Invoice::with('invoiceDetails')->find($invoice->id);
        return $invoice_content;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $invoice_content = Invoice::with('invoiceDetails')->find($invoice->id);
        $result =  $invoice_content->invoiceDetails;
        return view('invoice.edit_invoice',compact('invoice_content','result'));
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
        $invoice->update([
            'client_name' => ($request->client_name) ? $request->client_name : $invoice->client_name,
        ]);
        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function StoreInvoice_InSession (Request $request , Product $product)
    {
        if (session()->has('invoice')) {
            $invoice = new InvoiceService(session()->get('invoice'));
        } else {
            $invoice = new InvoiceService();
        }

        $invoice->add($product , $request);
        // dd($invoice);
        session()->put('invoice', $invoice);
        return redirect()->route('invoices.create')->with('success', 'Product was added');
    }

    public function deleteInvoice_FromSession (Product $product)
    {
        $invoice = new InvoiceService(session()->get('invoice'));
        $invoice->remove($product->id);

        if ($invoice->totalPrice <= 0) {
            session()->forget('invoice');
        }else {
            session()->put('invoice', $invoice);
        }

        return redirect()->route('invoices.view')->with('success', 'Product was removed');
    }

    public function updateInvoice_FromSession (Request $request , Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $invoice = new InvoiceService(session()->get('invoice'));
        $invoice->updateQty($product->id, $request->quantity);

        session()->put('invoice', $invoice);
        return redirect()->route('invoices.view')->with('success', 'Product updated');
    }

    public function viewInvoice()
    {
        if (session()->has('invoice')) {
            $invoice = new InvoiceService(session()->get('invoice'));
        } else {
            $invoice = null;
            return "No Product";
        }
        return view('invoice.details_invoice',compact('invoice'));
        // $session = (object) session()->all();
        // $invoice = $session->invoice;
        //  return $invoice->items;
        // return $invoice->totalQty;
    }
}
