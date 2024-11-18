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
             <ul class="list list-inline mb-0 brand-list" style="max-height: 300px; overflow-y: auto;">
					@foreach($brandCounts as $brandId => $brandData)
                    <li><label><input type="checkbox" name="brand_id" value="{{ $brandId }}" 
                    @if(in_array( $brandId,explode(',',$f_brands))) checked="checked" @endif > {{$brandData['name']}} ( {{$brandData['count']}} )</label>
                   <br><li>
                 
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
                 <center>
        {{ $sanphams->links('vendor.pagination.bootstrap-4') }}
    </center>

            </div>
            
        </div>

    </div>
    

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./script.js"></script>

    @endsection

 
    
