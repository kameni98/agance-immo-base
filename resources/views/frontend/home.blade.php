@extends('frontend.base')

@section('title', 'Liste des biens')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence Immo</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda consectetur deleniti dolor dolorem eveniet expedita itaque maiores odit provident quae quam, quis quo repudiandae sapiente sint. Accusantium atque labore similique.
            </p>
        </div>
    </div>

    <h2>List des biens</h2>
    <div class="row">
        @foreach($properties as $property)
            <div class="col">
                @include('frontend.properties.card')
            </div>
        @endforeach
    </div>
@endsection

@section('js')

@endsection
