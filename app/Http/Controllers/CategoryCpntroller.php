<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryCpntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at','DESC')->paginate(20);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $category = new Category;
        $category->id=$request->category;
        $category->name = $request->name;
        $category->description = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = uniqid().'.' .$ext;
            $file->move('admin/uploads/', $filename);
            $category->image = 'admin/uploads/'.$filename;
        }
         $category->save();
         return redirect()->back()->with('success' ,'Category Added Successfully');

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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category )
    {
        
        $category->name = $request->name;
        $category->description = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = uniqid().'.' .$ext;
            $file->move('admin/uploads/', $filename);
            $category->image = 'admin/uploads/'.$filename;
        }
         $category->update();
         return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
            return redirect()->back()->with('success', 'Category Deleted Successfully');
        }
    
    }
    public function active($id){
        Category::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        Category::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
