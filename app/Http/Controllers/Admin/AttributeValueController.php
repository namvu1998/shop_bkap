<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAttr;
use App\Http\Requests\UpdateAttr;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeValueController extends Controller
{
    public function index(Request $req){
        try{
            $attribute = Attribute::all();
            if($req->ajax())
            {
                return view('admin.attributeValue.pagination',compact('attribute'));
            }
            return view('admin.attributeValue.index',compact('attribute')); 
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function create(){
        try{
            return view('admin.attributeValue.create');
        }catch(\Throwable $th){
            throw $th;
        }
    }

    public function store(CreateAttr $req){
        try{
            foreach ($req->value as $value){
                Attribute::create([
                    'name'=>$req->name,
                    'value'=>$value,
                ]);   
            }   
            return redirect()->route('admin.attributeValue.index');
        }catch(\Throwable $th){
            throw $th;
        }    
    }

    public function edit($id){
        try{
            $attribute = Attribute::find($id);
            return view('admin.attributeValue.update',compact('attribute','id'));
        }catch(\Throwable $th){
            throw $th;
        }
        
    }

    public function update($id,UpdateAttr $req){
        try{
            Attribute::find($id)->update($req->all());
            return redirect()->route('admin.attributeValue.index');
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
