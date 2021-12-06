<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.create', compact(['categories', 'subcategories', 'brands', 'units', 'colors', 'sizes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product =  new Product;
        $product ->category_id = $request->category;
        $product ->subcategory_id = $request->subcategory;
        $product ->brand_id = $request->brand;
        $product ->unit_id = $request->unit;
        $product ->size_id = $request->size;
        $product ->color_id = $request->color;
        $product ->name = $request->name;
        $product ->code = $request->code;
        $product ->price = $request->price;
        $product ->description = $request->description;
        $images = array();
        if($files = $request->file('file')){
            $i = 0;
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $filenameextract = explode('.',$name);
                $fileName = $filenameextract[0];
                $fileName.= uniqid();
                $fileName.= $i;
                $fileName.= '.';
                $fileName.= $filenameextract[1];
                
                $file->move('image',$fileName);
                $images[]=$fileName;
                $i++;
            }
            $product['image']=implode('|',$images);
            $product->save();
            return redirect()->back()->with('success', 'New Product Added Successfully');
        }else{
            echo("Error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.edit', compact(['categories', 'subcategories', 'brands', 'units', 'colors', 'sizes', 'product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $update =  Product::find($id)->update([
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id' => $request->brand,
            'unit_id' => $request->unit,
            'size_id' => $request->size,
            'color_id' =>$request->color,
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'description' => $request->description,

        ]);
        if($update){
            return redirect()->route('products.index')->with('update', 'Product Update SuccessFully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product)
    {
        if($product){
            $product->delete();
            return redirect()->back()->with('success', 'Product  Deleted Successfully');
        }
    }
    public function active($id){
        Product::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        Product::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
