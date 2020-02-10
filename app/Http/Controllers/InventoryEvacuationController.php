<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryEvacuation;

class InventoryEvacuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = InventoryEvacuation::orderBy('id', 'desc')->paginate(5);
        return response()->json($inventories);
    }

    public function sortByDate($date)
    {
        $by_date = InventoryEvacuation::whereDate('created_at', $date)->orderBy('id', 'desc')->paginate(5);
        return response()->json($by_date);
    }

    public function getBag()
    {
        $get_bag = InventoryEvacuation::all('weight', 'created_at');
        return response()->json($get_bag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
        'name' => 'required',
        'tonne' => 'required',
        'weight' => 'required',
        'bags' => 'required'
        ]);

        $inventory = new InventoryEvacuation;
        $inventory->name = $request->name;
        $inventory->tonne = $request->tonne;
        $inventory->weight = $request->weight;
        $inventory->bags = $request->bags;
        $inventory->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = InventoryEvacuation::findOrFail($id);
        return response()->json($inventory);
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
        
        $inventory = InventoryEvacuation::findOrFail($id);

        $validatedData = $request->validate([
        'name' => 'required',
        'tonne' => 'required',
        'weight' => 'required',
        'bags' => 'required'
        ]);

        $inventory->name = $request->name;
        $inventory->tonne = $request->tonne;
        $inventory->weight = $request->weight;
        $inventory->bags = $request->bags;
        $inventory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = InventoryEvacuation::findOrFail($id);
        $inventory->delete();
        return response()->json($inventory);
    }
}
