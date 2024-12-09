<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use Illuminate\Http\Request;

class HomePageAction extends Controller
{
    public function __invoke()
    {
        $dataCount = Prisoner::count();
        $lastUpdated = Prisoner::latest('created_at')->first();
        return view('index', compact('dataCount','lastUpdated'));
    }
}
