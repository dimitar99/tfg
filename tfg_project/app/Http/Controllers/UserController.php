<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
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
            ->paginate(15);

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
            $path = 'users/avatar_' . $user->id . '.' . $request->avatar->getClientOriginalExtension();
            Storage::put($path, file_get_contents($request->avatar));
            $user->update(['avatar' => $path]);
        }

        return redirect()->route('users.new-list');
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
        if ($request->avatar) {
            $path = 'users/avatar_' . $user->id . '.' . $request->avatar->getClientOriginalExtension();

            if (Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }

            Storage::put($path, file_get_contents($request->avatar));
            $user->update(['avatar' => $path]);
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
