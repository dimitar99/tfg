@extends('layouts.app')

@section('title', 'Crear Rutina')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear nueva rutina</div>

                <div class="card-body">

                    @include('shared._errors')

                    <form method="POST" action="{{ url('/routines/create') }}">

                        @include('shared._routineFields')

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Crear rutina</button>
                            <a href="{{ route('routines.list') }}" style="text-decoration: none">Volver</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
