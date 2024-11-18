<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$title}}</title></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">


  @yield('head')
  <style>
    .hidden {
      display: none;
    }
    .button {
    display: inline-block; /* Để thẻ <a> hoạt động giống một button */
    padding: 10px 20px;    /* Tạo khoảng trống xung quanh nội dung */
    background-color: #4CAF50; /* Màu nền xanh lá */
    color: white;          /* Màu chữ trắng */
    text-align: center;    /* Căn giữa nội dung */
    text-decoration: none; /* Loại bỏ gạch chân mặc định của thẻ <a> */
    font-size: 16px;       /* Kích thước chữ */
    border-radius: 5px;    /* Bo góc cho button */
    transition: background-color 0.3s ease; /* Hiệu ứng khi di chuột qua */
}

.home-container {
    width: 100%;
    height: 100vh;
    background-image: url(https://i.pinimg.com/originals/d6/a6/92/d6a692fc1e0489955e2b4ed4ae742c76.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.button:hover {
    background-color: #45a049; /* Đổi màu khi hover */
}

.button:active {
    background-color: #3e8e41; /* Đổi màu khi nhấn */
}

.button:focus {
    outline: none; /* Bỏ viền mặc định khi focus */
    box-shadow: 0 0 5px #4CAF50; /* Thêm hiệu ứng bóng khi focus */
}

#orderStatusChart {
  height: 280px !important;
  width: 90% !important;
  padding: 0; /* Remove padding */
  margin: 0; /* Remove margin */
}

/* Target the canvas wrapper */
#orderStatusChartContainer {
  padding: 0;
  margin: 0;
}

.status.done {
    color: #0275d8!important;
}

.status.confirmed {
    color: #5cb85c!important;
}

.status.pending {
    color: #49b3e4!important;
}

.status.shipping {
    color: #e79d34!important;
}

.status.shipped {
    color: #d9534f!important;
}

.status.canceled {
    color: #a8a8a8!important;
}


  </style>