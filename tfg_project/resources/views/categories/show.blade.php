@extends('layouts.app')

@section('title', 'Categoria')

@section('content')
<div class="container">
    <a href="{{ route('categories.list') }}" class="btn btn-outline-dark btn-sm">{{ __('tfg.buttons.return-to-list') }}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('tfg.categories.detail') }} {{ $category->name }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p><strong>{{ __('tfg.forms.fields.id') }}: </strong>{{ $category->id }}</p>
                        <p><strong>{{ __('tfg.forms.fields.name') }}: </strong>{{ $category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
