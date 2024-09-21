<?php

namespace App\Http\Controllers;

use App\Models\Devicedata;
use Illuminate\Http\Request;
use App\Http\Resources\DevicedataResource;

use App\Models\UniqueKeys;


class DevicedataController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $devicedatas = Devicedata::where('alat_id', '=', $request->alat_id)->get();
        return $this->sendResponse(DevicedataResource::collection($devicedatas), 'Device datas retrieved succesfully.');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $CheckKey = UniqueKeys::where('uniqueID', 'LIKE', $request->key)->get();
        $count = UniqueKeys::where('uniqueID', 'LIKE', $request->key)->get()->count();
        
        if($count != 1){
            return $this->sendError('Wrong Key');       
        }
        $time = date(DATE_ISO8601);
        $data = new Devicedata();
        $data->alat_id = $request->alat_id;
        $data->kelembapan = $request->kelembapan;
        $data->created_at = $time;
        $data->save();
   
        return $this->sendResponse(new DevicedataResource($data), 'Device created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devicedata  $devicedata
     * @return \Illuminate\Http\Response
     */
    public function show(Devicedata $devicedata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devicedata  $devicedata
     * @return \Illuminate\Http\Response
     */
    public function edit(Devicedata $devicedata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devicedata  $devicedata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devicedata $devicedata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devicedata  $devicedata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devicedata $devicedata)
    {
        //
    }
}
