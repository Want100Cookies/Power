<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Setting::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => [
                'required',
                'regex:/^[a-z_0-9]+$/',
                Rule::unique('settings', 'key'),
            ],
            'value' => 'required',
        ]);

        $setting = Setting::create($request->only(['key', 'value']));

        return $setting;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting $setting
     * @return Setting
     */
    public function show(Setting $setting)
    {
        return $setting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Setting $setting
     * @return Setting
     */
    public function update(Request $request, Setting $setting)
    {
        $this->validate($request, [
            'value' => 'required',
        ]);
abort(404);
        $setting->update($request->only(['value']));

        return $setting;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting $setting
     * @return bool
     */
    public function destroy(Setting $setting)
    {
        return $setting->delete();
    }
}
