<?php

namespace App\Http\Controllers\Admin;

use App\Aqar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        $charts = Aqar::select(DB::raw('COUNT(*) AS counting , month'))->where('year', date('Y'))
            ->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
        $array = [];
        if (isset($charts[0]['month']))
        {
            for ($i = 1; $i < $charts[0]['month']; $i++) {
                $array[] = 0;
            }
        }

        $new = array_merge($array, $charts);

        return view('admin.home.index', compact('new'));
    }

    public function aqarsStatus()
    {
        $year = date('Y');
        $charts = Aqar::select(DB::raw('COUNT(*) AS counting , month '))->where('year', date('Y'))
            ->groupBy('month')->orderBy('month', 'asc')->get()->toArray();

        $array = [];
        if (isset($charts[0]['month']))
        {
            for ($i = 1; $i < $charts[0]['month']; $i++) {
                $array[] = 0;
            }
        }

        $new = array_merge($array, $charts);
        return view('admin.home.statistics', compact('year', 'new'));
    }

    public function showAqarsYear(Request $request)
    {
        $year = $request->year;
        $charts = Aqar::select(DB::raw('COUNT(*) AS counting , month'))->where('year', $year)
            ->groupBy('month')->orderBy('month', 'asc')->get()->toArray();

        $array = [];
        if (isset($charts[0]['month']))
        {
            for ($i = 1; $i < $charts[0]['month']; $i++) {
                $array[] = 0;
            }
        }

        $new = array_merge($array, $charts);
        return view('admin.home.statistics', compact('year', 'new'));
    }
}
