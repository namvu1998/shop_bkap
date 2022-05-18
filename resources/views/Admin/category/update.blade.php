@extends('admin.master')
@section('content')
<div class="container">
    
    <nav class="navbar navbar-expand-sm fs-1 fw-bold">
        Sửa danh mục
    </nav>
   
    <form action="" method="POST" role="form">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label" >Danh mục</label>
            <input type="text" value="{{$category->name}}"
            class="form-control" name="name" id="" aria-describedby="helpId" placeholder="" value="{{old('name')}}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Trạng thái</label> <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="status" value="0" {{$category->status ==0?'checked' : ''}}>
                        Ẩn
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" id="status" value="1" {{$category->status ==1?'checked' : ''}}>
                        Hiện
                    </label>
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Thực hiện</button>
        <a class="btn btn-warning" href="{{route('admin.category.index')}}">Quay lại</a>
        
    </form>

</div>
@stop