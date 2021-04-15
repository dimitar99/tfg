<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    * Devuelve el listado de usuarios paginado
    */

    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /*
    * Muestra el detalle de un usuario
    */

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /*
    * Crear un usuario
    */

    public function create()
    {
        return new UserForm('users.create', new User);
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users.index');
    }

    /*
    * Editar un usuario
    */

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return new UserForm('users.edit', $user);
    }

    /*
    * Actualiza un usuario
    */

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /*
    * Eliminar un usuario
    */

    public function destroy(User $user)
    {
        $user->forceDelete();

        return redirect()->route('users.index');
    }
}
