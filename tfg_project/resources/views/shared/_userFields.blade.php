{!! csrf_field() !!}
<div class="form-group">
    <label for="name">Nombre: </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Pepe"
        value="{{ old('name', $user->name) }}">
</div>
<br>

<div class="form-group">
    <label for="surnames">Apellidos: </label>
    <input type="text" class="form-control" name="surnames" id="surnames" placeholder="Gonzalez Vazquez"
        value="{{ old('surnames', $user->surnames) }}">
</div>
<br>

<div class="form-group">
    <label for="nick">Nick: </label>
    <input type="text" class="form-control" name="nick" id="nick" placeholder="pepe_fitness"
        value="{{ old('nick', $user->nick) }}">
</div>
<br>

<div class="form-group">
    <label for="bio">Biografia: </label> <small>(Máximo 200 caracteres)</small>
    <textarea maxlength="200" name="bio" id="bio" cols="50" rows="4"
        class="form-control">{{ old('bio', $user->bio) }}</textarea>
</div>
<br>

<div class="form-group">
    <label for="email">Email: </label>
    <input type="email" class="form-control" name="email" id="email" placeholder="pepe_gonzalez@gmail.com"
        value="{{ old('email', $user->email) }}">
</div>
<br>

<div class="form-group">
    <label for="password">Contraseña: </label>
    <input type="password" class="form-control" name="password" id="password">
</div>
<br>
