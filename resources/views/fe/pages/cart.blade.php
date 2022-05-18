@extends('fe.master')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->
@if(Session::has('success'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>{{Session::get('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Giỏ hàng của bạn</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="{{route('UpdateCart')}}" method="POST">
                    @csrf
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>Tổng giá</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sub_total = 0 ?>
                               
                                @foreach($cart->items as $key => $product)
                               
                                <input type="hidden" name="product_id[]" value="{{$product['id']}}">
                                <?php $total = ($product['price'] - $product['sale_price']) * $product['quantity'] ?>
                                <?php $sub_total += $total ?>
                                <td>{{$loop->iteration}}</td>
                                <td class="product-thumbnail">
                                    <a href="{{route('product.detail',$product['id'])}}"><img class="img-responsive ml-15px" src="{{asset('uploads/' . $product['image'])}}" alt="" /></a>
                                </td>
                                <td class="product-name"><a href="#">{{$product['name']}}</a></td>
                                <td class="product-price-cart"><span class="amount">
                                        {{$product['price']}} vnd
                                    </span></td>
                                <td class="product-quantity">
                                    <div class="cart-plus-minus">
                                
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton[]" value="{{$product['quantity']}}" />
                                    </div>
                                </td>
                                <td>
                                    <div class="box-color" style="margin: auto;background:{{$product['color']}}"></div>
                                </td>
                                <td> {{$product['size']}}</td>
                                <td>{{number_format($total)}} vnd</td>
                               
                                <td class="product-remove">
                                    {{-- <a href="{{route('UpdateCart',$product['id'])}}"><i class="fa fa-pencil"></i></a> --}}
                                    <a href="{{route('DeleteCart',$key)}}"><i class="fa fa-times"></i></a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"><br>
                            {{-- <h4>Tong tien: {{number_format($sub_total)}} vnd</h4> --}}
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{route('shop')}}">Quay lại cửa hàng</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit">Update giỏ hàng</button>
                                    <a href="{{route('Clear')}}">Xóa hết giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    {{-- <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Mã khuyến mãi</h4>
                            </div>
                            <div class="discount-code">
                                <p>Nhập giá khuyến mãi nếu có</p>
                                <form>
                                    <input type="text" required="" name="name" />
                                    <button class="cart-btn-2" type="submit">Áp dụng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Đơn hàng</h4>
                            </div>
                            @foreach($cart->items as $key => $product)
                            <?php $total = ($product['price'] - $product['sale_price']) * $product['quantity'] ?>
                            <h5 style="display: flex;justify-content: space-between" >
                                <div style="width: 50% ;display: flex">{{$product['name']}} : <div class="box-color-1" style="background:{{$product['color']}}"></div> {{$product['size']}}</div> 
                                <span>{{number_format($total)}} vnd </span>
                            </h5>
                            @endforeach
                            {{-- <div class="total-shipping">
                                <h5>Total shipping</h5>
                                    <ul>
                                        <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                        <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                    </ul>
                            
                               
                            </div> --}}
                            <h4 class="grand-totall-title">Tổng giá <span>{{number_format($sub_total)}} vnd</span></h4>
                            <a href="{{route('checkout')}}">Đến thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->
@stop