@extends('admin.master')
@section('content')
<div class="container">
    <div style="display:flex; justify-content: end;">
        <a href="{{route('admin.attribute.index')}}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">
            Sửa thuộc tính
        </a>
   </div>
    <form action="{{route('admin.attributeValue.edit',$id)}}" method="post" >
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên thuộc tính</label>
                <input type="text" value="{{$attribute->name}}" id="v1" class="form-control" name="attribute_name" disabled>
    
                {{-- <select class="form-control" id="inputName" name="name">
                    @foreach($attribute as $item)
                        <option value="{{$item->type}}">{{$item->name}}</option>
                    @endforeach
                </select> --}}
            </div>

            <div class="hung">
                <div class="mb-3 value1">
                <label class="form-label">Giá trị</label>
                    <input type="{{$attribute->name=='color' ? 'color':'text'}}" value="{{$attribute->value}}" name="value" id="v1" class="form-control">
                </div>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary" id="btn-attr">Thực hiện</button>
            <a class="btn btn-warning" href="{{route('admin.attributeValue.index')}}">Quay lại</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@stop