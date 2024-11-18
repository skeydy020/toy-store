@extends('main')

@section('css')
    <link rel="stylesheet" href="{{asset('static/css/news.css') }}">
    <link rel="stylesheet" href="{{asset('static/css/newsdetail.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            
        @include('tintuc.sidebar')
    
            <div class="col-md-8">
                <div class="container mt-4">
                    <!-- Tiêu đề bài viết -->
                    <div class="article-header">
                        <h1 class="text-second">{{ $tintuc->name }}</h1>
                        <p class="news-date">{{ $tintuc->updated_at->format('d.m.Y') }}</p>
                        <img src="{{ $tintuc->thumb }}" alt="News 1 Image" class="news-thumbnail">
                    </div>
            
                    <!-- Nội dung bài viết -->
                    <div class="article-content mt-4">
                        {!! $tintuc->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection