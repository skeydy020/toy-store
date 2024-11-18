<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\DonHang; // Import your Order model
use App\Models\Menu; // Import your Order model
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BaoCaoController extends Controller 
{ 
    public function index() 
    { 

        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $monthlyRevenue = [];
        $monthlyNewUsers = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyNewUsers[] = User::whereYear('created_at', $year)
                                     ->whereMonth('created_at', $month)
                                     ->count();

            // Calculate revenue by summing TongTien for completed orders each month
            $monthlyRevenue[] = DonHang::where('TTDonHang', 'Đã giao hàng xong')
                                       ->whereYear('updated_at', $year)
                                       ->whereMonth('updated_at', $month)
                                       ->sum('TongTien');
        }

        $totalUsers = User::count(); 
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        $newUsersThisWeek = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();

        // Count orders for today
        // Orders with statuses other than 'Đã giao hàng xong' for today
        $ordersToday = DonHang::where('TTDonHang', '!=', 'Đã giao hàng xong')
                                ->whereDate('updated_at', Carbon::today())
                                ->count();

        // orders with statuses other than 'Đã giao hàng xong' for this week
        $ordersThisWeek = DonHang::where('TTDonHang', '!=', 'Đã giao hàng xong')
                                ->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                ->count();

        // orders with statuses other than 'Đã giao hàng xong' for this month
        $ordersThisMonth = DonHang::where('TTDonHang', '!=', 'Đã giao hàng xong')
                                ->whereMonth('updated_at', Carbon::now()->month)
                                ->whereYear('updated_at', Carbon::now()->year)
                                ->count();



        $completedOrdersToday = DonHang::where('TTDonHang', 'Đã giao hàng xong')->whereDate('updated_at', $today)->count();
        $completedOrdersThisWeek = DonHang::where('TTDonHang', 'Đã giao hàng xong')->whereBetween('updated_at', [$startOfWeek, Carbon::now()])->count();
        $completedOrdersThisMonth = DonHang::where('TTDonHang', 'Đã giao hàng xong')->whereBetween('updated_at', [$startOfMonth, Carbon::now()])->count();


        $completedOrdersTotalToday = DonHang::where('TTDonHang', 'Đã giao hàng xong')
                                            ->whereDate('updated_at', $today)
                                            ->sum('TongTien');
        $completedOrdersTotalThisWeek = DonHang::where('TTDonHang', 'Đã giao hàng xong')
                                            ->whereBetween('updated_at', [$startOfWeek, Carbon::now()])
                                            ->sum('TongTien');
        $completedOrdersTotalThisMonth = DonHang::where('TTDonHang', 'Đã giao hàng xong')
                                            ->whereBetween('updated_at', [$startOfMonth, Carbon::now()])
                                            ->sum('TongTien');

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $orderStatusCounts = DonHang::selectRaw('TTDonHang, COUNT(*) as count')
                            ->groupBy('TTDonHang')
                            ->pluck('count', 'TTDonHang'); // Returns an associative array [status => count]

    
        $revenueByCategory = Menu::join('san_phams', 'menus.id', '=', 'san_phams.menu_id')
                                    ->join('chi_tiet_don_hangs', 'san_phams.id', '=', 'chi_tiet_don_hangs.sanpham_id')
                                    ->join('don_hangs', 'chi_tiet_don_hangs.donhang_id', '=', 'don_hangs.id')
                                    ->where('don_hangs.TTDonHang', 'Đã giao hàng xong')
                                    ->whereYear('don_hangs.updated_at', $currentYear)
                                    ->whereMonth('don_hangs.updated_at', $currentMonth)
                                    ->selectRaw('menus.name, 
                                                SUM(chi_tiet_don_hangs.Gia * chi_tiet_don_hangs.SoLuong) as revenue, 
                                                COUNT(DISTINCT don_hangs.id) as order_count')
                                    ->groupBy('menus.name')
                                    ->get()
                                    ->mapWithKeys(function ($item) {
                                        return [
                                            $item->name => [
                                                'revenue' => $item->revenue,
                                                'order_count' => $item->order_count,
                                            ]
                                        ];
                                    });

            
        // Create an associative array for the view data
        $data = [
            'totalUsers' => $totalUsers,
            'newUsersToday' => $newUsersToday,
            'newUsersThisWeek' => $newUsersThisWeek,
            'newUsersThisMonth' => $newUsersThisMonth,

            'ordersToday' => $ordersToday,
            'ordersThisWeek' => $ordersThisWeek,
            'ordersThisMonth' => $ordersThisMonth,

            'completedOrdersToday' => $completedOrdersToday,
            'completedOrdersThisWeek' => $completedOrdersThisWeek,
            'completedOrdersThisMonth' => $completedOrdersThisMonth,

            'completedOrdersTotalToday' => $completedOrdersTotalToday,
            'completedOrdersTotalThisWeek' => $completedOrdersTotalThisWeek,
            'completedOrdersTotalThisMonth' => $completedOrdersTotalThisMonth,

            'monthlyRevenue' => $monthlyRevenue, // Pass revenue data to the view
            'monthlyNewUsers' => $monthlyNewUsers,
            'year' => $year,
            'currentMonth' => $currentMonth,
            'revenueByCategory' => $revenueByCategory,
            'orderStatusCounts' => $orderStatusCounts,

        ];
        

        return view('admin.baocao.baocao', array_merge(['title' => 'Báo cáo thống kê'], $data));

    }

}



