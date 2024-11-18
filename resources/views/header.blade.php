

 <!-- Header -->
 <header class="bg-main text-main py-1">
        <div class="container d-flex justify-content-between align-items-center my-2">
            <!-- Logo -->
            <a href="/">
                <img class="img-fluid py-md-2 w-md-75 w-50" src="/template/assets/img/logo.png" alt="">
            </a>

            <!-- Search Form (hidden on mobile) -->
            <div class="col-md-5 my-auto">
                <form id="search-form" action="{{ url('/tim-kiem') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search_product" id="search_text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" name="searchbtn" class="input-group-text" id="basic-addon2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Account and Cart (Icons only on mobile) -->
            <div class="d-flex">
                <a href="/tai-khoan/lich-su-mua-hang" class="text-white btn btn-main me-2 fs-5 fs-md-6">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span class="d-none d-md-inline ms-2">Đơn hàng</span>
                </a>
                <a href="/tai-khoan" class="text-white btn btn-main me-2 fs-5 fs-md-6">
                    <i class="fs-5 fs-md-6  fa-solid fa-user"></i>
                    <span class="d-none d-md-inline ms-2">Tài khoản</span>
                </a>
                <div class="btn-cart position-relative">
                    <a class="text-white btn btn-main fs-5 fs-md-6" href="/carts" >
                        <div class="icon-header-item cl2 hov-cl1 trans-04 icon-header-noti js-show-cart"
                            data-notify="{{ !is_null(\Session::get('GioHang')) ? count(\Session::get('GioHang')) : 0 }}">
                            <i class="fs-5 mt-1 mt-md-0 fs-md-6 fa-solid fa-cart-shopping"></i>
                            <span class="d-none d-md-inline ms-2 ">Giỏ hàng</span>
                        </div>
                    </a>
                    <div class="cart-popup bg-white text-dark ps-3 py-3 rounded-2 text-end">
                        <h6 class="text-muted text-start pb-2">Sản phẩm mới thêm</h6>
                        <!-- cart item list -->
                        <ul class="cart-item-list p-0 m-0 pe-2">
                        @if (count($sanphamgiohangs) > 0)
                            @foreach($sanphamgiohangs as $key => $sanphamgiohang)
                        @php
                            $Gia = \App\Helper\Helper::Gia($sanphamgiohang->Gia, $sanphamgiohang->GiamGia);

                        @endphp
                            <!-- cart item -->
                            <li class="cart-item d-flex align-items-start mb-4">
                                <img class="img-fluid w-15" src="{{ $sanphamgiohang->thumb }}" alt="img">
                                <div class="mx-3 flex-fill">
                                    <h6 class="text-start">{{ $sanphamgiohang->name }}</h6>
                                </div>
                                <span class="text-main price" style="position: relative; top: -2px;" > {!! $Gia !!}</span>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                        <a href="/carts" class="btn btn-main-hover me-4">Xem giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Search Form (visible on mobile) -->
        <form class="d-flex d-md-none px-3 mb-3 align-items-center">
            <!-- Mobile Menu Button (Hamburger) -->
            <button class="btn btn-main d-md-none me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fs-2 fa-solid fa-bars"></i>
            </button>
            <input class="form-control me-2 search-bar py-3 fs-5" type="search"
                placeholder="Tìm kiếm hơn 10000 sản phẩm đồ chơi..." aria-label="Search">
            <button class="btn text-white btn-main"><i class="fs-3 fa-solid fa-magnifying-glass"></i></button>
        </form>

        <!-- Nav (Desktop and Mobile) -->
        <nav class="border-top pt-3">
            <!-- Desktop Menu -->
            <ul class="nav container d-none d-md-flex justify-content-between align-items-center">
                <li class="nav-item h5 fw-bolder"><a href="/" class="nav-link text-white capitalize">Trang
                        chủ</a></li>
                <li class="nav-item h5 fw-bolder"><a href="/san-pham"
                        class="nav-link text-white capitalize">Sản phẩm</a></li>
                <li class="nav-item h5 fw-bolder"><a href="/san-pham-khuyen-mai" class="nav-link text-white capitalize">Khuyến mại</a></li>
                <li class="nav-item h5 fw-bolder"><a href="/thuong-hieu" class="nav-link text-white capitalize">Thương hiệu</a>
                </li>
                <li class="nav-item h5 fw-bolder"><a href="/tin-tuc" class="nav-link text-white capitalize">Tin tức</a></li>
            </ul>

            <!-- Mobile Menu (Collapsible) -->
            <div class="collapse d-md-none" id="mobileMenu">
                <ul class="nav flex-column text-center">
                    <li class="nav-item h4 fw-bolder"><a href="./index.html"
                            class="nav-link text-white capitalize">Trang chủ</a>
                    </li>
                    <li class="nav-item h4 fw-bolder"><a href="./product-list.html"
                            class="nav-link text-white capitalize">Sản phẩm</a>
                    </li>
                    <li class="nav-item h4 fw-bolder"><a href="#" class="nav-link text-white capitalize">Khuyến mại</a>
                    </li>
                    <li class="nav-item h4 fw-bolder"><a href="#" class="nav-link text-white capitalize">Thương hiệu</a>
                    </li>
                    <li class="nav-item h4 fw-bolder"><a href="#" class="nav-link text-white capitalize">Cẩm nang</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</header> 
