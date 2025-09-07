<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //le scope "solded" fait appel direct à la methode "scopeSolded" et permet de selectionner les propriétés disponible
        return view('frontend.home',[
            'properties' => Property::solded(false)->recent()->limit(4)->get(),
        ]);
    }
}
