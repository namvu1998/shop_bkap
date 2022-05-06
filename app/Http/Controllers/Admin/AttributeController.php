<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $req){
        try{
            $attribute =  Attribute::latest()->paginate(10);
        if($req->ajax())
        {
                return view('admin.attribute.ajax_index',compact('attribute'));
        }
        return view('admin.attribute.index',compact('attribute'));
        }catch(\Throwable $th){
            throw $th;
        }
    }

    public function create(){
        try{
            return view('admin.attribute.create');
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function store(Request $req){
        try{
            $attribute = Attribute::create($req->all());
            if($attribute){
            return redirect()->route('admin.attribute.index')->with('success','Thêm mới thành công.');
            }
        }catch(\Throwable $th){
            throw $th;
        }
    } 

    public function edit($id){
        try{
            $attribute = Attribute::find($id);
            return view('admin.attribute.update',compact('attribute'));
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function update($id, Request $req){
        try{
            $attribute = Attribute::find($id);
            if($attribute){
                $attribute->update($req->all());
                return redirect()->route('admin.attribute.index')->with('success','Sửa thành công.');
            }
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function delete($id){
        try{
            Attribute::find($id)->delete();
            return redirect()->back()->with('success','Xóa thành công.');
        }catch(\Throwable $th){
            throw $th;
        }  
    }
}
