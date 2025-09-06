<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    //methode qui va permetre de traiter et envoyer un mail avec les données du formulaire contact pour une propriété
    public function contact(Property $property, PropertyContactRequest $request){
        //on envoi le mail
        $message = "";
        $type ="";
        try {
            Mail::send(new PropertyContactMail($property, $request->validated()));
            $type = "success";
            $message = 'Merci de nous avoir contactés à apropos la propriété <b>'.$property->title.'</b> nous vous contacterons le plus tôt possible.';

        }catch (\Exception $e){
            $type = "danger";
            $message = 'Une erreur est survenue veuillez vérifie votre formulaire et votre connexion internet.';
            dd($e->getMessage());
        }

        return to_route('properties.show', ['slug' => $property->getSlug(), 'property' => $property->id])->with([
            'message' => $message,
            'type' => $type
        ]);
    }
}
