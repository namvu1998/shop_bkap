<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    public function index(Request $req){
        try{
        if($req->key == null){
            $category =  Category::latest()->paginate(3);
        }else{
            $category = Category::where('name', 'like', "%" . $req->key. "%")->latest()->paginate(3);
        }
        if($req->ajax())
        {
                return view('admin.category.pagination',compact('category'));
        }
        return view('admin.category.index',compact('category'));
        }catch(\Throwable $th){
            throw $th;
        }
    }
    
    public function create(){
        try{
            return view('admin.category.create');
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function store(CreateCategory $req){
        try{
            $category = Category::create($req->all());
            if($category){
            return redirect()->route('admin.category.index')->with('success','Thêm mới thành công.');
            }
        }catch(\Throwable $th){
            throw $th;
        }
    } 

    public function edit($id){
        try{
            $category = Category::find($id);
            return view('admin.category.update',compact('category'));
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function update($id, Request $req){
        try{
            $category = Category::find($id);
            if($category){
                $category->update($req->all());
                return redirect()->route('admin.category.index')->with('success','Sửa thành công.');
            }
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function delete($id){
        try{
            Category::find($id)->delete();
            return redirect()->back()->with('success','Xóa thành công.');
        }catch(\Throwable $th){
            throw $th;
        }  
    }
    public function active($id){
        DB::table('categories')->where('id',$id)->update(['status'=>'1']);
        return redirect()->back()->with('success','Thay đổi trạng thái hành công!');
    }
    public function unactive($id){
        DB::table('categories')->where('id',$id)->update(['status'=>'0']);
        return redirect()->back()->with('success','Thay đổi trạng thái hành công!');
    }
}
