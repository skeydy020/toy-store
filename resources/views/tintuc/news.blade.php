@extends('main')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/news.css') }}">
@endsection

@section('content')
        
    <img class="banner-news" src="../assets/img/banner/news.png" alt="">

    <div class="filter-icon" id="filter-icon">
        <span>🔍 Bộ lọc</span>
    </div>
    
    <div class="container">
        <div class="row mt-4">
            <h2 class="text-center text-second capitalize">Cẩm nang đồ chơi cho trẻ</h1>
            @include('tintuc.sidebar')
        
            <div class="col-md-9"> 
                <div class="news-section mt-4">
                    @foreach ($tintucs as $tintuc)
                        <div class="news-item">
                            <img src="{{ $tintuc->thumb }}" alt="News 1 Image" class="news-thumbnail">
                            <div class="news-content">
                                <h6 class="news-title"><a href="{{ route('tin-tuc.chi-tiet', 'id=' . $tintuc->id) }}">{{ $tintuc->name }}</a></h6>
                                <p class="news-excerpt">{{ $tintuc->description }}</p>
                                <p class="news-date">{{ $tintuc->updated_at->format('d.m.Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <center>
        {{ $tintucs->links('vendor.pagination.bootstrap-4') }}
    </center>

    <script src="{{asset('static/js/news.js')}}"></script>
@endsection