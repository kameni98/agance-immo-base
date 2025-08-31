@extends('admin.base')

@section('title', $property->exists ? 'Editer le bien : '.$property->title : 'Ajouter un bien')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.properties.index')}}" class="btn btn-danger">
            Retour
        </a>
    </div>

    <form action="{{route($property->exists ? 'admin.properties.update' : 'admin.properties.store', $property)}}" method="post" enctype="multipart/form-data">

        @csrf
        @method($property->exists ? 'PUT' : 'POST')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title])
            <div class="col row">
                @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Surface', 'name' => 'surface', 'value' => $property->surface])
                @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Prix', 'name' => 'price', 'value' => $property->price, 'type' => 'number'])
            </div>
        </div>

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'text-start', 'label' => 'Description',
                    'name' => 'description', 'value' => $property->description, 'type' => 'textarea'])
        </div>

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Pièces', 'name' => 'rooms', 'value' => $property->rooms, 'type' => 'number'])
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Chambres', 'name' => 'bedrooms', 'value' => $property->bedrooms, 'type' => 'number'])
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Etage', 'name' => 'floor', 'value' => $property->floor, 'type' => 'number'])
        </div>

        <div class="row mb-2">
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Ville', 'name' => 'city_id', 'value' => $property->city_id, 'type' => 'select', 'options' => $cities])
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Adresse', 'name' => 'address', 'value' => $property->address])
            @include('shared.forms.input',['class' => 'col text-start', 'label' => 'Code Postal ?', 'name' => 'postal_code', 'value' => $property->postal_code])
        </div>

        <div class="row mb-2">
            @include('shared.forms.checkbox',['class' => 'text-start', 'label' => 'Soldé ?',
                    'name' => 'sold', 'value' => $property->sold])
        </div>

        <button type="submit" @class($property->exists ? 'btn btn-warning' : 'btn btn-primary')>
            {{$property->exists ? 'Modifier' : 'Ajouter'}}
        </button>
    </form>

@endsection
