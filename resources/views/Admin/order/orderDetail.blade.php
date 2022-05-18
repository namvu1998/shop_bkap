@extends('admin.master')
@section('content')
<div class="container">
    <form action="{{route('orderDetail',$id)}}" method="POST">
        <h3>Trạng thái đơn hàng</h3>
        @csrf
        <select name="status" id="" >
            <option value="1" {{$order->status == '1' ? 'selected' : ''}}>Đang sửa lý</option>
            <option value="2" {{$order->status == '2' ? 'selected' : ''}}>Đã sử lý</option>
            <option value="3" {{$order->status == '3' ? 'selected' : ''}}>Đang giao hàng</option>
            <option value="4" {{$order->status == '4' ? 'selected' : ''}}>Hoàn thành</option>
            <option value="5" {{$order->status == '5' ? 'selected' : ''}}>Hoàn trả</option>
        </select>
        <button type="submit">Thay đổi</button> 
    </form>
    <br>
    <br>
    @if(Session::has('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{Session::get('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div id="table_data">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bolder text-muted">
                    <th class="min-w-20px">STT</th>
                    <th class="min-w-40px">Sản phẩm</th>
                    <th class="min-w-40px">Màu</th>
                    <th class="min-w-40px">Size</th>
                    <th class="min-w-40px">Số lượng</th>
                    <th class="min-w-40px">Giá</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
                @php
                $total = 0;
                @endphp
                @foreach ($order->orderDetail as $item)
                @php
                $total += $item->quantity * (($item->product->price) - ($item->product->sale_price));
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->product->name}}</td>
                    <td>     
                        <div class="box-color" style="background:{{$item->color_id}}"></div>   
                    </td>
                    <td>{{$item->size_id}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format((($item->product->price) - ($item->product->sale_price))*($item->quantity))}} vnd</td>
                </tr>
                @endforeach
            </tbody>

            <!--end::Table body-->
        </table>
    </div>
    <h3>Tổng tiền: {{number_format($total)}} vnd</h3>

</div>
@stop