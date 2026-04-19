<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index(){
        $stocks = Stock::all();
        return response()->json([
            'status'=>'success',
            'message'=>'Stocks fetched successfully',
            'stocks'=>$stocks
        ], 200);
    }
    public function store(Request $request){
        $validations=$request->validate([
            'item_name'=>'required|string|max:255',
            'stock_quantity'=>'required|integer',
            'alert_level'=>'required|integer',
            'unit'=>'required|string|max:255',
            'department_id'=>'required|integer',
        ]);
        $stock = Stock::create($validations);
        return response()->json([
            'status'=>'success',
            'message'=>'Stock created successfully',
            'stock'=>$stock
        ], 200);
    }
    public function edit(Request $request,$id){
        if(empty($id)){
            return response()->json([
                'status'=>'error',
                'message'=>'Stock not found',
            ], 404);
        }
        $stock=Stock::findOrFail($id);
        $validations=$request->validate([
            'item_name'=>'required|string|max:255',
            'stock_quantity'=>'required|integer',
            'alert_level'=>'required|integer',
            'unit'=>'required|string|max:255',
            'department_id'=>'required|integer',
        ]);
        $stock->update($validations);
        return response()->json([
            'status'=>'success',
            'message'=>'Stock updated successfully',
            'stock'=>$stock
        ], 200);
    }
    public function destroy(Request $request,$id){
        if(empty($id)){
            return response()->json([
                'status'=>'error',
                'message'=>'Stock not found',
            ], 404);
        }
        $stock=Stock::findOrFail($id);
        $stock->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Stock deleted successfully',
        ], 200);
    }
}
