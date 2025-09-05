<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPropertiesRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function index(SearchPropertiesRequest $request){
        $query = Property::query()->with(['city','options'])->orderBy('created_at','DESC');
        if($request->validated('price')){
            $query = $query->where('price', '<=', $request->input('price'));
        }
        if($request->validated('rooms')){
            $query = $query->where('rooms', '>=', $request->input('romms'));
        }
        if($request->validated('surface')){
            $query = $query->where('surface', '>=', $request->input('surface'));
        }
        if($request->validated('title')){
            $query = $query->where('title', 'LIKE', '%'.$request->input('title').'%');
        }
        return view('frontend.properties.index',[
            'properties' => $query->paginate(10),
            'input' => $request->validated()
        ]);
    }

    public function show(string $slug, Property $property){
        $exceptedSlug = $property->getSlug();
        if($exceptedSlug !== $slug){
            return to_route('properties.show', ['slug' => $exceptedSlug, 'property' => $property->id]);
        }

        return view('frontend.properties.show',[
            'property' => $property
        ]);
    }
}
