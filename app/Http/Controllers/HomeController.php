<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home',[
            'properties' => Property::orderBy('created_at', 'desc')->limit(4)->get(),
        ]);
    }
}
