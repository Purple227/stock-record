<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::orderBy('id', 'desc')->paginate(5);
        return response()->json($inventories);
    }


    public function sortByDate($date)
    {
        $by_date = Inventory::whereDate('created_at', $date)->orderBy('id', 'desc')->paginate(5);
        return response()->json($by_date);
    }

    public function getBagInNumber()
    {
        $totalData = Inventory::all('total_weight', 'total_discount', 'created_at');
        return response()->json($totalData);
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
        'total_weight' => 'required',
        'total_discount' => 'required',
        'total_bags' => 'required',
        'broker' => 'required'
        ]);

        $inventory = new Inventory;
        $inventory->total_weight = $request->total_weight;
        $inventory->total_discount = $request->total_discount;
        $inventory->total_bags = $request->total_bags;
        $inventory->broker = $request->broker;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return response()->json($inventory);
    }
}
