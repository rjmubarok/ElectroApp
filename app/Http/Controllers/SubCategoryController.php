<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubCategory $subCategory)
    {
        $subCategory = SubCategory::all();
        return view('admin.subcategory.index', compact('subCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->description = $request->description;
        $subCategory->category_id = $request->category;
      
         $subCategory->save();
         return redirect()->back()->with('success' ,'Sub Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return view('admin.subcategory.edit', compact(['subCategory','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
          SubCategory::find($id)->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'category_id'=> $request->category,
        ]);
         return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory, $id)
    {
        SubCategory::find($id)->delete();
        return redirect()->back()->with('success' ,'Sub Category Delete Successfully');
    }
    public function active($id){
        SubCategory::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        SubCategory::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
