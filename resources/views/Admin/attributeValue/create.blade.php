@extends('admin.master')
@section('content')
<div class="container">
    
    <form action="{{route('admin.attributeValue.create')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên thuộc tính</label>
                <select class="form-control" id="inputName" name="name">
                    <option value="color">Màu sắc</option>
                    <option value="size">Size</option>
                </select>
            </div>

            <div class="hung">
                <div class="mb-3 value1">
                    <label class="form-label">Giá trị</label>
                    <input type="color" name="value[]" id="" class="form-control v1">
                </div>
                <div class="mb-3 value2" style="display: none;">
                    <label class="form-label">Giá trị</label>
                    <input type="text" name="" value="" id="" class="form-control v2 @error('value') is-invalid @enderror">
                    @error('value')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button class="add-input btn btn-success" type="button"><i class="fa fa-fw fa-plus"></i></button>
            <button class="remove-input btn btn-danger" type="button"><i class="fa fa-fw fa-minus"></i></button>
            <br>
            <br>
            <button type="submit" class="btn btn-primary" id="btn-attr">Thực hiện</button>
            <a class="btn btn-warning" href="{{route('admin.attributeValue.index')}}">Quay lại</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var _ip = $('#inputName').val();

     $('#inputName').change(function(event) {
        var _ip = $('#inputName').val();
        if (_ip == 'size') {
            $('.value2').show();
            $('.v2').each(function() {
                $(this).attr({
                    name: 'value[]',
                });
            })
            $('.value1').hide();
            $('.value1-new').each(function() {
                $(this).remove()
            })
            $('.v1').each(function() {
                $(this).attr({
                    name: '',
                });
            })
        } else {
            $('.value1').show();
            $('.v1').each(function() {
                $(this).attr({
                    name: 'value[]',
                });
            })
            $('.value2').hide();
            $('.value2-new').each(function() {
                $(this).remove()
            })
            $('.v2').each(function() {
                $(this).attr({
                    name: '',
                });
            })
        }
        checkRemoveInput()
    });

    $('.add-input').click(function (){
         var _ip = $('#inputName').val();
         var html = ''
         if (_ip =='size'){
            html = `
                <div class="mb-3 value2-new">
                    <label class="form-label">Giá trị</label>
                    <input type="text" name="value[]" value="" id="" class="form-control v2 @error('value') is-invalid @enderror">
                    @error('value')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>`
         } else {
            html = `
                <div class="mb-3 value1-new">
                    <label class="form-label">Giá trị</label>
                    <input type="color" name="value[]" id="" class="form-control v1">
                </div>
                `
         }
         $('.hung').append(html)
         checkRemoveInput()
    })
    $('.remove-input').hide()
    $('.remove-input').click(function (){
        $('.hung').children().last().remove()
        checkRemoveInput()
    })

    function checkRemoveInput() {
        if (!$('.value1-new, .value2-new').length){
            $('.remove-input').hide()
        }else {
            $('.remove-input').show()
        }
    }

</script>

@stop