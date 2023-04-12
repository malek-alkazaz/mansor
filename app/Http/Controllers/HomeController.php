<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductService;

class HomeController extends Controller
{
    private $productService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->productService = new ProductService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->productService->index();
        return view('home',compact('products'));
    }

}
