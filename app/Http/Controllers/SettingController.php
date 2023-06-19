<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $all = Setting::where('type', 'email_template')->get();
        $setting = Setting::where('type', 'setting')->get();
        return view('dashboard.pages.setting.index', get_defined_vars());
    }

    public function update(Request $request)
    {
        foreach ($request->slug as $slug => $desc) {
            Setting::where('slug', $slug)->first()?->update(['desc' => $desc]);
        }

        return response([
            'data' => '',
            'msg' => 'success updated'
        ], 200);

    }

}
