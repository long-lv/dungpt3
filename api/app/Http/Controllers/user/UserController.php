<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSingupValidatedRequest;
use App\Http\Requests\LoginAdminValidated;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function singUp(Request $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'isActive'=>$request->isActive
        ]);
        return response([
            'status'=>true,
            'message'=>"Signup succsess",
            'token'=>$user->createToken("API_TOKEN")->plainTextToken
        ],200);
    }

    public function login(Request $request){
        $credentials = $request->only("email","password");
        if (! $token = auth("user")->attempt($credentials)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $user = auth("user")->user();
        return response()->json([
            'status'=>true,
            'message'=>"Ok",
            'user'=>$user,
            'access_token'=>$user->createToken("API_TOKEN")->plainTextToken
        ],200);
    }

    public function index()
    {
        //
        $user = User::orderBy('created_at','desc')->paginate(15);;
        return response($user,200);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
