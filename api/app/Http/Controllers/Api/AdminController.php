<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSingupValidatedRequest;
use App\Http\Requests\LoginAdminValidated;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function singUp(AdminSingupValidatedRequest $request){
        $request->validated();
        $admin = Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'isActive'=>$request->isActive
        ]);
        return response([
            'status'=>true,
            'message'=>"Signup succsess",
            'token'=>$admin->createToken("API_TOKEN")->plainTextToken
        ],200);
    }

    public function login(LoginAdminValidated $request){
        $credentials = $request->only("email","password");
        if (! $token = auth("admin")->attempt($credentials)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $user = auth("admin")->user();
        return response()->json([
            'status'=>true,
            'message'=>"Ok",
            'admin'=>$user,
            'access_token'=>$user->createToken("API_TOKEN")->plainTextToken
        ],200);
    }


    public function index()
    {
        //
        $admin = Admin::all();
        return response($admin,200);
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
