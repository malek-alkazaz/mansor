<?php

namespace App\Services\Invoice;
use Illuminate\Http\Request;

class InvoiceService
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __Construct($invoice = null) {
        if($invoice) {

            $this->items = $invoice->items;
            $this->totalQty = $invoice->totalQty;
            $this->totalPrice = $invoice->totalPrice;
        } else {

            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product , $request) {
        $item = [
            'id' =>  $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'totalPrice' => (int)$request->quantity * $product->price,
        ];

        if( !array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item ;
            $this->totalQty +=1;
            $this->totalPrice += $item['totalPrice']; 
            
        } else {
            
            $this->totalQty +=1 ;
            $this->totalPrice += $item['price']; 
        }
        // $this->items[$product->id]['qty']  += 1 ;
    }

    public function remove($id) {
        if( array_key_exists($id, $this->items)) {
            $this->totalPrice -= $this->items[$id]['totalPrice'];
            unset($this->items[$id]);
        }
        // dd($this->items);
    }

    public function updateQty($id, $qty) {
        //reset price in the invoes
        $this->totalPrice -= $this->items[$id]['totalPrice'];
        // add the item with new qty
        $this->items[$id]['quantity'] = $qty;
        $this->items[$id]['totalPrice'] = $this->items[$id]['price'] * $qty;
        // total price in invoes
        $this->totalPrice += $this->items[$id]['totalPrice'];
    }

}
