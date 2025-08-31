@php
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);//si le label n'est pas donné on met la valeur du name avec la premiere lettre en majuscule
@endphp
<div @class([$class])>
    <div class="form-check form-switch">
        <input type="hidden" name="{{$name}}" value="0">
        <!-- "checked" permet de cocher ou pas une checkbox selon sa value true ou false -->
        <input @checked(old($name, $value ?? false)) class="form-check-input" type="checkbox" id="{{$name}}Checkbox"
               name="{{$name}}" value="1" role="switch">
        <label class="form-check-label" for="{{$name}}Checkbox">
            {{$label}}
        </label>
    </div>

</div>

