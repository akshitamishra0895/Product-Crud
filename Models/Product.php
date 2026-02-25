<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    /**
     * Fetch list of data from here
    **/
    public static function getLists($search){
        try {
            $obj = new self;
            $pagination = 10;
            $data = $obj->with('images')->latest('created_at')->paginate($pagination)->appends('perpage', $pagination);
            if(count($data)){
                foreach($data as $row){
                    $row->product_images = ProductImage::where('product_id',$row->id)->get();
                }
            }
            return $data;
        }
        catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
    /**
     * Add or update data
    **/
    public static function addUpdate($request,$id=0) {
        try {
            $obj = new self;
            $data = $request->except('_token','images');
            $image = "";
            if($id==0){
                $data['created_at'] = date('Y-m-d H:i:s');
                $product_id= $obj->insertGetId($data);
                if($product_id){
                    if($request->hasFile('images')){
                        foreach($request->file('images') as $img){
                            $name = time().rand().'.'.$img->getClientOriginalExtension();
                            $img->move(public_path('uploads/products'), $name);
                            ProductImage::insert([
                                'product_id' => $product_id,
                                'product_image' => $name,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    return ['status' => true, 'message' => 'Product added successfully.'];
                }
            }
            else{
                $data['updated_at'] = date('Y-m-d H:i:s');
                $obj->where('id',$id)->update($data);
                if($request->hasFile('images')){
                    foreach($request->file('images') as $img){
                        $name = time().rand().'.'.$img->getClientOriginalExtension();
                        $img->move(public_path('uploads/products'), $name);

                        ProductImage::insert([
                            'product_id' => $id,
                            'product_image' => $name,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                return ['status' => true, 'message' => "Product updated successfully."];
            }  
        }
        catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }
    /**
     * Delete particular category
    **/
    public static function deleteRecord($id) {
        try {
            $obj = new self;    
            $obj->where('id',$id)->delete();   
            return ['status' => true, 'message' => "Product deleted successfully."];
        }
        catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage() . ' '. $e->getLine() . ' '. $e->getFile()];
        }
    }

    public static function deleteImage($id){
        try{
            $img = ProductImage::find($id);

            if(!$img){
                return ['status'=>false,'message'=>'Product image not found'];
            }

            $file = public_path('uploads/products/'.$img->product_image);
            if(file_exists($file)){
                unlink($file);
            }

            $img->delete();

            return ['status'=>true,'message'=>'Product image deleted successfully'];

        } catch(\Exception $e){
            return ['status'=>false,'message'=>$e->getMessage().' '.$e->getLine().' '.$e->getFile()];
        }
    }
}
