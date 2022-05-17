@extends('admin.master')
@section('content')
<div class="container">
    <form action="{{route('orderDetail',$id)}}" method="POST">
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
                    <th class="min-w-20px">ID</th>
                    <th class="min-w-40px">product_id</th>
                    <th class="min-w-40px">color_id</th>
                    <th class="min-w-40px">size_id</th>
                    <th class="min-w-40px">quantity</th>
                    <th class="min-w-40px">price</th>
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
                    <td></td>
                    <td></td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format(($item->product->price) - ($item->product->sale_price))}} vnd</td>
                </tr>
                @endforeach
            </tbody>

            <!--end::Table body-->
        </table>
    </div>
    <h3>Tổng tiền: {{number_format($total)}} vnd</h3>

</div>
@stop