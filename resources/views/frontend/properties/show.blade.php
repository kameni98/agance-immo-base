@extends('frontend.base')

@section('title', 'Liste des biens')

@section('content')


    <h2 class="d-flex justify-content-between align-items-center">
        {{$property->title}} - ({{$property->city->name}}/{{$property->address}})
        <a href="{{route('properties.index')}}" @class('btn btn-danger text-end')>Retour</a></h2>
    <h3>{{$property->rooms}} pièces - {{$property->surface}}</h3>

    <div class="text-primary fw-bold" style="font-size: 4em">
        {{number_format($property->price, thousands_separator: ' ')}} &euro;
    </div>

    <hr>

    <div class="mt-4">
        @if($property->sold)
            <h4>Déjà vendue 😢</h4>
        @else
            <h4>Intéressé par cette propriété ?</h4>

            <form action="{{route('properties.contact', ['property' => $property])}}" method="post" class="vstack gap-3">
                @csrf
                <input type="hidden" name="property_id" value="{{$property->id}}">
                <div class="row">
                    @include('shared.forms.input', ['class' => 'col', 'name' => 'firstname', 'label' => 'prénoms'])
                    @include('shared.forms.input', ['class' => 'col', 'name' => 'lastname', 'label' => 'Noms'])
                </div>
                <div class="row">
                    @include('shared.forms.input', ['class' => 'col', 'name' => 'phone', 'label' => 'Téléphone'])
                    @include('shared.forms.input', ['class' => 'col', 'name' => 'email', 'label' => 'Email', 'type' => 'email'])
                </div>
                @include('shared.forms.input', ['class' => 'col', 'name' => 'message', 'label' => 'Votre Message', 'type' => 'textarea'])
                <div>
                    <button type="submit" class="btn btn-primary">Nous contacter</button>
                </div>
            </form>
        @endif
    </div>


    <div class="mt-4">
        <p>{{nl2br($property->description)}}</p>

        <div class="row">
            <div class="col-8">
                <h2>Caractéristiques</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Prix : </td>
                        <td>
                            <b>
                                {{number_format($property->price, thousands_separator: ' ')}} &euro;
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Surface habitable : </td>
                        <td>{{$property->surface}} m²</td>
                    </tr>
                    <tr>
                        <td>Pièces : </td>
                        <td>{{$property->rooms}}</td>
                    </tr>
                    <tr>
                        <td>Chambres : </td>
                        <td>{{$property->bedrooms}}</td>
                    </tr>
                    <tr>
                        <td>Etage : </td>
                        <td>{{$property->floor ?: 'Rez de chaussée'}}</td>
                    </tr>
                    <tr>
                        <td>Adresse : </td>
                        <td>{{$property->city->name}}<br>
                        {{$property->address}} ({{$property->postal_code ?: 'Aucun'}})</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <h2>Spécificités</h2>
                <ul class="list-group">
                    @foreach($property->options as $option)
                        <li class="list-group-item">{{$option->name}}</li>
                    @endforeach
                </ul>
            </div>

            @auth
                <div class="ms-auto">
                    <form class="form-delete" action="{{route('properties.destroy', $property)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="title" value="{{$property->title}}">
                        <button type="submit" class="btn btn-danger">Supprimer cette propriété</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
@endsection

@section('js')
    <script>
        const elements = document.querySelectorAll('.form-delete');
        elements.forEach(function(element) {
            element.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const property = element.elements.title.value

                Swal.fire({
                    title: "Voulez-vous vraiment supprimer le bien : **"+property+"** ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Oui",
                    denyButtonText: `Non`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });

            });
        });
    </script>
@endsection
