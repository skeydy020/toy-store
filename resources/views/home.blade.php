@extends('main')

@section('content')


<div id="carouselExample" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($sliders as $index => $slider)
        <a href="{{ $slider->url }}" class="carousel-item {{ $index == 0 ? 'active' : '' }}"
            style="height: 400px; background: url('{{ $slider->thumb }}') center center / contain no-repeat;">
            <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
                <!-- <h2 class="text-white mb-4">{{ $slider->name }}</h2> -->
                <!-- <button 
                    onclick="location.href='{{ $slider->url }}'" 
                    class="btn btn-primary"
                    style="background-color: #fc4100; border: none;">
                    Xem ngay
                </button> -->
            </div>
        </a>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <i class="fa-solid fa-chevron-left text-dark fs-5"></i>
        <!-- <span class="">Previous</span> -->
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <i class="fa-solid fa-chevron-right text-dark fs-5"></i>
        <!-- <span class="">Next</span> -->
    </button>
</div>

<!-- Top Product Section -->
<section class="py-md-4 py-2">
    <div class="container position-relative mt-md-5 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-md-5 mb-3">
            <h1 class="capitalize text-second fs-3 fs-md-1">Top sản phẩm giảm giá</h1>
            <a href="/san-pham-khuyen-mai" class="btn btn-link text-main fs-4 fw-bold text-decoration-none">
                    Xem Tất cả &rarr;
            </a>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach($sanphamgiamgias as $key => $sanphamgiamgia)
            <div class="col">
                <a href="/san-pham/{{ $sanphamgiamgia->id }}-{{ Str::slug($sanphamgiamgia->name, '-') }}">
                    <div class="card h-100">
                        <img src="{{ $sanphamgiamgia->thumb }}" class="card-img-top" alt="Toy 1">
                        @php
                        $phanTramGiam = round((($sanphamgiamgia->Gia -$sanphamgiamgia->GiamGia) / $sanphamgiamgia->Gia)
                        * 100);
                        @endphp
                        <span class="discount-badge">-{{ $phanTramGiam }}%</span>
                        <div class="card-body">
                            <h5 class="card-title two-line-text-overflow">{{ $sanphamgiamgia->name }}</h5>
                            <div class="mb-2 mt-3 text-start">
                                <span class="price-regular">{{ number_format($sanphamgiamgia->Gia, 0, '', '.') }}</span>
                                <span class="price-onsale fs-5">{{ number_format($sanphamgiamgia->GiamGia, 0, '', '.') }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="/add-cart/{{ $sanphamgiamgia->id }}"
                                    class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">Thêm vào
                                    giỏ hàng</a>
                                <button class="btn btn-favorite"><i
                                        class="fa-regular fa-heart text-main fs-3"></i></button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
</section>

<!-- Product Section -->
<section class="py-md-4 py-2 mt-3">
    <div class="container position-relative mt-md-5 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-md-5 mb-3">
            <h1 class="capitalize text-second fs-3 fs-md-1">Sản phẩm nổi bật</h1>
            <a href="/san-pham" class="btn btn-link text-main fs-4 fw-bold text-decoration-none">
                    Xem Tất cả &rarr;
            </a>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach($sanphams as $key => $sanpham)
            <div class="col">
                <a href="/san-pham/{{ $sanpham->id }}-{{ Str::slug($sanpham->name, '-') }}">
                    <div class="card h-100">
                        <img src="{{ $sanpham->thumb }}" class="card-img-top" alt="Toy 1">
                        <div class="card-body">
                            <h5 class="card-title two-line-text-overflow"> {{ $sanpham->name }}</h5>
                            <div class=" mb-2 mt-3 text-start">

                                @if ($sanpham->GiamGia >0)
                                <span class="price-regular"> {{ number_format($sanpham->Gia, 0, '', '.') }}</span>
                                <span class="price-onsale fs-5"> {{ number_format($sanpham->GiamGia, 0, '', '.') }}</span>
                                @elseif($sanpham->GiamGia <1 ) <span class="price-onsale fs-5"> {{ number_format($sanpham->Gia, 0, '', '.') }}
                                </span>
                                    @endif
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="/add-cart/{{ $sanpham->id }}"
                                    class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">Thêm vào
                                    giỏ hàng</a>
                                <button class="btn btn-favorite"><i
                                        class="fa-regular fa-heart text-main fs-3"></i></button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Category Section -->
<section class="py-md-4 py-2">
    <div class="container position-relative mt-md-5 mt-5">
        <h1 class="mb-md-5 mb-3 capitalize text-second fs-3 fs-md-1">Danh mục sản phẩm nổi bật</h1>
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($menus as $key => $menu)
            <div class="col">
                <a href="/danh-muc/{{ $menu->id }}-{{ Str::slug($menu->name, '-') }}">
                    <div class="d-flex flex-column h-100">
                        <img src="{{ $menu->thumb }}" class="card-no-border rounded border" alt="">
                        <h3 class="capitalize py-3 text-center fs-5 fs-md-4"> {{ $menu->name }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Brand Section -->
<section class="py-md-4 py-2 mt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-md-5 mb-4 ">
            <h1 class="capitalize text-second fs-3 fs-md-1">Thương hiệu nổi bật</h1>
            <a href="/thuong-hieu"> <button class="btn text-main fs-4 fw-bold btn-nohover">Xem thêm &#8594;</button></a>
        </div>
        <div class="row row-cols-2 row-cols-md-5 mb-4">
            @foreach($thuonghieus->take(10) as $key => $thuonghieu)
            <a href="" class="col mb-4">
                <img class="card-no-border img-fluid border rounded" src="{{ $thuonghieu->thumb }}" alt="thương hiệu">
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Blog Section -->
<section id="blogs" class="bg-light py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="text-second fs-3 fs-md-1">Tin Tức</h1>
                <a href="/tin-tuc" class="btn btn-link text-main fs-4 fw-bold text-decoration-none">
                    Xem Tất cả &rarr;
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($tintucs->take(3) as $key => $tintuc)
            <div class="col">
                <div class="card shadow-sm h-100 bg-body rounded-4">
                    <a href="{{ route('tin-tuc.chi-tiet', 'id=' . $tintuc->id) }}">
                        <img src="{{ $tintuc->thumb }}" class="card-img-top img-fluid rounded-top" alt="image">
                    </a>
                    <div class="card-body">
                        <a href="{{ route('tin-tuc.chi-tiet', 'id=' . $tintuc->id) }}" class="text-decoration-none">
                        <h5 class="pt-4 pb-3 m-0">{{ $tintuc->name }}</h5>
                        </a>
                        <p class="card-text fs-6 text-muted">{{ $tintuc->description }}</p>
                        <a href="{{ route('tin-tuc.chi-tiet', 'id=' . $tintuc->id) }}"
                           class="text-main fw-bold text-decoration-underline fs-6">Đọc tiếp</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Insta section -->
<section id="insta" class="my-3 my-md-5">
    <div class="row row-cols-3 row-cols-md-6 g-0 py-5">
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta1.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta2.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta3.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta4.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta5.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
        <div class="col text-center position-relative">
            <div class="position-absolute top-50 start-50 translate-middle">
                <iconify-icon class="text-white" icon="la:instagram"></iconify-icon>
            </div>
            <a href="#">
                <img src="/template/assets/img/insta/insta6.jpg" alt="insta-img" class="img-fluid rounded-3">
            </a>
        </div>
    </div>
</section>


@endsection