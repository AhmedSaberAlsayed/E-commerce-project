<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\Api_designtrait;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\Auth\registerRequest;


class AuthController extends Controller
{
    use Api_designtrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(registerRequest $request)
    {
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'Address' => $request->Address,
            'Phone_Number' => $request->Phone_Number,
            'password' => Hash::make($request->password),
        ]);
        return $this->api_design(200,'user add success',$user);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user= User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $deviceName= $request->userAgent();
            $token= $user->createToken($deviceName);

            return $this->api_design(200,'login success',[$token,$user]);

        };
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $show=new UserResource($user);
        return $this->api_design(200,'Select user ',$show);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'Address' => $request->Address,
            'Phone_Number' => $request->Phone_Number,
            'password' => Hash::make($request->password),
        ]);
        return $this->api_design(200,'user update success',$user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $record = new UserResource($user);
        $record->delete();
    return $this->api_design(200,'User delete success',$record,);
    }
}
