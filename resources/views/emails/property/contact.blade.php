<x-mail::message>
# Nouvelle demande de contact sur la propriété {{$property->title}}

Une nouvelle demande a été faites pour la propriété : <a href="{{route('properties.show',['slug' => $property->getSlug(), 'property' => $property])}}">{{$property->title}}</a>

Informations du client intéressé :
- Prénoms : {{$data['firstname']}}
- Noms : {{$data['lastname']}}
- Phone : {{$data['phone']}}
- Email : {{$data['email']}}

**Message : **<br>{{$data['message']}}


<x-mail::button :url="route('properties.show',['slug' => $property->getSlug(), 'property' => $property])">
Voir la propriété
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
