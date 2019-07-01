<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\User as UserResource;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    /**
     * Список сотрудников
     */
    public function index()
    {
        $users = User::with('projects')->latest()->paginate();
        
        return new UserCollection($users);
    }
    
    /**
     * Создание сотрудника
     */
    public function store(StoreUser $request)
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

     /**
     * Получить сотрудника
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Авторизованный сотрудник
     */
    public function current(Request $request)
    {
        return new UserResource($request->user());
    }
}
