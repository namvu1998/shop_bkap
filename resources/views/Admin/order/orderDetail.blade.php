@extends('admin.master')
@section('content')
<div class="container">

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