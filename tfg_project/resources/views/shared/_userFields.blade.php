{!! csrf_field() !!}
<div class="form-group">
    <label for="name">{{ __('tfg.forms.fields.name') }}: </label>
    <input type="text" class="form-control" name="name" id="name" placeholder="John"
        value="{{ old('name', $user->name) }}">
</div>
<br>

<div class="form-group">
    <label for="surnames">{{ __('tfg.forms.fields.surnames') }}: </label>
    <input type="text" class="form-control" name="surnames" id="surnames" placeholder="Gonzalez Vazquez"
        value="{{ old('surnames', $user->surnames) }}">
</div>
<br>

<div class="form-group">
    <label for="nick">{{ __('tfg.forms.fields.nick') }}: </label> <small>({{ __('tfg.forms.small.nick_info') }})</small>
    <input type="text" maxlength="15" class="form-control" name="nick" id="nick" placeholder="nick_example"
        value="{{ old('nick', $user->nick) }}">
</div>
<br>

<div class="form-group">
    <label for="bio">{{ __('tfg.forms.fields.bio') }}: </label> <small>({{ __('tfg.forms.small.bio_info') }})</small>
    <textarea maxlength="200" name="bio" id="bio" cols="50" rows="4"
        class="form-control">{{ old('bio', $user->bio) }}</textarea>
</div>
<br>

<div class="form-group">
    <label for="email">{{ __('tfg.forms.fields.email') }}: </label>
    <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com"
        value="{{ old('email', $user->email) }}">
</div>
<br>

<div class="form-group">
    <label for="password">{{ __('tfg.forms.fields.password') }}: </label> <small>({{ __('tfg.forms.small.password_info') }})</small>
    <input type="password" class="form-control" name="password" id="password">
</div>
<br>

<div class="form-group">
    <label for="password_confirmation">{{ __('tfg.forms.fields.password-confirmation') }}: </label> <small>({{ __('tfg.forms.small.password_info') }})</small>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
</div>
<br>

<div class="form-group">
    <label for="avatar">Avatar: </label>
    <small>({{ __('tfg.forms.small.avatar_info') }})</small>
    <input type="file" name="avatar" id="avatar" class="dropify" data-default-file="{{ $user->avatar }}"/>
</div>
<br>
