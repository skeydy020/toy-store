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
                        <label for="menu">Mã code sản phẩm</label>
                        <input type="text" name="Code" value="{{ old('Code') }}" class="form-control"  placeholder="Nhập mã code sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên bài hát">
                    </div>
                </div>
            <div class="form-group">
                <label for="menu">Ảnh bìa bài hát</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>
            </div>

            <div class="form-group">
                <label>Mô Tả Sản Phẩm</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
           

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Gốc</label>
                        <input type="number" name="Gia" value="{{ old('Gia') }}"  class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Giảm</label>
                        <input type="number" name="GiamGia" value="{{ old('GiamGia') }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Thương Hiệu</label>
                        <select class="form-control" name="thuonghieu_id">
                            @foreach($thuonghieus as $thuonghieu)
                                <option value="{{ $thuonghieu->id }}">{{ $thuonghieu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giới tính phù hợp</label>
                        <select class="form-control" name="gioitinh_id">
                        
                            @foreach($gioitinhs as $gioitinh)
                                <option value="{{ $gioitinh->id }}">{{ $gioitinh->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Độ tuổi phù hợp</label>
                        <select class="form-control" name="dotuoi_id">
                        
                            @foreach($dotuois as $dotuoi)
                                <option value="{{ $dotuoi->id }}">{{ $dotuoi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Xuất xứ</label>
                        <select class="form-control" name="xuatxu_id">
                        
                            @foreach($xuatxus as $xuatxu)
                                <option value="{{ $xuatxu->id }}">{{ $xuatxu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>   

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Số lượng</label>
                        <input type="number" name="SoLuong" value="{{ old('SoLuong') }}"  class="form-control" >
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            </div>
           
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
