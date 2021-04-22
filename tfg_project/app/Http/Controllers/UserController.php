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
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
    * Devuelve el listado de usuarios paginado
    */

    public function list()
    {
        $users = User::query()
            ->orderBy('name')
            ->paginate(10);

        return view('users.list', [
            'users' => $users,
        ]);
    }

    /*
    * Muestra el detalle de un usuario
    */

    public function show($id)
    {
        $user = User::findOrFail($id);

        $avatar = "";

        if(Storage::exists($user->avatar)){
            $avatar = Storage::url($user->avatar);
        }

        return view('users.show', compact('user', 'avatar'));
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
        $user = new User([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'bio' => $request->bio,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        if ($request->avatar) {
            $user->avatar = 'users/avatar_' . $user->id . '.' . $request->avatar->getClientOriginalExtension();
            Storage::put($user->avatar, file_get_contents($request->avatar));

            $user->update();
        }

        return redirect()->route('users.list');
    }

    /*
    * Editar un usuario
    */

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $avatar = "";

        if(Storage::exists($user->avatar)){
            $avatar = Storage::url($user->avatar);
        }

        return view('users.edit', compact('user', 'avatar'));
    }

    /*
    * Actualiza un usuario
    */

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->avatar){
            $user->avatar = 'users/avatar_.'.$user->id.$request->avatar->getClientOriginalExtension();

            if (Storage::exists($user->avatar)){
                Storage::delete($user->avatar);
            }

            Storage::put($user->avatar, file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /*
    * Eliminar un usuario
    */

    public function destroy(User $user)
    {
        Storage::delete($user->avatar);

        $user->forceDelete();

        return redirect()->route('users.list');
    }
}
