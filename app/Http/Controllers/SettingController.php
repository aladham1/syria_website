<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasAbility('settings')){
            return abort(401);
        }
        $settings = Setting::all();
        return view('manage.settings.index',)->with(['settings' => $settings]);
    }


    public function update(Request $request)
    {
        if (!auth()->user()->hasAbility('pages')){
            return abort(401);
        }
        cache::forget('settings.all');
        $requests =  $request->all();
        if ($requests) {
            foreach ($requests as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }
        }

        return response()->json(
            [
                'message' => 'Updated successfully',
            ],
            200
        );

    }
}
