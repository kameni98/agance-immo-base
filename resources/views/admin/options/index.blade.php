@extends('admin.base')

@section('title', 'Liste des villes')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
        <a href="{{route('admin.cities.create')}}" class="btn btn-primary">
            Ajouter
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <th>Titre</th>
            <th @class('text-end')>Actions</th>
        </thead>

        <tbody>
            @foreach($cities as $option)
                <tr>
                    <td>{{$option->name}}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{route('admin.cities.edit', ['option' => $option->id])}}" class="btn btn-warning">
                                edit
                            </a>
                            <form class="form-delete" action="{{route('admin.cities.destroy', $option)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="option" value="{{$option->name}}">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $cities->links() }}
@endsection

@section('js')
    <script>
        const elements = document.querySelectorAll('.form-delete');
        elements.forEach(function(element) {
            element.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const option = element.elements.option.value
                Swal.fire({
                    title: "Voulez-vous vraiment supprimer l'option : **"+option+"** ?",
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
