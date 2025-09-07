@extends('admin.base')

@section('title', 'Liste des biens')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.properties.create')}}" class="btn btn-primary">
            Ajouter
        </a>
    </div>

    <table class="table table-striped" >
        <thead>
            <th>Titre</th>
            <th>Surface</th>
            <th>Prix</th>
            <th>Ville</th>
            <th>Options</th>
            <th @class('text-end')>Actions</th>
        </thead>

        <tbody>
            @foreach($properties as $property)
                {{-- si une propriété a été supprimé dans le frontend on la met au rouge pour signaler à l'admin sa suppression dans le front--}}
                <tr @class($property->deleted_at !== null ? 'table-danger bg-opacity-10' : '')>
                    <td>{{$property->title}}</td>
                    <td>{{$property->surface}}m²</td>
                    <td>{{number_format($property->price, thousands_separator: ' ')}}</td>
                    <td>{{$property->city->name}}</td>
                    <td>
                        @forelse($property->options as $option)
                            <span class="badge text-bg-info">{{$option->name}}</span>
                        @empty
                            <span class="badge text-bg-secondary">Aucune</span>
                        @endforelse
                    </td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{route('admin.properties.edit', ['property' => $property->id])}}" class="btn btn-warning">
                                edit
                            </a>
                            <form class="form-delete" action="{{route('admin.properties.destroy', $property)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="title" value="{{$property->title}}"> {{-- cet input nous permet de récupérer le titre dans le javascript--}}
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            @if($property->deleted_at)
                                <form class="form-restore" action="{{route('admin.properties.restore', $property)}}" method="post">
                                    @csrf
                                    @method("PATCH")
                                    <input type="hidden" name="title" value="{{$property->title}}"> {{-- cet input nous permet de récupérer le titre dans le javascript--}}
                                    <button type="submit" class="btn btn-success">Restaurer</button>
                                </form>
                            @endif
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
        //confirmation de restauration d'une propriété
        const elementsToRestore = document.querySelectorAll('.form-restore');
        elementsToRestore.forEach(function(element) {
            element.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const property = element.elements.title.value

                Swal.fire({
                    title: "Voulez-vous vraiment restaurer le bien : **"+property+"** ?",
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

        //confirmation de suppression d'une propriété
        const elementsToDelete = document.querySelectorAll('.form-delete');
        elementsToDelete.forEach(function(element) {
            element.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const property = element.elements.title.value

                Swal.fire({
                    title: "Voulez-vous vraiment supprimer définitivement le bien : **"+property+"** ?",
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
