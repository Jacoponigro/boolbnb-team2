<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importo il Model
use App\Property;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PropertyController extends Controller
{
    //metodo index
    public function index()
    {

      $properties = Property::all();

      $sponsored_properties = [];
      $not_sponsored_properties = [];

      // $properties_list = [
      //   "sponsored_properties" => [],
      //   "not_sponsored_properties"=> [],
      // ];

      foreach ($properties as $property) {

        if (isset($property->sponsors)) {
        // eseguo un ciclo per ogni sponsor che ha la proprietà
          foreach ($property->sponsors as $sponsor) {
            $now = Carbon::now();
            // prendo i valori esistenti di inizio e di fine di ogni sponsor
            $created_at = Carbon::parse($sponsor->pivot->created_at);
            $end_sponsor = Carbon::parse($sponsor->pivot->end_sponsor);
              if($now->between($created_at,$end_sponsor)){
                $sponsored_properties[] = $property;
              } else if (!in_array($property, $not_sponsored_properties) && !in_array($property, $sponsored_properties)){
                $not_sponsored_properties[] = $property;
              }
            }
          }
        }      
      return view ("guest.index", compact('sponsored_properties', 'not_sponsored_properties'));

    }

    //metodo show
    public function show($id)
    {
      $property = Property::find($id);
      // $email = Auth::user()->email;
      return view("guest.show", compact("property"));
    }

}
