<?php

namespace App\Services\Product;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\ImageTrait;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductService
{
    use ImageTrait;

    public function index()
    {
        return $products = Product::all();
    }

    public function store($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
            'quantity' => 'required',
            'category_id' => 'required',
            'image.*' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $images = [];
        if($request->hasfile('image'))
        {
           foreach($request->file('image') as $image)
           {
                $images[] = $this->uploadImage($image,'product');
           }
           $QR_image = $this->Qr_Image($request->name);

           $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'image' => $images,
                'image_qr' => $QR_image,
                'category_id' => $request->category_id
            ]);
        }
    }

    public function update($request, $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
            'quantity' => 'required',
            'category_id' => 'required',
            'image.*' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $images = [];
        if ($request->hasFile('image')) {
            if ($product->image) {
                $this->destroyImage($product ,'product');
                foreach($request->file('image') as $image)
                {
                    $images[] = $this->uploadImage($image,'product');
                }
            }
        }

        $product->update([
            'name' => ($request->name) ? $request->name : $product->name ,
            'price' => ($request->price) ? $request->price : $product->price,
            'description' => ($request->description) ? $request->description : $product->description,
            'quantity' => ($request->quantity) ? $request->quantity : $product->quantity,
            'image' => ($images) ? $images : $product->image,
            'category_id' => ($request->category_id) ? $request->category_id : $product->category_id,
        ]);

    }

    public function destroy($product)
    {
        if($product->image) {
            $this->destroyImage($product ,'product');
        }
        $product->delete();
    }

    public function search($name)
    {
        return $products = Product::where('name','like','%'.$name.'%')->get();
    }

    public function getProductByCategory($category)
    {
        return $products = Product::where('category_id',$category)->get();
    }

}