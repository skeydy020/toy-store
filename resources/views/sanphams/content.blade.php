@extends('main')
@section('content')
<div class="container py-5">
        <div class="row row-cols-1">
        <div class="col-md-7">
                <div class="main-image">
                    <img class="img-fluid" id="mainImage" src="{{ $sanpham->thumb }}" alt="Main Product Image">
                    <div id="magnifier"></div>
                </div>
                <div class="row preview-images ">
                    <button class="col img-btn shadow p-3 mb-5 bg-body rounded mx-2" onclick="changeImage(this)"><img class="img-fluid" src="{{ $sanpham->thumb }}" alt=""></button>
                    @foreach($anhs as $key => $anh)
                    <button class="col img-btn shadow p-3 mb-5 bg-body rounded mx-2" onclick="changeImage(this)"><img class="img-fluid" src="{{ $anh->thumb }}" alt=""></button>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5">
                <h4 class="text-second">{{ $sanpham->name }}</h4>

                <div class="d-flex pt-4">
                    <p class="me-3">Thương hiệu</p>
                    <div class=" flex-fill"><a class="text-primary text-decoration-underline" href="">{{ $sanpham->DanhMuc->name }}</a></div>
                    <p class="id align-self-end">{{ $sanpham->Code }}</p>
                </div>
                <div class="prices d-flex align-items-center pb-4">
                    <p class="m-0 me-4">Giá bán</p>
                    <div class="d-flex align-items-center flex-fill">
                        @if ($sanpham->GiamGia  >0)
                            <span class="price-regular me-2"> {{ number_format($sanpham->Gia, 0, '', '.') }}</span>
                            <span class="price-onsale fs-5"> {{ number_format($sanpham->GiamGia, 0, '', '.') }}</span>
                        @php
                            $phanTramGiam = round((($sanpham->Gia -$sanpham->GiamGia) / $sanpham->Gia) * 100);
                        @endphp
                    </div>
                    <div class="">
                        <span class="discount-badge-inline float-end">-{{ $phanTramGiam }}%</span>
                            @elseif($sanpham->GiamGia  <1 )
                                <span class="price-onsale fs-5"> {{ $sanpham->Gia }}</span>
                            @endif
                    </div>
                            
                    
                    
            
                </div>
                <div class="">
                    <li class="py-2 d-flex align-items-center"><i class="fa-solid fa-check me-3 fs-5"></i><span
                            class="fs-6">Hàng chính hãng</span></li>
                    <li class="py-2 d-flex align-items-center"><i class="fa-solid fa-check me-3 fs-5"></i><span
                            class="fs-6">Miễn phí giao hàng toàn quốc đơn trên 500k</span></li>
                    <li class="py-2 d-flex align-items-center"><i class="fa-solid fa-check me-3 fs-5"></i><span
                            class="fs-6">Giao hàng hỏa tốc 4 tiếng</span></li>
                </div>

                
                <form action="/add-cart" method="post">
                    @if ($sanpham->Gia !== NULL)
                        <label for="SoLuong" class="py-4 h5 fw-600">Số lượng</label>
                        <div class="d-flex">
                            <div class="d-flex align-items-center bg-light-gray rounded me-5 p-0">
                                <button class="btn-custom px-4 decrement fs-3" type="button">-</button>
                                <input class="text-center fw-500 quantityDisplay num-product rounded border" style="width:100px;" type="number" name="SoLuong" value="1">
                                <button class="btn-custom px-4 increment fs-3" type="button">+</button>
                            </div>
                            <button type="submit"
                                class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                        <input type="hidden" name="sanpham_id" value="{{ $sanpham->id }}">
                    @endif
                    @csrf
                </form>
                                
                <div class="infor mt-5">
                    <h5 class="mb-4">Thông tin sản phẩm</h5>
                    <div class="item row mb-3">
                        <div class="col title">Xuất xứ</div>
                        <div class="col content">{{ $sanpham->XuatXu->name }}</div>
                    </div>
                    <div class="item row mb-3">
                        <div class="col title">Giới tính</div>
                        <div class="col content">{{ $sanpham->GioiTinh->name }}</div>
                    </div>
                    <div class="item row mb-3">
                        <div class="col title">Độ tuổi</div>
                        <div class="col content">{{ $sanpham->DoTuoi->name }}</div>
                    </div>
                    <div class="item row mb-3">
                        <div class="col title">Thương hiệu</div>
                        <div class="col content">{{ $sanpham->ThuongHieu->name }}</div>
                    </div>
                </div>
            </div>
            <div class="col-full">
                <h4 class="my-3">Mô tả sản phẩm</h4>
                <h5>{!! $sanpham->description !!}</h5>
                <div class="desc text-justify mt-3">
                {!! $sanpham->content !!}
                </div>
            </div>



        </div>
    </div>
    <section class="py-md-4 py-2">
        <div class="container position-relative mt-md-5 mt-5">
            <div class="b-md-5 mb-5">
                <h1 class="capitalize text-second fs-3 fs-md-1 text-center">Sản phẩm tương tự</h1>
            </div>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @foreach($splienquans as $key => $splienquan)
                <div class="col">
                    <a href="/san-pham/{{ $splienquan->id }}-{{ Str::slug($splienquan->name, '-') }}">
                        <div class="card h-100">
                            <img src="{{ $splienquan->thumb }}" class="card-img-top" alt="Toy 1">
                            <div class="card-body">
                                <h5 class="card-title two-line-text-overflow "> {{ $splienquan->name }}</h5>
                                <div class="mb-2 mt-3 text-start">
                                   
                                    @if ($splienquan->GiamGia  >0)
                                    <span class=" price-regular">  {{ number_format($splienquan->Gia, 0, '', '.') }}</span>
                                    <span class=" price-onsale fs-5">  {{ number_format($splienquan->GiamGia, 0, '', '.') }}</span>
                                    @elseif($splienquan->GiamGia  <1 )
                                    <span class="price-onsale fs-5"> {{ number_format($splienquan->Gia, 0, '', '.') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="d-flex align-items-center">
                                    <a href="/add-cart/{{ $splienquan->id }}" class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">Thêm vào
                                        giỏ hàng</a>
                                    <button class="btn btn-favorite"><i
                                            class="fa-regular fa-heart text-main fs-3"></i></button>
                                </div> -->
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="d-flex"><a href="/san-pham" class="btn text-main mt-4 px-4 mx-auto fs-5 fw-bold btn-border">Xem thêm</a></div>
        </div>
    </section>
</div>
</div>

@endsection
