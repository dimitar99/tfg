<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ __('tfg.forms.fields.name') }}: {{  $user->name }}
    {{ __('tfg.forms.fields.surnames') }}: {{ $user->surnames }}
    {{ __('tfg.forms.fields.email') }}: {{ $user->email }}
    {{ __('tfg.forms.fields.nick') }}: {{  $user->nick }}
    <p>{{ $body }}</p>
</body>
</html>
