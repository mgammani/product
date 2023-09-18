<?php

namespace App\Http\Controllers;


use App\Batch;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class BatchController extends Controller
{
    /**
     * Get all product batches from  the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $batches = Batch::all();
        return response()->json($batches);
    }

    /**
     * Stores product batch in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request){
        $validator = Validator::make($request->all(),['batch_name'=>'required','created_by'=>'required']);

        if($validator->fails()){
            return response()->json(['status'=>'error','message'=>'validation failed','data'=>$validator->errors()]);
        }

        $batch = new Batch();
        $batch->batch_name = $request->input('batch_name');
        $batch->created_by = $request->input('created_by');

        if($batch->save())
            return response()->json(['status'=>'success','message'=>'batch added']);
        else
            return response()->json(['status'=>'error','message'=>'batch was not added']);
    }

    public function show(Request $request, Batch $batch){

    }


    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),['batch_name'=>'required','created_by'=>'required']);

        if($validator->fails()){
            return response()->json(['status'=>'error','message'=>'validation failed','data'=>$validator->errors(),'request'=>$request->all()]);
        }

        $batch =  Batch::find($id);
        $batch->batch_name = $request->input('batch_name');
        $batch->created_by = $request->input('created_by');

        if($batch->save())
            return response()->json(['status'=>'success','message'=>'batch updated']);
        else
            return response()->json(['status'=>'error','message'=>'batch was not updated']);
    }

    public function destroy($id){

            $products = Batch::find($id)->products;
            foreach ($products as  $product){
                Product::destroy($product->id);
            }

         if(Batch::destroy($id))
            return response()->json(['status'=>'success','message'=>'batch deleted']);
        return response()->json(['status'=>'error','message'=>'batch was not deleted']);
    }
}