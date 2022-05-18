@extends('admin.master')
@section('content')
<div class="container">
    <nav class="navbar navbar-expand-sm fs-1 fw-bold">
        Thêm mới sản phẩm
    </nav>
    <form action="" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control " name="name" id="name" aria-describedby="helpId" value="{{old('name')}}" onkeyup="ChangeToSlug()">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Đường dẫn chuẩn seo</label>
            <input type="text" class="form-control " name="sl" id="slug" aria-describedby="helpId" value="{{old('sl')}}">
            @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Giá</label>
            <input type="text" class="form-control" name="price" id="" aria-describedby="helpId" value="{{old('price')}}">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Khuyến mãi</label>
            <input type="text" class="form-control" name="sale_price" id="" aria-describedby="helpId" value="{{old('sale_price')}}">
            @error('sale_price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select class="form-control" id="inputName" name="category_id">
                    @foreach($categories as $item)
                    <option value="{{$item->id}}" default>{{$item->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ảnh đại diện</label>
            <input type="file" class="form-control " name="file" id="" aria-describedby="helpId">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ảnh mô tả</label>
            <input type="file" class="form-control " name="files[]" multiple id="" aria-describedby="helpId">
            @error('files')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mô tả</label>
            <input type="text" class="form-control" name="content" id="" aria-describedby="helpId" value="{{old('content')}}">
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Chi tiết</label>
            <textarea type="text" class="form-control" name="description" id="description" aria-describedby="helpId" value="{{old('description')}}">
            </textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mã sản phẩm</label>
            <input type="text" class="form-control" name="shoe_code" id="" aria-describedby="helpId" value="{{old('shoe_code')}}">
            @error('shoe_code')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Trạng thái</label> <br>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="status" id="status" value="0">
                    Ẩn
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="status" id="status" value="1" checked="checked">
                    Hiện
                </label>
            </div>
        </div>


<button type="submit" class="btn btn-primary">Thực hiện</button>
<a class="btn btn-warning" href="{{route('admin.product.index')}}">Quay lại</a>

</form>

</div>
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    function ChangeToSlug() {
        var title, slug;

        //Lấy text từ thẻ input title 
        title = document.getElementById("name").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>
@stop