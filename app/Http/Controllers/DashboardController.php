<?php

namespace App\Http\Controllers;

use App\Advertising;
use App\Category;
use App\Charts\NewsChart;
use App\News;
use App\User;
use foo\bar;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = [
            'news' => News::count(),
            'categories' => Category::count(),
            'advertisements' => Advertising::count(),
            'users' => User::count()
        ];

        $charts = $this->getCharts();
        $lineChart = $charts['lineChart'];
        $barChart = $charts['barChart'];


        return view('admin.dashboard', compact('dashboard', 'lineChart', 'barChart'));
    }

    private function getCharts()
    {
        $lineChart = new NewsChart;
        $lineChart->labels(['Oct', 'Nov', 'Dec']);
        $lineChart->dataset('Quantity', 'line', [89, 132, 45]);

        $barChart = new NewsChart;
        $barChart->labels(['Oct', 'Nov', 'Dec']);
        $barChart->dataset('News with the Most Views', 'bar', [89, 132, 45]);

        return [
            'lineChart' => $lineChart,
            'barChart' => $barChart
        ];
    }
}
