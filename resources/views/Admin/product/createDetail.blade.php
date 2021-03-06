@extends('admin.master')
@section('content')
<div class="container">
    <nav class="navbar navbar-expand-sm fs-1 fw-bold">
        Create Detail
    </nav>
    <form action="" method="POST" role="form">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            @foreach($attribute_color as $data)
                <div class="form-check" style="margin-bottom:1rem !important">
                    <input type="radio" name='color_id' class="form-check-input" id="exampleCheck1" value="{{$data->id}}">
                        <label class="form-check-label" for="exampleCheck1">
                            <div style ="width:50px; height:20px; background:{{$data->value}}"></div>
                        </label>
                </div>
            @endforeach
            @error('color_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Size</label>
            @foreach($attribute_size as $data)
                <div class="form-check" style="margin-bottom:1rem !important">
                    <input type="radio" name='size_id' class="form-check-input" id="exampleCheck1" value="{{$data->id}}"> 
                        <label class="form-check-label" for="exampleCheck1"> {{$data->value}}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Quantity</label>
            <input type="text"
            class="form-control @error('name') is-invalid @enderror" name="quantity" id="" aria-describedby="helpId" value="{{old('name')}}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Thực hiện</button>
        <a class="btn btn-warning" href="{{route('admin.category.index')}}">Quay lại</a>
        
    </form>

</div>

@stop