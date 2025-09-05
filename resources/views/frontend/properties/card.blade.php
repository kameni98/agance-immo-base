<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{route('properties.show', ['property' => $property, 'slug' => $property->getSlug()])}}">{{$property->title}}</a>
        </h5>

        <p class="card-text">{{$property->surface}} m² - {{$property->city->name}} - <i>{{$property->address}}</i></p>

        <div class="text-primary fw-b" style="font-size: 1.4rem">
            {{number_format($property->price, thousands_separator: ' ')}}
        </div>
    </div>
</div>
