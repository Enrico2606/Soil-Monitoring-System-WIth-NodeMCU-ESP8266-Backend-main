<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Validator;
use App\Http\Resources\DeviceResource;

class DeviceController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $devices = Device::all();
        return $this->sendResponse(DeviceResource::collection($devices), 'Device retrieved succesfully.');
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
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'device_name' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $device = Device::create($input);
   
        return $this->sendResponse(new DeviceResource($device), 'Device created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
        $device = Device::find($id);
  
        if (is_null($device)) {
            return $this->sendError('Device not found.');
        }
   
        return $this->sendResponse(new DeviceResource($device), 'Device retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'device_name' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $device->device_name = $input['device_name'];
        $device->save();
   
        return $this->sendResponse(new DeviceResource($device), 'Device updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
        $device->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
