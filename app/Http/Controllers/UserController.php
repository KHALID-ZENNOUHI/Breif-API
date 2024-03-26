<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if($users->isEmpty()){
            return response()->json([
                'status' => 404,
                'message' => 'No users found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'users' => $users,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validate->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user){
            return response()->json([
                'status' => 201,
                'message' => 'User created successfully',
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Failed to create user',
        ], 500);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = USer::findOrfail($id);

        if(!$user){
            return response()->json([
                'status'=> 404,
                'message' => 'User not found',
            ], 404);
        }

        $validate = $request->validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|string|min:8',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validate->errors(),
            ], 400);
        }

        $user->update($request->all());

        if($user){
            return response()->json([
                'status' =>200,
                'message' => "User updated successfully",
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Failed to update user',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrfail($id);
        if(!$user){
            return response()->json([
                'status' =>404,
                'message' => 'User not found',
            ], 404);
        }
        $user->delete();
        if(!$user){
            return response()->json([
                'status' =>500,
                'message' => 'Failed to delete user',
            ], 500);
        }
        return  response()->json([
            'status' => 200,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
