<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceController extends Controller
{
    public function list()
    {
        return Device::all();
    }

    public function add(Request $req){
        $device = new Device;
        $device->name = $req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if($result)
        {
            return ["result" => "Data has been successfully added"];
        }else{
            return ["result" => "Something went wrong"];
        }
        
    }

    public function updateApi(Request $req, $uid)
    {
        $device = Device::find($uid);
        $device->name = $req->name;
        $device->member_id = $req->member_id;
        $result = $device->save();
        if($result)
        {
            return ["result" => "Data has been update successfully"];
        }else{
            return ["result" => "Something went wrong"];
        }
        
    }

    public function deleteApi($id)
    {
        $device = Device::find($id);
        $result = $device->delete();
        if($result)
        {
            return ["result" => "Data has been successfully deleted ".$id];
        }else{
            return ["result" => "Something went wrong"];
        }
        
    }

    public function searchApi($name)
    {
        return Device::where("name","like","%".$name."%")->get();
    }

    public function validationApi(Request $req)
    {
        $rules = array(
            "member_id" => "required|min:2|max:4"
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }else{
            $device = new Device();
            $device->name = $req->name;
            $device->member_id = $req->member_id;
            $result = $device->save();
            if($result)
            {
                return ["Result" => "Data has been submited"];
            }else{
                return ["Result" => "Something went wrong"];
            }
            
        }
    }
}
