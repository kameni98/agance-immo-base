<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityFormRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index',[
            'cities' => City::orderBy('name','asc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = new City();
        return view('admin.cities.form',[
            'city' => $city
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityFormRequest $request)
    {
        $city = City::create($request->validated());

        return to_route('admin.cities.index')->with([
            'message', 'La ville <b>'.$city->name.'</b> a été ajouté avec success.',
            'type' => 'success'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.form',[
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityFormRequest $request, City $city)
    {
        $city->update($request->validated());

        return to_route('admin.cities.index')->with([
            'message' => 'La ville <b>'.$city->name.'</b> a été modifié avec success.',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return to_route('admin.cities.index')->with([
            'message' => 'La ville <b>'.$city->name.'</b> a été supprimée avec success.',
            'type' => 'danger'
        ]);
    }
}
