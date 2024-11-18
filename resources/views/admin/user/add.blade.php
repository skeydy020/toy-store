@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên người dùng</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">email</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
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
            <div class="form-group">
                <label>Mật khẩu</label>
                <textarea name="password" id="password" class="form-control">{{ old('password') }}</textarea>
            </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Số điện thoại</label>
                        <input type="text" name="SDT" value="{{ old('SDT') }}" class="form-control">
                    </div>
                </div>
                <div class="gender-selection" style="display: flex; align-items: center;">
                  <label>Giới tính:  </label>
                  <input type="radio" id="male" name="GioiTinh" value="Nam">
                  <label for="male">Nam     </label>

                  <input type="radio" id="female" name="GioiTinh" value="Nữ">
                  <label for="female">Nữ     </label>

                  <input type="radio" id="other" name="GioiTinh" value="Khác">
                  <label for="other">Khác     </label>
              </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="DiaChi" id="DiaChi" class="form-control">{{ old('DiaChi') }}</textarea>
            </div>

           

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm người dùng</button>
        </div>
        @csrf
    </form>
@endsection

