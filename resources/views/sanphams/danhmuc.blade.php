@extends('main')

@section('content')

<div class="container py-5">
        <div class="row">
            <div class="col-md-3">
                @include('sanphams.sidebar')
                 <!-- Brand -->
                <div class="card mb-3">
                    <div class="card-header fs-6">
                            Thương hiệu
                    </div>
                    <ul class="my-2 ps-3" style="max-height: 294px; overflow-y: scroll">
                        @foreach($brandCounts as $brandId => $brandData)
                        <li class="py-1">
                            <label>
                                <input type="checkbox" name="brand_id" value="{{ $brandId }}" 
                                @if(in_array( $brandId,explode(',',$f_brands))) checked="checked" @endif > {{$brandData['name']}} ( {{$brandData['count']}} )
                            </label>
                        </li>
                        
                        @endforeach                                                                
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row row-cols-2 row-cols-md-3 g-4">
                @foreach($sanphams as $key => $sanpham)
                <div class="col">
                    <a href="/san-pham/{{ $sanpham->id }}-{{ Str::slug($sanpham->name, '-') }}">
                        <div class="card h-100">
                            <img src="{{ $sanpham->thumb }}" class="card-img-top" alt="Toy 1">
                            <div class="card-body">
                                <h5 class="card-title two-line-text-overflow"> {{ $sanpham->name }}</h5>
                                <div class="price mb-2 mt-3 text-start">
                                   
                                    @if ($sanpham->GiamGia  >0)
                                    <span class="price-regular"> {{ $sanpham->Gia }} Đ</span>
                                    <span class="price-onsale fs-5"> {{ $sanpham->GiamGia }} Đ</span>
                                    @elseif($sanpham->GiamGia  <1 )
                                    <span class="price-onsale fs-5"> {{ $sanpham->Gia }} Đ</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="/add-cart/{{ $sanpham->id }}" class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">Thêm vào
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
                <ul class="pagination mt-5 d-flex align-items-center justify-content-center">
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class=""><i class="fa-solid fa-chevron-left"></i></span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5 active">
                            <span class="">1</span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class="">2</span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class="">3</span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class="">4</span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class="">...</span>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">
                            <span class=""><i class="fa-solid fa-chevron-right"></i></span>
                        </a>
                    </li>
                </ul>   
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="./script.js"></script>

    @endsection