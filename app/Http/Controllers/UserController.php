<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'string|required',
            'email'=>'string|required|email|max:255|unique:users,email',
            'password'=>'string|min:8|confirmed',
        ]);
        $user = User::create($validated);
        return response($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'=>'string|required',
            'email'=>'string|required|email|max:255|unique:users,email',
            'password'=>'string|min:8|confirmed',
        ]);
        $user->update($validated);
        return response(['message'=>'User Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(['message'=>'User Updated Successfully'], 200);
    }
}
