@extends('main')

@section('content')

<div class="container py-5">
        <div class="row">
        <div class="col-md-3">
            @include('sanphams.sidebar')
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
                                <div class="mb-2 mt-3 text-start">
                                   
                                    @if ($sanpham->GiamGia  >0)
                                    <span class="price-regular"> {{ $sanpham->Gia }}</span>
                                    <span class="price-onsale fs-5"> {{ $sanpham->GiamGia }}</span>
                                    @elseif($sanpham->GiamGia  <1 )
                                    <span class="price-onsale fs-5"> {{ $sanpham->Gia }}</span>
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
                <div class="card-footer clearfix">
        {!! $sanphams->links() !!}
    </div>  
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="./script.js"></script>

    @endsection