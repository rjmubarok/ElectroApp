<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::orderBy('created_at','DESC')->paginate(20);
        return view('admin.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $unit = new Unit;
        $unit->id=$request->category;
        $unit->name = $request->name;
        $unit->description = $request->description;
        $unit->save();
        return redirect()->back()->with('success' ,'Unit Added Successfully');

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
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
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
          Unit::find($id)->update([
            'name'=> $request->name,
            'description'=> $request->description,
        ]);
         return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        if($unit){
            $unit->delete();
            return redirect()->back()->with('success', 'Unit Deleted Successfully');
        }
    
    }
    public function active($id){
        Unit::find($id)->update(['status'=> 1]);
        return redirect()->back();
    }
    public function deactive($id){
        Unit::find($id)->update(['status'=> 0]);
        return redirect()->back();
    }
}
