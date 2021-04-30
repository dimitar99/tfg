<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4><strong>{{ __('tfg.forms.fields.name') }}: </strong> {{  $user->name }}</h4>
    <h4><strong>{{ __('tfg.forms.fields.surnames') }}:</strong> {{ $user->surnames }}</h4>
    <h4><strong>{{ __('tfg.forms.fields.email') }}:</strong> {{ $user->email }}</h4>
    <h4><strong>{{ __('tfg.forms.fields.nick') }}:</strong> {{  $user->nick }}</h4>

    <p>{{ $body }}</p>
</body>
</html>
