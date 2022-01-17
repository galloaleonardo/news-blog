<?php

namespace App\Services;


use App\Charts\NewsChart;
use App\Helpers\Helper;
use App\Models\News;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;
use App\Repositories\DashboardRepository;

class DashboardService
{
    public function __construct(private DashboardRepository $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function getCharts()
    {
        $currentDate = Carbon::now();
        $lastMonthDate = Carbon::now()->subMonths(1);
        $lastLastMonthDate = Carbon::now()->subMonths(2);

        $periodCurrent = Period::create($currentDate->firstOfMonth()->toDateString(), $currentDate->lastOfMonth()->toDateString());
        $periodLastMonth = Period::create($lastMonthDate->firstOfMonth()->toDateString(), $lastMonthDate->lastOfMonth()->toDateString());
        $periodLastLastMonth = Period::create($lastLastMonthDate->firstOfMonth()->toDateString(), $lastLastMonthDate->lastOfMonth()->toDateString());

        $viewsCurrentMonth = \views(News::class)->period($periodCurrent)->count();
        $viewsLastMonth = \views(News::class)->period($periodLastMonth)->count();
        $viewsLastLastMonth = \views(News::class)->period($periodLastLastMonth)->count();

        $lineChart = new NewsChart;
        $lineChart->labels([Helper::getCompetencyDateLanguage($lastLastMonthDate), Helper::getCompetencyDateLanguage($lastMonthDate), Helper::getCompetencyDateLanguage($currentDate)]);
        $dataset = $lineChart->dataset('Views', 'line', [$viewsLastLastMonth, $viewsLastMonth, $viewsCurrentMonth]);
        $dataset->backgroundColor(collect(['#4e73df']));


        $news = $this->repository->getNewsOrderByViews();

        $newsDescripton = [];
        $newsCount = [];

        foreach ($news as $new) {
            array_push($newsDescripton, $new['title']);
        }

        foreach ($news as $new) {
            array_push($newsCount, $new['views_count']);
        }

        $barChart = new NewsChart;
        $barChart->labels($newsDescripton);
        $dataset = $barChart->dataset('News with the Most Views', 'pie', $newsCount);
        $dataset->backgroundColor(collect(['#4e73df','#834edf', '#4edfbb']));

        return [
            'lineChart' => $lineChart,
            'barChart' => $barChart
        ];
    }
}
