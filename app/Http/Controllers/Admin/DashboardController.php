<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected period from request, default to '7days'
        $period = $request->get('period', '7days');
        
        // Calculate date range based on selected period
        $dateRange = $this->getDateRange($period);
        $startDate = $dateRange['start'];
        $endDate = $dateRange['end'];

        // Get sales data for the selected period
        $salesData = Transaction::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        // Get total orders
        $totalOrders = Transaction::count();

        // Get total customers
        $totalCustomers = User::count();

        // Get total products
        $totalProducts = Product::count();

        // Get top products
        $topProducts = Product::withCount('transactionItems')
            ->orderBy('transaction_items_count', 'desc')
            ->take(5)
            ->get();

        // Get top customers
        $topCustomers = User::withCount('transactions')
            ->withSum('transactions', 'total_price')
            ->orderBy('transactions_sum_total_price', 'desc')
            ->take(5)
            ->get();

        // Calculate age demographics
        $ageDemographics = [
            '50+' => User::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 50')->count(),
            '40-49' => User::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 49')->count(),
            '30-39' => User::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 30 AND 39')->count(),
            '20-29' => User::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 20 AND 29')->count(),
            'Under 20' => User::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 20')->count(),
        ];

        // Calculate total users for percentage
        $totalUsers = array_sum($ageDemographics);

        // Calculate percentages
        $agePercentages = array_map(function($count) use ($totalUsers) {
            return $totalUsers > 0 ? round(($count / $totalUsers) * 100) : 0;
        }, $ageDemographics);

        // Calculate total sales for the selected period
        $totalSales = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_price');

        // Calculate sales growth
        $previousPeriod = $this->getPreviousPeriod($period);
        $lastPeriodSales = Transaction::whereBetween('created_at', [
            $previousPeriod['start'],
            $previousPeriod['end']
        ])->sum('total_price');

        $salesGrowth = $lastPeriodSales > 0 
            ? (($totalSales - $lastPeriodSales) / $lastPeriodSales) * 100 
            : 0;

        // New products count for selected period
        $newProducts = Product::whereBetween('created_at', [
            Carbon::now()->subDays(7),
            Carbon::now()
        ])->count();
        $prevProducts = Product::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(8)
        ])->count();
        $productGrowth = $prevProducts > 0 ? round((($newProducts - $prevProducts) / $prevProducts) * 100, 1) : 0;

        // New users count for selected period
        $newUsers = User::whereBetween('created_at', [
            Carbon::now()->subDays(7),
            Carbon::now()
        ])->count();
        $prevUsers = User::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(8)
        ])->count();
        $userGrowth = $prevUsers > 0 ? round((($newUsers - $prevUsers) / $prevUsers) * 100, 1) : 0;

        // Data harian produk baru untuk chart
        $productChartData = Product::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [
                Carbon::now()->subDays(7),
                Carbon::now()
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Data harian user baru untuk chart
        $userChartData = User::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [
                Carbon::now()->subDays(7),
                Carbon::now()
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'salesData',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'topProducts',
            'topCustomers',
            'totalSales',
            'salesGrowth',
            'period',
            'startDate',
            'endDate',
            'ageDemographics',
            'agePercentages',
            'newProducts',
            'productGrowth',
            'newUsers',
            'userGrowth',
            'productChartData',
            'userChartData'
        ));
    }

    private function getDateRange($period)
    {
        $endDate = Carbon::now();
        
        switch ($period) {
            case 'today':
                $startDate = Carbon::today();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case '7days':
                $startDate = Carbon::now()->subDays(7);
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(30);
                break;
            case '90days':
                $startDate = Carbon::now()->subDays(90);
                break;
            default:
                $startDate = Carbon::now()->subDays(7);
        }

        return [
            'start' => $startDate,
            'end' => $endDate
        ];
    }

    private function getPreviousPeriod($period)
    {
        $endDate = Carbon::now();
        
        switch ($period) {
            case 'today':
                return [
                    'start' => Carbon::yesterday(),
                    'end' => Carbon::yesterday()->endOfDay()
                ];
            case 'yesterday':
                return [
                    'start' => Carbon::yesterday()->subDay(),
                    'end' => Carbon::yesterday()->subDay()->endOfDay()
                ];
            case '7days':
                return [
                    'start' => Carbon::now()->subDays(14),
                    'end' => Carbon::now()->subDays(8)
                ];
            case '30days':
                return [
                    'start' => Carbon::now()->subDays(60),
                    'end' => Carbon::now()->subDays(31)
                ];
            case '90days':
                return [
                    'start' => Carbon::now()->subDays(180),
                    'end' => Carbon::now()->subDays(91)
                ];
            default:
                return [
                    'start' => Carbon::now()->subDays(14),
                    'end' => Carbon::now()->subDays(8)
                ];
        }
    }
} 