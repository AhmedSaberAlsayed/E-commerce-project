<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Adminstration;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api_designtrait;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminstrationResource;
use App\Http\Requests\Admin\AdminstrationRequest;


class AdminstrationController extends Controller
{
    use Api_designtrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Adminstration::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(AdminstrationRequest $request)
    {
        $Adminstration= Adminstration::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->api_design(200,'Admin add success',$Adminstration);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Adminstration= Adminstration::where('email',$request->email)->first();
        if ($Adminstration && Hash::check($request->password, $Adminstration->password)) {
            $deviceName= $request->userAgent();
            $token= $Adminstration->createToken($deviceName);

            return $this->api_design(200,'login success',[$token,$Adminstration]);

        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Adminstration $Adminstration)
    {
        $show=new AdminstrationResource($Adminstration);
        return $this->api_design(200,'Selected Admin ',$show);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(AdminstrationRequest $request, Adminstration $Adminstration)
    {
        $Adminstration->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->api_design(200,'Admins data update success',$Adminstration);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adminstration $Adminstration)
    {
        $record = new AdminstrationResource($Adminstration);
        $record->delete();
    return $this->api_design(200,'Admins delete success',$record,);
    }
}
