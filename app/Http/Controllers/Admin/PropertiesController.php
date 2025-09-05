<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\City;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index',[
            'properties' => Property::orderBy('created_at','desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        //dans le cadre de la creation pour préremplir certaines infos dans le formulaire on peut definir quelle valeur
        //par défauts
        $property->fill([
           'surface' => 100,
           'price' => 100000,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0
        ]);
        return view('admin.properties.form',[
            'property' => $property,
            'cities' => City::orderBy('name','asc')->get(),
            'options' => Option::orderBy('name','asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.properties.index')->with([
            'message' => 'La propriété <b>'.$property->title.'</b> a été ajouté avec success.',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource. dans notre cas on ne va pas avoir cette methode
     */
    /*public function show(string $id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form',[
            'property' => $property,
            'cities' => City::orderBy('name','asc')->get(),
            'options' => Option::orderBy('name','asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.properties.index')->with([
            'message' => 'La propriété <b>'.$property->title.'</b> a été modifiée avec success.',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.properties.index')->with([
            'message' => 'La propriétée <b>'.$property->title.'</b> a été supprimée avec success.',
            'type' => 'danger'
        ]);
    }
}
