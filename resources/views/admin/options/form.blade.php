@extends('admin.base')

@section('title', $option->exists ? 'Editer l\'option : '.$option->title : 'Ajouter une option')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.options.index')}}" class="btn btn-danger">
            Retour
        </a>
    </div>

    <form action="{{route($option->exists ? 'admin.options.update' : 'admin.options.store', $option)}}" method="post" enctype="multipart/form-data">

        @csrf
        @method($option->exists ? 'PUT' : 'POST')

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Nom de l\'option', 'name' => 'name', 'value' => $option->name])
        </div>

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'text-start', 'label' => 'Description',
                    'name' => 'description', 'value' => $option->description, 'type' => 'textarea'])
        </div>

        <button type="submit" @class($option->exists ? 'btn btn-warning' : 'btn btn-primary')>
            {{$option->exists ? 'Modifier' : 'Ajouter'}}
        </button>
    </form>

@endsection
