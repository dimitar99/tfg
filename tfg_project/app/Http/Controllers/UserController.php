<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /*
    * Devuelve el listado de usuarios paginado
    */

    public function list()
    {
        $users = User::orderBy('id', 'asc')->paginate(12);

        return view('users.list', compact('users'));
    }

    /*
    * Muestra el detalle de un usuario
    */

    public function show($id)
    {
        $user = User::findOrFail($id);

        $avatar = "";

        if (Storage::exists($user->avatar)) {
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

            if (Storage::exists($user->getOriginal('avatar'))) {
                Storage::delete($user->getOriginal('avatar'));
            }

            $image = Image::make($request->avatar)->encode('jpg', 90);
            $image->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path, (string) $image);

            $user->update(['avatar' => $path]);
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

        if (Storage::exists($user->avatar)) {
            $avatar = Storage::url($user->avatar);
        }

        return view('users.edit', compact('user', 'avatar'));
    }

    /*
    * Actualiza un usuario
    */

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'bio' => $request->bio,
            'email' => $request->email
        ]);

        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        if ($request->avatar) {
            $path = 'users/avatar_' . $user->id . '.' . $request->avatar->getClientOriginalExtension();

            if (Storage::exists($user->getOriginal('avatar'))) {
                Storage::delete($user->getOriginal('avatar'));
            }

            $image = Image::make($request->avatar)->encode('jpg', 90);
            $image->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path, (string) $image);

            $user->update(['avatar' => $path]);
        } else {
            //Si se elimina la imagen del form, el usuario se queda sin foto
            if (Storage::exists($user->getOriginal('avatar'))) {
                Storage::delete($user->getOriginal('avatar'));
            }
        }

        $user->save();

        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /*
    * Eliminar un usuario
    */

    public function destroy(User $user)
    {
        if (Storage::exists($user->getOriginal('avatar'))) {
            Storage::delete($user->getOriginal('avatar'));
        }

        $user->delete();

        return redirect()->route('users.list');
    }
}
