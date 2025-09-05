@extends('frontend.base')

@section('title', 'Liste des biens')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Recherche</h1>
            <form action="" method="get" class="d-flex gap-2">
                <input type="number" placeholder="Surface minimum" name="surface" value="{{$input['surface'] ?? ''}}" class="form-control">
                <input type="number" placeholder="Nombre de pièces minimum" name="rooms" value="{{$input['rooms'] ?? ''}}" class="form-control">
                <input type="number" placeholder="Budget maximum" name="price" value="{{$input['price'] ?? ''}}" class="form-control">
                <input type="text" placeholder="Mot clés" name="title" value="{{$input['title'] ?? ''}}" class="form-control">
                <button class="btn btn-primary btn-sm flex-grow-0" type="submit">Rechercher</button>
            </form>
        </div>
    </div>

    <h2>List des biens</h2>
    <div class="row">

        @forelse($properties as $property)
            <div class="col-3">
                @include('frontend.properties.card')
            </div>

        @empty
            <div class="col">
                <h3>Aucune propriété n'a été trouvé</h3>
            </div>
        @endforelse

    </div>

    <div class="my-4">
        {{$properties->links()}}
    </div>
@endsection

@section('js')

@endsection
