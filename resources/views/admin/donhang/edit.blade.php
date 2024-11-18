@extends('admin.main')

@section('head')
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
        
            <div class="row">
                <div class="col-md-6">
                        <label>Trạng thái đơn hàng</label>
                        <select class="form-control" name="TTDonHang">
                            <option value="Đơn hàng đã đặt"> Đơn hàng đã đặt</option>
                            <option value="Xác nhận đơn hàng"> Xác nhận đơn hàng</option>
                            <option value="Đang chờ vận chuyển"> Đang chờ vận chuyển</option>
                            <option value="Đang vận chuyển"> Đang vận chuyển</option>
                            <option value="Đã giao hàng xong"> Đã giao hàng xong</option>

                        </select>
                    </div>
             </div>
            </div>       

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Trạng Thái Đơn Hàng</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
@endsection
