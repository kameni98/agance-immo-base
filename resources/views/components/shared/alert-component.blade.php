<div class="alert alert-{{$type}} fw-bold">
    {!! $message  !!}
</div>
{{--
si on veut merge les classes recu en paramettre on procède comme suit
<div {{$attributes->merge(['class' => 'alert alert-$type fw-bold'])}}>
    {!! $slot  !!} //slot permet de recuperer le contenu qui sera situé dans la balise du component
</div>
--}}
