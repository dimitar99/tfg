@extends('layouts.app')

@section('title', 'Listado Rutinas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <a href="{{ route('routines.create') }}" class="btn btn-outline-dark"> {{ __('tfg.routines.new') }} </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('tfg.routines.list') }}</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                              <th>{{ __('tfg.tables.id') }}</th>
                              <th>{{ __('tfg.tables.type') }}</th>
                              <th>{{ __('tfg.tables.description') }}</th>
                              <th>{{ __('tfg.tables.created-at') }}</th>
                              <th>{{ __('tfg.tables.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routines as $routine)
                                <tr>
                                    <td>{{$routine->name}}</td>
                                    <td>{{$routine->routineType->name}}</td>
                                    <td>{{$routine->description}}</td>
                                    <td>{{ $routine->created_at }}</td>
                                    <td>
                                        <form action="{{ route('routines.destroy', $routine) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('routines.show', $routine) }}" class="btn btn-outline-secondary btn-sm"> {{ __('tfg.buttons.show') }} </a>
                                            <a href="{{ route('routines.edit', $routine) }}" class="btn btn-outline-secondary btn-sm"> {{ __('tfg.buttons.edit') }} </a>
                                            <button type="submit"> {{ __('tfg.buttons.delete') }} </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
