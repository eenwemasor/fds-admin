<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting =  Setting::first();



        return Response($setting, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'string|email|required',
            'id'    => 'int'
        ]);

        $setting = Setting::updateOrCreate(
            ['id' =>  isset($validated['id']) || ''],
            ['email' =>  $validated['email']]
        );

        if ($setting) {
            return Response($setting, 200);
        } else {
            return Response('Failed to update settings', 400);
        }
    }
}
