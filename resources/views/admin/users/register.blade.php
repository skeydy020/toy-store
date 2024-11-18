
@extends('main')
@section('content')
  <!-- Login section -->
  <section>
        <div class="container py-5 mt-5">
            <h1 class="text-center text-second">Đăng ký</h1>
            @include('admin.alert')
            <form class="mt-4 w-50 mx-auto" action="/admin/users/login/register/store" method="post">
                <div class="mb-4">
                    <label for="name" class="form-label required fw-600">Họ và tên</label>
                    <input type="text" class="form-control border-2" name="name"
                        aria-describedby="emailHelp" required>
                </div>
                <div class="mb-4">
                    <label for="tel" class="form-label required fw-600">Số điện thoại</label>
                    <input type="tel" class="form-control border-2" name="SDT" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label required fw-600">Email</label>
                    <input type="email" class="form-control border-2" name="email" required>
                </div>
                <div class="mb-4">
                <div class="gender-selection" style="display: flex; align-items: center; gap: 10px;">
                  <label class="form-label required fw-600">Giới tính:  </label>
                  <input type="radio" id="male" name="GioiTinh"  value="Nam" required>
                  <label for="male">Nam     </label>

                  <input type="radio" id="female" name="GioiTinh" value="Nữ" required>
                  <label for="female">Nữ     </label>

                  <input type="radio" id="other" name="GioiTinh" value="Khác" required>
                  <label for="other">Khác     </label>
              </div></div>
                <div class="mb-4">
                    <label for="name" class="form-label required fw-600">DiaChi</label>
                    <input type="text" class="form-control border-2" name="DiaChi" required>
                </div>
                <div class="row row-cols-2 mb-4">
                    <div class="col">
                        <label for="password" class="form-label required fw-600">Mật khẩu</label>
                        <input type="password" class="form-control border-2" name="password" required>
                    </div>
                    <div class="col">
                        <label for="confirm-password" class="form-label required fw-600">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control border-2" name="confirm-password" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input border-1" type="checkbox" value="" id="" />
                        <label class="form-check-label fs-6" for=""> Tôi đã đọc và đồng ý với <a class="text-second" href="">Điều khoản sử dụng và chính sách của ToyStore</a> </label>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-main-hover d-block mx-auto px-4">Đăng ký</button>
                
        @csrf
            </form>
         
        </div>
        <div>
      <a style="display: flex; justify-content: center;" href="/admin/users/login" class="text-center">Tôi đã có tài khoản</a>
            </div>
    </section>


@endsection