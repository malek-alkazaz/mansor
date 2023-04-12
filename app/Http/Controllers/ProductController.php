<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Invoice\InvoiceService;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->index();
        return view('product.index_product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->productService->store($request);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show_product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edite_product',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->productService->update($request , $product);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->destroy($product);
        return redirect()->route('product.index');
    }


    public function search(Request $request)
    {
        $products = $this->productService->search($request->search);
        return view('product.index_product',compact('products'));
    }

    public function getProductByCategory(Request $request)
    {
        $products = $this->productService->getProductByCategory($request->search);
        return view('product.index_product',compact('products'));
    }

    // public function create_invoice(Request $request , Product $product)
    // {
    //     if (session()->has('invoice')) {
    //         $invoice = new InvoiceService(session()->get('invoice'));
    //     } else {
    //         $invoice = new InvoiceService();
    //     }
    //     $invoice->add($product , $request);
    //     session()->put('invoice', $invoice);
    //     return redirect()->route('invoice.index')->with('success', 'Product was added');
    // }
    
}
