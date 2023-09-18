<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/29/2018
 * Time: 9:19 AM
 */

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends  Controller
{
    public function index(){
        return response()->json(Product::all());
    }

    public function show(Request $request, Product $product){


    }


    public function store(Request $request){
        $validator =Validator::make($request->all(),
            [
            'batch_id'=>'required',
             'product_name'=>'required',
              'manufacturer'=>'required',
              'barcode'=>'required',
              'quantity'=>'required',
                'price'=>'required',
                'manufacturing_date'=>'required',
                'expiry_date'=>'required'
            ]);

        if($validator->fails()){
            return response()->json(['status'=>'failed','message'=>'validation failed','data'=>$validator->errors()]);
        }

        $product = Product::where('product_name',$request->input('product_name'))
            ->where('batch_id',$request->input('batch_id'))->get();

//        if($product==null)
//            return response()->json(['status'=>'error','message'=>'product already exist','data'=>$product]);



        $product = new Product();
        $product->batch_id = $request->input('batch_id');
        $product->product_name = $request->input('product_name');
        $product->manufacturer = $request->input('manufacturer');
        $product->barcode = $request->input('barcode');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->manufacturing_date = $request->input('manufacturing_date');
        $product->expiry_date = $request->input('expiry_date');

        if($product->save()){
            return response()->json(['status'=>'success','message'=>'product added']);
        }else{
            return response()->json(['status'=>'error','message'=>'product was not added']);
        }

    }

    public function update(Request $request, $id){
        $product= Product::find($id);
        $product->batch_id = $request->input('batch_id');
        $product->product_name = $request->input('product_name');
        $product->manufacturer = $request->input('manufacturer');
        $product->barcode = $request->input('barcode');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->manufacturing_date = $request->input('manufacturing_date');
        $product->expiry_date = $request->input('expiry_date');

        if($product->save()){
            return response()->json(['status'=>'success','message'=>'product updated']);
        }else{
            return response()->json(['status'=>'error','message'=>'product was not updated']);
        }
    }

    public function destroy($id){
        if(Product::destroy($id))
            return response()->json(['status'=>'success','message'=>'product deleted']);
        return response()->json(['status'=>'error','message'=>'product was not deleted']);
    }
}