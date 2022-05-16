@extends('fe.master')
@section('content')
<style>
    .your-order-area .Place-order button {
        width: 100%;
        background-color: #fb5d5d;
        color: #fff;
        display: block;
        font-weight: 700;
        letter-spacing: 1px;
        line-height: 1;
        padding: 18px 20px;
        text-align: center;
        text-transform: uppercase;
        border-radius: 0;
        z-index: 9;
}
</style>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->


<!-- checkout area start -->
<form action="{{route('order.create')}}" method="POST">
    @csrf
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Chi tiết thanh toán</h3>
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="billing-info mb-4">
                                    <label>Họ tên</label>
                                    <input type="text" name="name" value="{{Auth::user()->name}}"/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Địa chỉ email</label>
                                    <input type="text" name="email" value="{{Auth::user()->email}}"/>
                                </div>
                            </div>
                        </div>                      
                        <div class="additional-info-wrap">
                            {{-- <h4>Additional information</h4> --}}
                            <div class="additional-info">
                                <label>Ghi chú đơn hàng</label>
                                <textarea placeholder="Ghi chú cho đơn hàng của bạn."
                                    name="note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Sản phẩm</li>
                                        <li>Giá</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        <?php $sub_total = 0 ?>
                                        @foreach($cart->items as $key => $product)
                                            <?php $price = $product['price'] - $product['sale_price'] ?>
                                            <?php $total = ($product['price'] - $product['sale_price']) * $product['quantity'] ?>
                                            <li><span class="order-middle-left">{{$product['name']}} X {{$product['quantity']}}</span> <span
                                                class="order-price">{{number_format($total)}} vnd</span></li>
                                            <?php $sub_total += $total ?>
                                            <input type="hidden" name="quantity[]" value="{{$product['quantity']}}"/>
                                            <input type="hidden" name="product_id[]" value="{{$product['id']}}"/>
                                            <input type="hidden" name="color_id[]" value="{{$product['color']}}"/>
                                            <input type="hidden" name="size_id[]" value="{{$product['size']}}"/>
                                            <input type="hidden" name="price[]" value="{{$price}}"/>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Giao hàng :</li>
                                        <li>Miễn phí giao hàng</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Tổng giá</li>
                                        <li> {{number_format($sub_total)}} vnd</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-3">Thanh toán khi nhận hàng</a></h4>
                                            </div>
                                            <div id="my-account-3" class="panel-collapse collapse"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button class="btn-hover" type="submit">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- checkout area end -->
@stop