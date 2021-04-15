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
    * Valida los datos, realiza registro y devuelve un access token
    */

    public function register(CreateUserRequest $request)
    {

        $data = ([
            'name' => $request->name,
            'surnames' => $request->surnames,
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user = User::create($data);

        $create_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $create_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($create_token->token->expires_at)->toDateTimeString()
        ], 201);
    }

    /*
    * Valida los datos de login y devuelve un access token
    */

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        //Si el usuario no se autentifica correctamente devuelve error
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 400);
        }

        //Usuario autenticado
        $user = Auth::user();

        //Se crea un access token para el usuario
        $create_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $create_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($create_token->token->expires_at)->toDateTimeString()
        ]);
    }

    /*
    * Devuelve el usuario que hay logeado actualmente
    */

    public function getCurrentUser(Request $request)
    {

        return new UserResource($request->user());
    }

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

        /*
        return response()->json([
            'mensaje' => 'Usuario creado correctamente'
        ], 200);
        */
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

        /*
        if($user->save()){
            return response()->json([
                'mensaje' => 'Usuario actualizado correctamente'
            ], 200);
        }

        return response()->json([
            'mensaje' =>'La actualizacion ha fallado'
        ], 400);
        */
    }

    /*
    * Enviar un usuario a la papelera
    */

    public function destroy(User $user)
    {
        $user->forceDelete();

        return redirect()->route('users.index');
    }
}
