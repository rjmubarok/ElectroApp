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

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::all();
        $brands = Brand::where('status',1)->get();
        $units = Unit::where('status',1)->get();
        $colors = Color::where('status',1)->get();
        $sizes = Size::where('status',1)->get();
        $products = Product::where('status',1)->latest()->limit(12)->get();
        $bannercategory = Category::where('status',1)->latest()->limit(3)->get();
        return view('frontend.pages.home', compact(['categories', 'subcategories', 'brands', 'units', 'colors', 'sizes','products','bannercategory']));
    }
    public function singlepage($id){
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::all();
        $brands = Brand::where('status',1)->get();
        $units = Unit::where('status',1)->get();
        $colors = Color::where('status',1)->get();
        $sizes = Size::where('status',1)->get();
        $product = Product::FindOrFail($id);
        $bannercategory = Category::where('status',1)->latest()->limit(3)->get();
        $cat_id = $product->category_id;
        $relatedproduct = Product::where('category_id',$cat_id)->limit(4)->get();
        return view('frontend.pages.singelproduct', compact(['categories', 'subcategories', 'brands', 'units', 'colors', 'sizes','product','bannercategory','relatedproduct']));
      
    }
    public function categorywiseProduct($id){
        $products = Product::where('status',1)->where('category_id',$id)->limit(12)->get();
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::all();
        $brands = Brand::where('status',1)->get();
       return view('frontend.pages.categoryproduct', compact(['products','categories','subcategories','brands']));
    }
    public function subcategorywiseProduct($id){
        $products = Product::where('status',1)->where('subcategory_id',$id)->limit(12)->get();
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::all();
        $brands = Brand::where('status',1)->get();
       return view('frontend.pages.subcategoryproduct', compact(['products','categories','subcategories','brands']));
    }
    public function brandwiseProduct($id){
        $products = Product::where('status',1)->where('brand_id',$id)->limit(12)->get();
        $categories = Category::where('status',1)->get();
        $subcategories = SubCategory::all();
        $brands = Brand::where('status',1)->get();
       return view('frontend.pages.brandproduct', compact(['products','categories','subcategories','brands']));
    }
}
