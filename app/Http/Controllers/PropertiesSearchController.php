<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertiesSearchController extends Controller
{
    //metodo getProperties per ottenere un json con le proprietà

    public function getProperties()
    {

      $properties = Property::all();
      
      return response()->json(compact("properties"));
    }
      //metodo index per mostrare pagina di ricerca

    public function index()
    {
      return view("guest.search");


    }

}