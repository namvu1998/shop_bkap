<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDetail;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_img;
use App\Models\Product_variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $req){
        try{
        if($req->key == null){
            $products =  Product::latest()->paginate(100);
        }else{
            $products = Product::where('name', 'like', "%" . $req->key. "%")->latest()->paginate(100);
        }
        if($req->ajax())
        {
                return view('admin.product.pagination',compact('products'));
        }
        return view('admin.product.index',compact('products'));
        }catch(\Throwable $th){
            throw $th;
        }
    }
    
    public function create(){
        try{
            $categories = Category::all(); 
            $attribute = Attribute::all();
            $attribute_color = Attribute::where('name','color')->get();
            $attribute_size = Attribute::where('name','size')->get();
            
            return view('admin.product.create',compact('categories','attribute_color','attribute_size','attribute'));

        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function store(Request $req){
        try{
            if($req->hasFile('file')){
                $file= $req->file;
                $fileName = $file->getClientOriginalName();
                $file->move('uploads',$fileName);
                $req->merge(['image'=>$fileName]);
                $product=Product::create([
                'name'=>$req->name,
                'slug'=>$req->sl,
                'price'=>$req->price,
                'sale_price'=>$req->sale_price,
                'category_id'=>$req->category_id,
                'image'=>$req->image,
                'content'=>$req->content,
                'description'=>$req->description,
                'shoe_code'=>$req->shoe_code,
                'status'=>$req->status,
                ]);
            }
            if($req->hasFile('files')){
                $files = $req->file('files');
                foreach($files as $value){
                        $fileNames = $value->getClientOriginalName();
                        $value->move('uploads',$fileNames);
                        $img_product= Product_img::create([
                            'product_id'=>$product->id,
                            'images'=>$fileNames,
                        ]);
                }      
            };
            return redirect()->route('admin.product.index')->with('success','Thêm mới thành công.');
            
        }catch(\Throwable $th){
            throw $th;
        }
    } 

    public function edit($id){
        try{
           
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function update($id, Request $req){
        try{
            
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function delete($id){
        try{
            
        }catch(\Throwable $th){
            throw $th;
        }  
    }

    public function detail($id){
        try{
            $product = Product::find($id);
            $product_details = Product_variant::where("product_id",$id)->paginate(10);
            return view('admin.product.detail',compact('id','product_details','product')); 
        }catch(\Throwable $th){
            throw $th;
        }  
    }

    public function createDetail($id){
        try{
            $attribute_color = Attribute::where('name','color')->get();
            $attribute_size = Attribute::where('name','size')->get();
            return view('admin.product.createDetail',compact('attribute_color','attribute_size'));
        }catch(\Throwable $th){
            throw $th;
        }  
    }

    public function storeDetail(CreateDetail $req,$id){
        try{
         
            Product_variant::create([
                'product_id'=>$id,
                'color_id'=>$req->color_id,
                'size_id'=>$req->size_id,
                'quantity'=>$req->quantity,
            ]);
            return redirect()->route('admin.product.detail',['id' => $id]);
            
        }catch(\Throwable $th){
            throw $th;
        }  
    }

    public function editDetail(){
        try{
            
        }catch(\Throwable $th){
            throw $th;
        }  
    }

    public function updateDetail(){
        try{
            
        }catch(\Throwable $th){
            throw $th;
        }  
    } 

    public function deleteDetail(){
        try{
            
        }catch(\Throwable $th){
            throw $th;
        }  
    } 
    public function active($product_id){
        DB::table('products')->where('id',$product_id)->update(['status'=>'1']);
        return redirect()->back()->with('success','Thay đổi trạng thái hành công!');
    }
    public function unactive($product_id){
        DB::table('products')->where('id',$product_id)->update(['status'=>'0']);
        return redirect()->back()->with('success','Thay đổi trạng thái hành công!');
    }
}

