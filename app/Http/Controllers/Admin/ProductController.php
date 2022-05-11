<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDetail;
use App\Http\Requests\CreateProduct;
use App\Http\Requests\UpdateVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_img;
use App\Models\Product_variant;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $req)
    {
        try {
            if ($req->key == null) {
                $products =  Product::latest()->paginate(3);
            } else {
                $products = Product::where('name', 'like', "%" . $req->key . "%")->latest()->paginate(3);
            }
            if ($req->ajax()) {
                return view('admin.product.pagination', compact('products'));
            }
            return view('admin.product.index', compact('products'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            $attribute = Attribute::all();
            $attribute_color = Attribute::where('name', 'color')->get();
            $attribute_size = Attribute::where('name', 'size')->get();

            return view('admin.product.create', compact('categories', 'attribute_color', 'attribute_size', 'attribute'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(CreateProduct $req)
    {
        try {
            if ($req->hasFile('file')) {
                $file = $req->file;
                $fileName = $file->getClientOriginalName();
                $file->move('uploads', $fileName);
                $req->merge(['image' => $fileName]);
                $product = Product::create([
                    'name' => $req->name,
                    'slug' => $req->sl,
                    'price' => $req->price,
                    'sale_price' => $req->sale_price,
                    'category_id' => $req->category_id,
                    'image' => $req->image,
                    'content' => $req->content,
                    'description' => $req->description,
                    'shoe_code' => $req->shoe_code,
                    'status' => $req->status,
                ]);
            }
            if ($req->hasFile('files')) {
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
            return redirect()->route('admin.product.index')->with('success', 'Thêm mới thành công.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $products = Product::find($id);
            $categories = Category::all();
            $attribute = Attribute::all();
            $attribute_color = Attribute::where('name', 'color')->get();
            $attribute_size = Attribute::where('name', 'size')->get();

            return view('admin.product.edit', compact('products', 'categories', 'attribute_color', 'attribute_size', 'attribute'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, Request $request)
    {
        try {
            $product = Product::find($id);
            if ($request->hasFile('file')) {
                $file = $request->file;
                $fileName = $file->getClientOriginalName();
                $file->move('uploads', $fileName);
                $request->merge(['image' => $fileName]);
                $product = Product::create([
                    'name' => $request->name,
                    'slug' => $request->sl,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'category_id' => $request->category_id,
                    'image' => $request->image,
                    'content' => $request->content,
                    'description' => $request->description,
                    'shoe_code' => $request->shoe_code,
                    'status' => $request->status,
                ]);
            }
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->move('uploads', $fileNames);
                    $img_product = Product_img::create([
                        'product_id' => $product->id,
                        'images' => $fileNames,
                    ]);
                }
            };
            return redirect()->route('admin.product.index')->with('success', 'Cập nhật dữ liệu thành công!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteFiles($id)
    {
        $products = Product_img::findOrFail($id);
        if (File::exists("uploads/" . $products->images)) {
            File::delete("uploads/" . $products->images);
        }
        Product_img::find($id)->delete();
        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->product_variants()->delete($id);
            $product->delete($id);
            return redirect()->route('admin.product.index', compact('product'))->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function detail($id)
    {
        try {
            $product = Product::find($id);
            $product_details =  Product_variant::where("product_id", $id)->paginate(10);
            return view('admin.product.detail', compact('id', 'product_details', 'product'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createDetail($id)
    {
        try {
            $attribute_color = Attribute::where('name', 'color')->get();
            $attribute_size = Attribute::where('name', 'size')->get();
            return view('admin.product.createDetail', compact('attribute_color', 'attribute_size'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function storeDetail(CreateDetail $req, $id)
    {
        try {

            Product_variant::create([
                'product_id' => $id,
                'color_id' => $req->color_id,
                'size_id' => $req->size_id,
                'quantity' => $req->quantity,
            ]);
            return redirect()->route('admin.product.detail', ['id' => $id]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editDetail($id)
    {
        try {
            $attribute = Product_variant::find($id);
            $attribute_color = Attribute::where('name', 'color')->get();
            $attribute_size = Attribute::where('name', 'size')->get();
            $color_id = DB::table('product_variants')
                ->join('attributes', 'attributes.id', 'product_variants.color_id')
                ->where('attributes.id', $attribute->color_id)
                ->get();
            foreach ($color_id as $color_id1) {
                $color_id = $color_id1->value;
            }
            $size_id = DB::table('product_variants')
                ->join('attributes', 'attributes.id', 'product_variants.size_id')
                ->where('attributes.id', $attribute->size_id)
                ->get();
            foreach ($size_id as $size_id1) {
                $size_id = $size_id1->value;
            }
            return view('admin.product.editDetail', compact('attribute_color', 'attribute_size', 'attribute', 'color_id', 'size_id'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateDetail(UpdateVariant $request, $id)
    {
        try {
            Product_variant::find($id)->update([
                'product_id' => $id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
            ]);
            return redirect()->route('admin.product.detail', ['id' => $id])->with('success', 'Cập nhật biến thể thành công.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteDetail($id)
    {
        try {
            Product_variant::findOrFail($id)->delete();
            return redirect()->route('admin.product.detail', ['id' => $id])->with('success', 'Xóa biến thể thành công.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function active($product_id)
    {
        DB::table('products')->where('id', $product_id)->update(['status' => '1']);
        return redirect()->back()->with('success', 'Thay đổi trạng thái hành công!');
    }
    public function unactive($product_id)
    {
        DB::table('products')->where('id', $product_id)->update(['status' => '0']);
        return redirect()->back()->with('success', 'Thay đổi trạng thái hành công!');
    }
}
