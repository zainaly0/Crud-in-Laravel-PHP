<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    // this method will show products page
    public function index(){
        $products = Product::orderBy('created_at')->get();
        return view('products.list', [
            'products' => $products,
        ]);

    }
    
    // this method will show create product page
    public function create(){
        return view('products.create');
    }

    // this method will store a product in db
    public function store(Request $request){

        //FIRST WAY OF VALIDATION= is case main validation data ur post method data dono ko compare krega 
        // Validator::make(data, validator Rules )
        $rules = [
            'name' => 'required | min:5',
            'sku' => 'required | min:3',
            'price' => 'required | numeric'
        ];

        if($request->image != ""){
            $rules['image']= 'image';
        }

       
        $validator = Validator::make($request->all(), $rules); 

        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        };



        //  ANOTHER WAY OF VALIDATION 
        // $validator = $request->validate([
        //     'name'=> 'required | min:5',
        //     'sku' => 'required | min:3',
        //     'price' => 'required | numeric'
        // ]);

        // if($validator->fails()){
        //     return redirect()->route('products.create')->withInput()->withErrors($validator);
        // }


        // HERE WE WILL INSERT PRODUCT IN DB
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
        //HERE WE WILL STORE IMAGE DATA
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();    //.jpg krke kch tha
        $imageName = time().'.'.$ext;   //unique image name

        //SAVE IMAGES TO PRODUCTS DIRECTORY
        $image->move(public_path('upload/Products'), $imageName);
        
        //SAVE IMAGE NAME IN DATABASE 
        $product->image = $imageName;
        $product->save();

        }


        return redirect()->route('products.index')->with('success', 'Product added successfully');
         

    }

    // this method will show edit product page
    public function edit($id){
        // dd($id);
        // echo $id;
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product,
        ]);

    }

    // this method will update a product
    public function update(Request $request, $id){

        $product = Product::findOrFail($id);

         //FIRST WAY OF VALIDATION= is case main validation data ur post method data dono ko compare krega 
        // Validator::make(data, validator Rules )
        $rules = [
            'name' => 'required | min:5',
            'sku' => 'required | min:3',
            'price' => 'required | numeric'
        ];

        if($request->image != ""){
            $rules['image']= 'image';
        }

       
        $validator = Validator::make($request->all(), $rules); 

        if($validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        };



        //  ANOTHER WAY OF VALIDATION 
        // $validator = $request->validate([
        //     'name'=> 'required | min:5',
        //     'sku' => 'required | min:3',
        //     'price' => 'required | numeric'
        // ]);

        // if($validator->fails()){
        //     return redirect()->route('products.create')->withInput()->withErrors($validator);
        // }


        // HERE WE WILL UPDATE PRODUCT IN DB
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            // DELETE OLD IMAGE 
            File::delete(public_path('upload/Products'. $product->image));


        //HERE WE WILL STORE IMAGE DATA
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();    //.jpg krke kch tha
        $imageName = time().'.'.$ext;   //unique image name

        //SAVE IMAGES TO PRODUCTS DIRECTORY
        $image->move(public_path('upload/Products'), $imageName);
        
        //SAVE IMAGE NAME IN DATABASE 
        $product->image = $imageName;
        $product->save();

        }


        return redirect()->route('products.index')->with('success', 'Product updated successfully');
         


    }

    // this method will delete a product
    public function destroy($id){
        $product = Product::findOrFail($id);
        // dd($id);
        
            File::delete(public_path('upload/Products'. $product->image));
        
            // DELETE PRODUCT FROM DATABSE 
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted successfully');
    }
}
