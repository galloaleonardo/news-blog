<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $service) {}

    public function index()
    {
        $dashboard = $this->service->index();

        $charts = $this->service->getCharts();
        $lineChart = $charts['lineChart'];
        $barChart = $charts['barChart'];


        return view('admin.dashboard', compact('dashboard', 'lineChart', 'barChart'));
    }
}
