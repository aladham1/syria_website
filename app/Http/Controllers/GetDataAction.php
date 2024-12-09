<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use Illuminate\Http\Request;

class GetDataAction extends Controller
{
    public function __invoke(Request $request)
    {
        $prisoners = Prisoner::filter()->get();
        if (!$prisoners) {
            return response()->json(['message' => 'error'], 404);
        }
        return response()->json(['message' => 'success', 'prisoners' => $prisoners]);
    }
}
