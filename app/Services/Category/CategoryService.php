<?php

namespace App\Services\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\ImageTrait;

class CategoryService
{
    use ImageTrait;

    public function index()
    {
        return $categories = Category::all();
    }

    public function store($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        Category::create([
            'name'=>$request->name,
            'image'=> $this->uploadImage($request->image ,'category'),
        ]);
    }

    public function edit($category)
    {
        return $categories = Category::findorFail($category->id);
    }

    public function update($request , $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable'
        ]);

        //$category->fill($request->post())->update();
        $category->update([
            'name' => ($request->name) ? $request->name : $category->name,
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->destroyCategoryImage($category->image,'category');
            }
            $category->image = $this->uploadImage($request->image,'category');
            $category->save();
        }
    }

    public function destroy($category)
    {
        if ($category->image) {
            $this->destroyCategoryImage($category->image,'category');
        }
        $category->delete();
    }

}