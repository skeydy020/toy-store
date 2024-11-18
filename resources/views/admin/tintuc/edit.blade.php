@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu Đề</label>
                        <input type="text" name="name" value="{{ $tintuc->name }}" class="form-control">
                    </div>
                </div>
               
            </div>

            <div class="form-group">
                <label for="menu">Ảnh bìa</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $tintuc->thumb }}">
                        <img src="{{ $tintuc->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $tintuc->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="description" class="form-control">{{ $tintuc->description }}</textarea>
            </div>

            <div class="form-group">
                        <label>Danh mục tin tức</label>
                        <select class="form-control" name="danhmuc_id">
                            @foreach($danhmuctins as $danhmuctin)
                                <option value="{{ $danhmuctin->id }}" {{ $tintuc->danhmuc_id == $danhmuctin->id ? 'selected' : '' }}>
                                    {{ $danhmuctin->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

           
            
            <div class="form-group">
                <label>Mô tả chi tiết </label>
                <textarea name="content" class="form-control">{{ $tintuc->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $tintuc->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $tintuc->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật độ tuổi</button>
        </div>
        @csrf
    </form>
@endsection


@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection