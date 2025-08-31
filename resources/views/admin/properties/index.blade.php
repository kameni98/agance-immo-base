@extends('admin.base')

@section('title', 'Liste des biens')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.properties.create')}}" class="btn btn-primary">
            Ajouter
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <th>Titre</th>
            <th>Surface</th>
            <th>Prix</th>
            <th>Ville</th>
            <th @class('text-end')>Actions</th>
        </thead>

        <tbody>
            @foreach($properties as $property)
                <tr>
                    <td>{{$property->title}}</td>
                    <td>{{$property->surface}}m²</td>
                    <td>{{number_format($property->price, thousands_separator: ' ')}}</td>
                    <td>{{$property->city->name}}</td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{route('admin.properties.edit', ['property' => $property->id])}}" class="btn btn-warning">
                                edit
                            </a>
                            <form class="form-delete" action="{{route('admin.properties.destroy', $property)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="property" value="{{$property->title}}">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $properties->links() }}
@endsection

@section('js')
    <script>
        const elements = document.querySelectorAll('.form-delete');
        elements.forEach(function(element) {
            element.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const property = element.elements.property.value

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
