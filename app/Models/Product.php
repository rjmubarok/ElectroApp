<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
    public static function catproductcount($cat_id){
        $catcount =Product::where('category_id',$cat_id)->where('status',1)->count();
        return  $catcount;
    }
    public static function subcatproductcount($subcat_id){
        $subcatcount =Product::where('subcategory_id',$subcat_id)->where('status',1)->count();
        return  $subcatcount;
    }
    public static function brandproductcount($brand_id){
        $brandcount =Product::where('brand_id',$brand_id)->where('status',1)->count();
        return  $brandcount;
    }
}
