@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên người dùng</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">email</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                </div>
               
            </div>
            <div class="form-group">
                            <label for="menu">Ảnh Đại Diện</label>
                            <input type="file"  class="form-control" id="upload">
                            <div id="image_show">
                                <a href="{{ $user->thumb }}">
                                    <img src="{{ $user->thumb }}" width="100px">
                                </a>
                            </div>
                            <input type="hidden" name="thumb" value="{{ $user->thumb }}" id="thumb">
                        </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Mật khẩu</label>
                        <input type="password" name="password" value="{{ $user->password }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Số điện thoại</label>
                        <input type="text" name="SDT" value="{{ $user->SDT }}" class="form-control">
                    </div>
                </div>

                <div class="gender-selection" style="display: flex; align-items: center; gap: 10px;">
                <label>Giới tính:</label>
                <input type="radio" id="male" name="GioiTinh" value="Nam" <?php if ($user->GioiTinh == 'Nam') echo 'checked'; ?>>
                <label for="male">Nam</label>

                <input type="radio" id="female" name="GioiTinh" value="Nữ" <?php if ($user->GioiTinh  == 'Nữ') echo 'checked'; ?>>
                <label for="female">Nữ</label>

                <input type="radio" id="other" name="GioiTinh" value="Khác" <?php if ($user->GioiTinh  == 'Khác') echo 'checked'; ?>>
                <label for="other">Khác</label>
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="DiaChi" class="form-control">{{ $user->DiaChi }}</textarea>
            </div>

       
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
        </div>
        @csrf
    </form>
@endsection

