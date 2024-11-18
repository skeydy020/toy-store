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
                @foreach($sanphamgiamgias as $key => $sanphamgiamgia)
                <div class="col">
                    <a href="/san-pham/{{ $sanphamgiamgia->id }}-{{ Str::slug($sanphamgiamgia->name, '-') }}">
                        <div class="card h-100">
                            <img src="{{ $sanphamgiamgia->thumb }}" class="card-img-top" alt="Toy 1">
                            <div class="card-body">
                                <h5 class="card-title two-line-text-overflow"> {{ $sanphamgiamgia->name }}</h5>
                                <div class="mb-2 mt-3 text-start">
                                   
                                 
                                    <span class="price-regular">{{ number_format($sanphamgiamgia->Gia, 0, '', '.') }}</span>
                                    <span class="price-onsale fs-5"> {{ number_format($sanphamgiamgia->GiamGia, 0, '', '.') }}</span>
                                  
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="/add-cart/{{ $sanphamgiamgia->id }}" class="btn btn-main-hover add-to-cart-btn capitalize flex-fill">Thêm vào
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
                <div class="card-footer clearfix">
                {!! $sanphamgiamgias->links() !!}
            </div>  
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="./script.js"></script>

    @endsection