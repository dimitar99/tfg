{!! csrf_field() !!}
<div class="form">
    <label for="name">Nombre: </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Pecho con mancuernas"
        value="{{ old('name', $routine->name) }}">
</div>
<br>

<div class="form">
    <label for="type">Tipo: </label>
    <select name="type" id="type" class="form-control">
        <option value="">Selecciona un tipo</option>
        @foreach($routineTypes as $routineType)
            <option value="{{ $routineType->id }}" {{ old('type', $routine->type) == $routineType->id ? 'selected': '' }}>
                {{ $routineType->name }}
            </option>
        @endforeach
    </select>
</div>
<br>

<div class="form">
    <label for="description">Descripcion: </label> <small>(Máximo 600 caracteres)</small>
    <textarea maxlength="600" name="description" id="description" cols="50" rows="8"
        class="form-control">{{ old('description', $routine->description) }}</textarea>
</div>
<br>

<div class="form">
    <label for="video">Video: </label>
    <input type="text" class="form-control" name="video" id="video" placeholder="Video"
        value="{{ old('video', $routine->video) }}">
</div>
<br>
