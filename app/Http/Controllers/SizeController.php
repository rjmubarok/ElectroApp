<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Unit;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::orderBy('created_at','DESC')->paginate(20);
        return view('admin.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sizes = explode(',',$request->size);
        $size = new Size();
        $size->size = json_encode($sizes);    
        $size->save();
        return redirect()->back()->with('success' ,'Size Added Successfully');

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
    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
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
        $sizes = explode(',',$request->size);
          Size::find($id)->update([
            'size'=> json_encode($sizes),
        ]);
         return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        if($size){
            $size->delete();
            return redirect()->back()->with('success', 'Size Deleted Successfully');
        } 
    }
    public function active($id){
        Size::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        Size::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
