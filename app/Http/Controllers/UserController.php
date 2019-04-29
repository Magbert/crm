<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function current(Request $request)
    {
        return $request->user();
    }

    public function show(User $user)
    {
        return $user;
    }
}
