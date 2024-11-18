
@extends('main')
@section('content')
<section>
        <div class="container py-5 mt-5">
            <h1 class="text-center text-second">Đăng nhập</h1>
            @include('admin.alert')
            <form class="mt-4 w-35 mx-auto"  action="/admin/users/login/store" method="post">
                <div class="mb-4">
                    <label for="email" class="form-label required fw-600">Email</label>
                    <input type="email" class="form-control border-2"  placeholder="Email" name="email"
                        aria-describedby="emailHelp" required>
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label required fw-600">Mật khẩu</label>
                    <input type="password" class="form-control border-2"  placeholder="Mật khẩu" name="password" required>
                </div>
                <button type="submit" class="btn btn-main-hover d-block mx-auto px-3">Đăng nhập</button>
                <div class="social-auth-links text-center mb-3">
                  <p>- HOẶC -</p>
                  <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Đăng nhập với Facebook
                  </a>
                  <a href="/admin/redirect/google" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Đăng nhập với Google+
                  </a>
                </div>

                <a class="d-flex justify-content-center mt-3 text-decoration-underline text-second fw-500" href="forgot-password.html">Quên mật khẩu?</a>
                <div class="mt-4 text-center">
                    <span>Chưa có tài khoản?</span>
                    <a class="text-decoration-underline text-main fw-600" href="/admin/users/login/register">Đăng ký tài khoản</a>
                </div>
                
        @csrf
            </form>
             
          
        </div>
    </section>


@endsection