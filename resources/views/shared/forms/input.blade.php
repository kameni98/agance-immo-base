@php
    $type ??= 'text';
    $class ??= null;
    $options ??= null;
    $selectMulti ??= false;
    $selectedIds ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);//si le label n'est pas donné on met la valeur du name avec la premiere lettre en majuscule
@endphp
<div @class([$class])>
    <label for="{{$name}}Input" class="form-label">{{$label}}</label>
    <div class="input-group has-validation">

        @if($type === 'textarea')
            <textarea class="form-control @error($name) is-invalid @enderror" id="{{$name}}Input" name="{{$name}}"  rows="3"
                      aria-describedby="{{$name}}InputFeedback">{{old($name, $value)}}</textarea>
        @elseif($type === 'select')
            <select class="form-control @error($name) is-invalid @enderror" id="{{$name}}Input" name="{{$name}}@if($selectMulti)[]@endif"
                    aria-describedby="{{$name}}InputFeedback" @if($selectMulti) multiple @endif>
                <option value="" disabled >Sélectionner un(e) {{$label}}...</option>
                @if($selectMulti)
                    @foreach($options as $option)
                        <option @selected($selectedIds->contains($option->id))
                                value="{{$option->id}}">{{$option->name}}</option>
                    @endforeach
                @else
                    @foreach($options as $option)
                        <option @selected(old($name, $value) == $option->id)
                                value="{{$option->id}}">{{$option->name}}</option>
                    @endforeach
                @endif
            </select>
        @else
            <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror" id="{{$name}}Input"
                   name="{{$name}}" placeholder="{{$label}}" value="{{old($name, $value)}}">
        @endif

        @error($name)
        <div id="{{$name}}InputFeedback" class="invalid-feedback">
            @error($name)
            {{ $message }}
            @enderror
        </div>
        @enderror
    </div>
</div>

