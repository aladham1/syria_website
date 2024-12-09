<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Visit;
use App\Models\Visitor;
use App\Models\Wallet;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();



        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();



        return view('manage.home');
    }

}
