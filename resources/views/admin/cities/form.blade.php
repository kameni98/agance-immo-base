@extends('admin.base')

@section('title', $city->exists ? 'Editer la ville : '.$city->title : 'Ajouter une ville')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.cities.index')}}" class="btn btn-danger">
            Retour
        </a>
    </div>

    <form action="{{route($city->exists ? 'admin.cities.update' : 'admin.cities.store', $city)}}" method="post" enctype="multipart/form-data">

        @csrf
        @method($city->exists ? 'PUT' : 'POST')

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Nom de la ville', 'name' => 'name', 'value' => $city->name])
        </div>

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'text-start', 'label' => 'Description',
                    'name' => 'description', 'value' => $city->description, 'type' => 'textarea'])
        </div>

        <button type="submit" @class($city->exists ? 'btn btn-warning' : 'btn btn-primary')>
            {{$city->exists ? 'Modifier' : 'Ajouter'}}
        </button>
    </form>

@endsection
