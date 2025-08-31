@extends('admin.base')

@section('title', $option->exists ? 'Editer la ville : '.$option->title : 'Ajouter une ville')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.cities.index')}}" class="btn btn-danger">
            Retour
        </a>
    </div>

    <form action="{{route($option->exists ? 'admin.cities.update' : 'admin.cities.store', $option)}}" method="post" enctype="multipart/form-data">

        @csrf
        @method($option->exists ? 'PUT' : 'POST')

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Nom de la ville', 'name' => 'name', 'value' => $option->name])
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
