<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use App\Models\Unit;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderBy('created_at','DESC')->paginate(20);
        return view('admin.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colors = explode(',',$request->color);
        $color = new Color();
        $color->color = json_encode($colors);    
        $color->save();
        return redirect()->back()->with('success' ,'Color Added Successfully');

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
    public function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
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
        $colors = explode(',',$request->color);
          Color::find($id)->update([
            'color'=> json_encode($colors),
        ]);
         return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if($color){
            $color->delete();
            return redirect()->back()->with('success', 'Color Deleted Successfully');
        } 
    }
    public function active($id){
        Color::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        Color::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
