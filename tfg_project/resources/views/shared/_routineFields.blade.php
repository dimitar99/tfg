{!! csrf_field() !!}
<div class="form">
    <label for="name">{{ __('tfg.forms.fields.name') }}: </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Pecho con mancuernas"
        value="{{ old('name', $routine->name) }}">
</div>
<br>

<div class="form">
    <label for="type">{{ __('tfg.forms.fields.type') }}: </label>
    <select name="type" id="type" class="form-control">
        <option value="">{{ __('tfg.forms.default.select') }}</option>
        @foreach($routineTypes as $routineType)
            <option value="{{ $routineType->id }}" {{ old('type', $routine->type) == $routineType->id ? 'selected': '' }}>
                {{ $routineType->name }}
            </option>
        @endforeach
    </select>
</div>
<br>

<div class="form">
    <label for="description">{{ __('tfg.forms.fields.description') }}: </label> <small>({{ __('tfg.forms.small.description-info') }})</small>
    <textarea maxlength="600" name="description" id="description" cols="50" rows="8"
        class="form-control">{{ old('description', $routine->description) }}</textarea>
</div>
<br>

<div class="form">
    <label for="image">{{ __('tfg.forms.fields.image') }}: </label>
    <input type="text" class="form-control" name="video" id="image" placeholder="Imagen"
        value="{{ old('image', $routine->image) }}">
</div>
<br>
