@if($errors->any())
<div class="alert alert-danger">
    <h4>Corrige los errores</h4>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>                
        @endforeach
    </ul>
</div>
@endif