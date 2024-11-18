@extends('admin.main')

@section('content')
<body>
    <div class="mx-5 py-4">
        <div class="row">
            <div class="col">
                <select id="filterPeriod" class="form-select w-25 float-right mb-3 py-1 rounded h5 pl-2" onchange="updateStats()">
                    <option value="day">Theo Ngày</option>
                    <option value="week">Theo Tuần</option>
                    <option value="month">Theo Tháng</option>
                </select>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col text-white rounded py-3 mr-4 text-right pr-4" style="background: #488A99;">
                <h5 class="mb-2 h3" id="userCount">{{ $newUsersToday }}</h5>
                <p class="h5"><i class="fa-solid me-1 fa-user"></i> Người dùng mới</p>
            </div>
            <a href="/admin/donhangs" class="col bg-success text-white rounded py-3 mr-4 text-right pr-4 hover">
                <h5 class="mb-2 h3" id="orderCount">{{ $ordersThisMonth }}</h5>
                <p class="h5"><i class="fa-solid me-1 fa-hourglass-half"></i> Đơn hàng đang xử lý</p>
            </a>
            <div class="col text-white rounded py-3 mr-4 text-right pr-4" style="background: #EA6A47;">
                <h5 class="mb-2 h3" id="completedOrderCount">{{ $completedOrdersToday }}</h5>
                <p class="h5"><i class="fa-solid me-1 fa-circle-check"></i> Đơn hàng đã hoàn thành</p>
            </div>
            <div class="col text-white rounded py-3 mr-4 text-right pr-4 bg-danger">
                <h5 class="mb-2 h3" id="completedOrderCount">{{ $completedOrdersToday }}</h5>
                <p class="h5"><i class="fa-solid me-1 fa-triangle-exclamation"></i> Đơn hàng đã huỷ</p>
            </div>
            <div class="col bg-primary text-white rounded py-3 text-right pr-4">
                <h5 class="mb-2 h3" id="revenue">{{ number_format($completedOrdersTotalToday, 0) }} VND</h5>
                <p class="h5"><i class="fa-solid me-1 fa-hand-holding-dollar"></i> Tổng doanh thu</p>
            </div>
        </div>

                <!-- Revenue Chart -->

        <div class="row mt-4 gap-3">
            <div class="col border rounded p-3">
                <h5>Thống kê Doanh thu theo tháng</h5>
                <canvas id="revenueChart" width="100" height="50"></canvas>
            </div>

            <div class="col border rounded p-3">
                <h5>Thống kê Người dùng mới theo tháng</h5>
                <canvas id="newUsersChart" width="100" height="50"></canvas>
            </div>
        </div>

        <div class="row mt-4 gap-3">
            <div class="col border rounded pe-2">
                <h5 class="p-3 pb-4">Doanh thu theo loại sản phẩm trong tháng {{$currentMonth}}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Loại Sản Phẩm</th>
                            <th>Số Đơn Hàng</th>
                            <th>Doanh Thu (VND)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($revenueByCategory as $category => $data)
                            <tr>
                                <td>{{ $category }}</td>
                                <td>{{ $data['order_count'] }}</td>
                                <td class="text-danger">{{ number_format($data['revenue'], 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col border rounded p-3">
                <h5 class="mb-3">Phân bố Đơn hàng theo Trạng thái trong tháng {{$currentMonth}}</h5>
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        // New Users Chart
        const newUsersCtx = document.getElementById('newUsersChart').getContext('2d');
        const months = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        const newUsersChart = new Chart(newUsersCtx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Người dùng mới',
                    data: {{ json_encode($monthlyNewUsers) }},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return Number.isInteger(value) ? value : ''; // Show only integer values
                        }
                    }
                }
            }
        }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: {{ json_encode($monthlyRevenue) }},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const orderStatusData = @json($orderStatusCounts);
        const orderStatusLabels = Object.keys(orderStatusData);
        const orderStatusCounts = Object.values(orderStatusData);

        // Order Status Pie Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: orderStatusLabels,
                datasets: [{
                    data: orderStatusCounts,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    hoverBackgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        font: {
                            size: 18  // Increase this value to make the labels larger
                        }
                    }
                }
            },
                maintainAspectRatio: false,
            }
        });

	
        function updateStats() {
            const filterPeriod = document.getElementById('filterPeriod').value;

            // Set statistics based on selected period
            if (filterPeriod === 'day') {
                document.getElementById('userCount').innerText = "{{ $newUsersToday }}";
                document.getElementById('orderCount').innerText = "{{ $ordersThisMonth }}";
                document.getElementById('completedOrderCount').innerText = "{{ $completedOrdersToday }}";
                document.getElementById('revenue').innerText = "{{ number_format($completedOrdersTotalToday, 0) }} VND";
            } else if (filterPeriod === 'week') {
                document.getElementById('userCount').innerText = "{{ $newUsersThisWeek }}";
                document.getElementById('orderCount').innerText = "{{ $ordersThisMonth }}";
                document.getElementById('completedOrderCount').innerText = "{{ $completedOrdersThisWeek }}";
                document.getElementById('revenue').innerText = "{{ number_format($completedOrdersTotalThisWeek, 0) }} VND";
            } else if (filterPeriod === 'month') {
                document.getElementById('userCount').innerText = "{{ $newUsersThisMonth }}";
                document.getElementById('orderCount').innerText = "{{ $ordersThisMonth }}";
                document.getElementById('completedOrderCount').innerText = "{{ $completedOrdersThisMonth }}";
                document.getElementById('revenue').innerText = "{{ number_format($completedOrdersTotalThisMonth, 0) }} VND";
            }
        }
    </script>
    
@endsection