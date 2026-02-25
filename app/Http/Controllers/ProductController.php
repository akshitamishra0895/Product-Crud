<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $data['result'] = Product::getLists($request->all());
            return view('product',$data);
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $added = Product::addUpdate($request);
            if($added['status']==true){
                return response()->json(['status'=>true,'message'=>$added['message']]);
            }else{
                return response()->json(['status'=>false,'message'=>$added['message']]);
            }
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        try{
            $updated = Product::addUpdate($request,$request->input('id'));
            if($updated['status']==true){
                return response()->json(['status'=>true,'message'=>$updated['message']]); 
            }
            else{
                return response()->json(['status'=>false,'message'=>$updated['message']]);
            } 
        }
        catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $deleted = Product::deleteRecord($id);
            if($deleted['status']==true){
                return response()->json(['status' => true,'message' => 'Product deleted successfully']);
            }
            else{
                return response()->json(['status' => true,'message' => 'Error in deleting product']);
            } 
        }
        catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()]); 
        }
    }

    /**
     * Remove the specified images from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id)
    {
        try{
            $deleted = Product::deleteImage($id);
            if($deleted['status']==true){
                return response()->json(['status' => true,'message' => 'Product deleted successfully']);
            }
            else{
                return response()->json(['status' => true,'message' => 'Error in deleting product']);
            } 
        }
        catch(\Exception $ex){
            return response()->json(['status'=>false,'message'=>$ex->getMessage() . ' '. $ex->getLine() . ' '. $ex->getFile()]); 
        }
    }

    public function ajaxList(){
        $result = Product::getLists('');
        return view('includes.product_list', compact('result'));
    }
}
