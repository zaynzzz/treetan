<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response([
            'status'=>'Success',
            'message'=>'Insert data succesfully',
            'data'=>$user,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userdetail = User::find($id);
        return response()->json($userdetail,200);
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
        $check_user = User::firstWhere('id', $id);
        if($check_user){
            $user =  User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return response([
                'status'=>'Success',
                'message'=>'Update data succesfully',
                'data'=>$user,
            ],200);
        }else{
            return response()->json([
            'status'=>'Error',
            'message'=>'ID or User not found',
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_user = User::firstWhere('id', $id);
        if($check_user){
        $user = User::destroy($id);
        return response([
            'status'=>'Success',
            'message'=>'Delete data succesfully',
            'data'=>"id= ".$id,
        ],200);
        }else{
            return response()->json([
                'status'=>'Error',
                'message'=>'ID or User not found',
                ],200);
        }
    }
}
