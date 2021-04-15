{!! csrf_field() !!}
<div class="form-group">
    <label for="name">Nombre: </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Pecho con mancuernas"
        value="{{ old('name', $routine->name) }}">
</div>
<br>

<div class="form-group">
    <label for="type">Tipo: </label>
    <input type="text" class="form-control" name="type" id="type" placeholder="Pectoral"
        value="{{ old('type', $routine->type) }}">
</div>
<br>

<div class="form-">
    <label for="description">Descripcion: </label> <small>(Máximo 600 caracteres)</small>
    <textarea maxlength="600" name="description" id="description" cols="50" rows="8"
        class="form-control">{{ old('description', $routine->description) }}</textarea>
</div>
<br>

<div class="form-group">
    <label for="video">Video: </label>
    <input type="text" class="form-control" name="video" id="video" placeholder="Video"
        value="{{ old('video', $routine->video) }}">
</div>
<br>
