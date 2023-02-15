<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $product;
    private $section;

    public function __construct(Product $product, Section $section)
    {
        $this->product = $product;
        $this->section = $section;
    }

    public function index()
    {
        $all_products = $this->product->latest()->get();

        return view('products.index')->with('all_products', $all_products);
    }

    public function create()
    {
        $all_sections = $this->section->all();

        return view('products.create')->with('all_sections', $all_sections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:50',
            'image'       => 'mimes:jpg,jpeg,png,gif|max:1048',
            'description' => 'required|max:1000',
            'price'       => 'required',
            'section_id'  => 'required|integer'
        ]);

        $this->product->user_id     = Auth::User()->id;
        $this->product->name        = $request->name;
        $this->product->description = $request->description;
        $this->product->price       = $request->price;
        $this->product->section_id  = $request->section_id;

        if($request->image){
            $this->product->image = $this->saveImage($request);
        }

        $this->product->save();

        return redirect()->route('product.index');
    }

    public function saveImage($request)
    {
        $image_name = time() . "." . $request->image->extension();
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    public function edit($id)
    {
        $all_sections = $this->section->all();
        $product = $this->product->findOrFail($id);

        return view('products.edit')->with('all_sections', $all_sections)->with('product', $product);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|min:1|max:50',
            'image'       => 'mimes:jpg,jpeg,png,gif|max:1048',
            'description' => 'required|min:1|max:1000',
            'price'       => 'required',
            'section_id'  => 'required|integer'
        ]);

        $product              = $this->product->findOrFail($id);
        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->section_id  = $request->section_id;

        if($request->image){
            $this->deleteImage($product->image);
            $product->image = $this->saveImage($request);
        }

        $product->save();

        return redirect()->route('product.index');
    }

    private function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function destroy($id)
    {
        $this->product->destroy($id);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        // make your search here use where
        // create a search page 
        // create a form in app.blade.php 
        // create a route

        $products = $this->product->where('section_id', 'like','%'.$request->search.'%')->orWhere('name', 'like','%'.$request->search.'%')->get();
        
        return view('products.search')->with('products', $products)->with('search', $request->search);
    }

}
