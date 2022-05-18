<div class="container">

    <div id="table_data">

        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">

                <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">
                    Thêm mới
                </a>
                <form class="d-flex">
                    <input class="form-control me-2" name="key" type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <input class="btn btn-outline-success" value="Tìm" type="submit">
                </form>
            </div>
        </nav>
        @if(Session::has('success'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{Session::get('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bolder text-muted">
                    <th class="min-w-20px">Stt</th>
                    <th class="min-w-40px">Tên SP</th>
                    <th class="min-w-40px">MSP</th>
                    <th class="min-w-40px">Giá</th>
                    <th class="min-w-40px">KM</th>
                    <th class="min-w-40px">Mô tả</th>
                    <th class="min-w-40px">Chi tiết</th>
                    <th class="min-w-40px">Ảnh</th>
                    <th class="min-w-40px">Trạng thái</th>
                    <th class="min-w-20px">Chỉnh sửa</th>
                    <th class="min-w-40px">Biến thể</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>

                @foreach ($products as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->shoe_code}}</td>
                    <td>{{number_format($item->price)}}</td>
                    <td>{{number_format($item->sale_price)}}</td>
                    <td>{{$item->content}}</td>
                    <td>{!! $item->description !!}</td>
                    <td><img src="{{ asset('uploads/' . $item->image) }}" height="80" width="80" /></td>
                    @if($item->status == 1)
                    <td><a class="btn-status btn btn-primary text-btn" href="{{route('product.unactive', $item->id)}}">Hiện</a></td>
                    @else
                    <td><a class="btn-status btn btn-secondary text-btn" href="{{route('product.active', $item->id)}}">Ẩn</a></td>
                    @endif
                    <style>
                        .btn-status {
                            width: 100px !important;
                        }

                        .text-btn {
                            color: black !important;
                        }
                    </style>
                    <td>
                        <a href="{{route('admin.product.edit',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                        <a onclick="return confirm('Xóa?')" href="{{route('admin.product.delete', $item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                            <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                    </td>
                    <td><a class="btn btn-primary text-btn" href="{{route('admin.product.detail', $item->id)}}">BT</a></td>
                </tr>
                @endforeach
            </tbody>
            <!--end::Table body-->
        </table>
        {{-- @dd($products->links()) --}}
        {{$products->links()}}
    </div>

</div>