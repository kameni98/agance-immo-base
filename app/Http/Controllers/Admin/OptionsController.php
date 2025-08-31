<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionFormRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.options.index',[
            'options' => Option::orderBy('name','asc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $option = new Option();
        return view('admin.options.form',[
            'option' => $option
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionFormRequest $request)
    {
        $option = Option::create($request->validated());

        return to_route('admin.options.index')->with([
            'message', 'La ville <b>'.$option->name.'</b> a été ajouté avec success.',
            'type' => 'success'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.form',[
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionFormRequest $request, Option $option)
    {
        $option->update($request->validated());

        return to_route('admin.options.index')->with([
            'message' => 'La ville <b>'.$option->name.'</b> a été modifié avec success.',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return to_route('admin.options.index')->with([
            'message' => 'La ville <b>'.$option->name.'</b> a été supprimée avec success.',
            'type' => 'danger'
        ]);
    }
}
