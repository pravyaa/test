<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function productAll(){
        $Products = ProductModel::latest()->paginate(5);
        return view('admin.product.productall',compact('Products'));
    }

    public function saveProduct(Request $request){
         $validated = $request->validate([
        'Product_name' => 'required|unique:product_models|max:255|min:4',
        'Product_image' => 'required|mimes:jpg,jpeg,png',
        'Product_qty' =>'required'
       
    ]);

        $Product_image = $request->file('Product_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($Product_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$img_ext;
        $upload_path = 'uploads/products/';
        $last_image = $upload_path.$image_name;
        $Product_image->move($upload_path,$image_name);
        // $img = Image::make($brand_image)->resize(300, 200)->save('uploads/brand/'.$name_gen);
        // $last_image = 'uploads/brand/'.$name_gen;


        $product_ins = ProductModel::insert([
            'product_name' =>$request->Product_name,
            'product_image' => $last_image,
            'product_qty' =>$request->Product_qty,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Product added successfully');


    }

    public function editproduct($id){

        $products = ProductModel::find($id);

        return view('admin.product.editProduct',compact('products'));

    }

    public function updateProduct(Request $request,$id){

         $validated = $request->validate([
        'product_name' => 'required|max:255|min:4',
        'product_image' => 'mimes:jpg,jpeg,png'
       
    ]);

        $old_image = $request->old_image;

        $product_image = $request->file('product_image');

        if($product_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($product_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$img_ext;
        $upload_path = 'uploads/product/';
        $last_image = $upload_path.$image_name;
        $product_image->move($upload_path,$image_name);
       // unlink($old_image);
        }else{
            $last_image = $old_image;
        }

        


        $product_ins = ProductModel::find($id)->update([
            'product_name' =>$request->product_name,
            'product_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('product.all')->with('success','Product added successfully');


    }

    public function deleteProduct($id){
        $image = ProductModel::find($id);
        $product_image = $image->product_image;
        unlink($product_image);

        $productDelt = ProductModel::find($id)->delete();
         return redirect()->back()->with('success','Product deleted successfully');
    }
}
